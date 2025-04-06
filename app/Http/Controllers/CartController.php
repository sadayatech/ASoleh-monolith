<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Menampilkan seluruh produk yang sudah dimasukkan ke keranjang milik 1 user
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            // User is logged in
            $carts = Cart::where('user_id', Auth::id())->get();
        } else {
            // User is not logged in
            $cart_cookie = json_decode($request->cookie('cart', '[]'), true);
            $carts = collect($cart_cookie)->map(function ($cart_item) {
                $item = Item::find($cart_item['item_id']);

                return $item ? (object) [
                    'item' => $item,
                    'amount' => $cart_item['amount'],
                ] : null;
            })->filter();
        }

        $total = $carts->reduce(function ($carry, $cart) {
            return $carry + ($cart->item->price * $cart->amount);
        }, 0);

        return Inertia::render('Keranjang', ['carts' => $carts, 'total' => $total]);
    }

    /**
     * Menambahkan produk ke cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'amount' => 'required|gte:1',
        ]);
        $user_id = Auth::id();
        $item = Item::findOrFail($request->item_id);
        $item_id = $item->id;

        if ($user_id) {
            // User is logged in
            $existing_cart = Cart::where('item_id', $item_id)
                ->where('user_id', $user_id)
                ->first();

            if ($existing_cart === null) {
                $request->validate([
                    'amount' => 'required|gte:1|lte:'.$item->stock,
                ]);

                Cart::create([
                    'user_id' => $user_id,
                    'item_id' => $item_id,
                    'amount' => $request->amount,
                ]);
            } else {
                $request->validate([
                    'amount' => 'required|gte:1|lte:'.($item->stock -
                        $existing_cart->amount),
                ]);

                $existing_cart->update([
                    'amount' => $existing_cart->amount + $request->amount,
                ]);
            }
        } else {
            // User is not logged in
            $cart = json_decode($request->cookie('cart', '[]'), true);

            $existing_cart_key = array_search($item_id, array_column($cart, 'item_id'));

            if ($existing_cart_key === false) {
                $request->validate([
                    'amount' => 'required|gte:1|lte:'.$item->stock,
                ]);

                $cart[] = [
                    'item_id' => $item_id,
                    'amount' => $request->amount,
                ];
            } else {
                $existing_cart = $cart[$existing_cart_key];

                $request->validate([
                    'amount' => 'required|gte:1|lte:'.($item->stock -
                        $existing_cart['amount']),
                ]);

                $cart[$existing_cart_key]['amount'] += $request->amount;
            }

            // Store updated cart in a cookie
            return Redirect::route('keranjang')
                ->withCookie(cookie('cart', json_encode($cart), 60 * 24 * 7)); // 7 days
        }

        return Redirect::route('keranjang');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:'.$cart->product->stock,
        ]);
        $cart->update([
            'amount' => $request->amount,
        ]);

        return Redirect::route('cart.index');
    }

    /**
     * Menghapus keranjang user berdsarkan permintaan yang sudah dikirimkan
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        // Arahkan user kembali ke halaman sebelumnya
        return Redirect::back()->with(['success' => 'Produk berhasil dihapus dari keranjang']);
    }

    public function Checkout(Request $request)
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->get();
        } else {
            // User is not logged in
            $cart_cookie = json_decode($request->cookie('cart', '[]'), true);
            $carts = collect($cart_cookie)->map(function ($cart_item) {
                $item = Item::find($cart_item['item_id']);

                return $item ? (object) [
                    'item' => $item,
                    'amount' => $cart_item['amount'],
                ] : null;
            })->filter();
        }

        // Calculate total
        $total = $carts->reduce(function ($carry, $cart) {
            return $carry + ($cart->item->price * $cart->amount);
        }, 0);

        return Inertia::render('Checkout', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }
}

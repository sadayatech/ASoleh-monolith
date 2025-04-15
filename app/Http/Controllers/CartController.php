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
    protected function getUserCarts(Request $request)
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->get();
        } else {
            $cart_cookie = json_decode($request->cookie('cart', '[]'), true);
            return collect($cart_cookie)->map(function ($cart_item) {
                $item = Item::find($cart_item['item_id']);
                return $item ? (object)[
                    'item' => $item,
                    'amount' => $cart_item['amount'],
                ] : null;
            })->filter();

        }
    }

    public function calculateTotal($carts)
    {
        return $carts->reduce(function ($carry, $cart) {
            return $carry + ($cart->item->price * $cart->amount);
        }, 0);
    }

    protected function validateStock($amount, $stock_left)
    {
        request()->validate([
            'amount' => 'required|gte:1|lte:' . $stock_left,
        ]);
    }

    public function index(Request $request)
    {
        $carts = $this->getUserCarts($request);
        $total = $this->calculateTotal($carts);

        return Inertia::render('Keranjang', ['carts' => $carts, 'total' => $total]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'amount' => ['required', 'gte:1'],
        ]);

        $item = Item::findOrFail($request->item_id);
        $item_id = $item->id;
        $user_id = Auth::id();

        if ($user_id) {
            $existing_cart = Cart::where('item_id', $item_id)
                ->where('user_id', $user_id)
                ->first();

            $stock_left = $existing_cart ? ($item->stock - $existing_cart->amount) : $item->stock;
            $this->validateStock($request->amount, $stock_left);

            if ($existing_cart) {
                $existing_cart->increment('amount', $request->amount);
            } else {
                Cart::create([
                    'user_id' => $user_id,
                    'item_id' => $item_id,
                    'amount' => $request->amount,
                ]);
            }

            return Redirect::route('keranjang');
        }

        $cart = json_decode($request->cookie('cart', '[]'), true);
        $existing_cart_key = array_search($item_id, array_column($cart, 'item_id'));

        if ($existing_cart_key === false) {
            $this->validateStock($request->amount, $item->stock);
            $cart[] = ['item_id' => $item_id, 'amount' => $request->amount];
        } else {
            $existing_cart = $cart[$existing_cart_key];
            $this->validateStock($request->amount, $item->stock - $existing_cart['amount']);
            $cart[$existing_cart_key]['amount'] += $request->amount;
        }

        return Redirect::route('keranjang')->withCookie(cookie('cart', json_encode($cart), 60 * 24 * 7));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        $this->validateStock($request->amount, $cart->product->stock);

        $cart->update(['amount' => $request->amount]);

        return Redirect::route('cart.index');
    }



    public function checkout(Request $request)
    {
        $carts  = $this->getUserCarts($request);
        $total = $this->calculateTotal($carts);
        
        if ($carts->isEmpty()) {
            return redirect('/keranjang')->withErrors(['checkout_error' => 'Yah, keranjang kamu kosong nih, gak bisa checkout jadinya.']);
        }
        
        return Inertia::render('Checkout', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function cashier_add_to_cart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'amount' => 'required|gte:1',
        ]);

        $item = Item::findOrFail($request->item_id);
        $user = auth()->user();

        $existing_cart = $user->carts()->where('item_id', $item->id)->first();
        $stock_left = $existing_cart ? $item->stock - $existing_cart->amount : $item->stock;

        $this->validateStock($request->amount, $stock_left);

        if ($existing_cart) {
            $existing_cart->increment('amount', $request->amount);
        } else {
            $user->carts()->create([
                'item_id' => $item->id,
                'amount' => $request->amount,
            ]);
        }

        return redirect()->back()->with(['success' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function update(string $cart_id, Request $request)
    {

        if (Auth::check()) {
            $cart = Cart::with('item')->findOrFail($cart_id);
            $this->validateStock($request->amount, $cart->item->stock);
            $cart->update(['amount' => $request->amount]);
            return redirect()->back()->with(['success' => 'Keranjang berhasil diperbarui']);
        } else {
            $cart_cookie = json_decode($request->cookie('cart', '[]'), true);
            $this->validateStock($request->amount, Item::findOrFail($cart_id)->stock);
            $cart_key = array_search($cart_id, array_column($cart_cookie, 'item_id'));

            if ($cart_key !== false) {
                $cart_cookie[$cart_key]['amount'] = $request->amount;

                return redirect()->back()
                    ->withCookie(cookie('cart', json_encode($cart_cookie), 60 * 24 * 7))
                    ->with(['success' => 'Keranjang berhasil diperbarui']);
            }

            return redirect()->back()->with(['error' => 'Produk tidak ditemukan di keranjang']);
        }
    }

    public function destroy(Request $request, string $id)
    {
        if (Auth::check()) {
            Cart::findOrFail($id)->delete();
            return redirect()->back()->with(['success' => 'Produk berhasil dihapus dari keranjang']);
        }

        $cart_cookie = json_decode($request->cookie('cart', '[]'), true);
        $cart_key = array_search($id, array_column($cart_cookie, 'item_id'));

        if ($cart_key !== false) {
            unset($cart_cookie[$cart_key]);
            $cart_cookie = array_values($cart_cookie);

            return redirect()->back()
                ->withCookie(cookie('cart', json_encode($cart_cookie), 60 * 24 * 7))
                ->with(['success' => 'Produk berhasil dihapus dari keranjang']);
        }

        return redirect()->back()->with(['error' => 'Produk tidak ditemukan di keranjang']);
    }
}

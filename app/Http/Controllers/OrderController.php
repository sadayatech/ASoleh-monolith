<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'consumer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'required|starts_with:"62"|max:255',
            'notes' => 'nullable|string|max:255',
            'payment_method' => 'required|in:qris,cash',
        ]);

        // Ambil cart berdasarkan user login / guest
        $carts = Auth::check()
            ? Cart::with('item')->where('user_id', Auth::id())->get()
            : collect(json_decode($request->cookie('cart', '[]'), true))->map(function ($cartItem) {
                $item = Item::find($cartItem['item_id']);

                return $item ? (object) [
                    'item' => $item,
                    'amount' => $cartItem['amount'],
                ] : null;
            })->filter();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total belanja
        $total = $carts->sum(fn ($cart) => $cart->item->price * $cart->amount);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'transaction_code' => 'TRX'.now()->format('Ymd').'-'.random_int(100000, 999999),
                'consumer_name' => $request->consumer_name,
                'user_has_account' => Auth::check(),
                'payment_method' => $request->payment_method,
                'total_amount' => $total,
            ]);

            foreach ($carts as $cart) {
                $item = $cart->item;

                // Cek stok cukup
                if ($item->stock < $cart->amount) {
                    throw new \Exception("Stok produk {$item->name} tidak mencukupi.");
                }

                // Kurangi stok dan tambah sold
                $item->decrement('stock', $cart->amount);
                $item->increment('sold', $cart->amount);

                // Buat order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'quantity' => $cart->amount,
                    'price' => $item->price,
                ]);
            }

            // Hapus cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                // Simpan transaksi ke cookies untuk non-registered users
                $transactions = json_decode($request->cookie('transactions', '[]'), true);
                $transactions[] = [
                    'transaction_code' => $order->transaction_code,
                    'consumer_name' => $order->consumer_name,
                    'payment_method' => $order->payment_method,
                    'total_amount' => $order->total_amount,
                    'created_at' => now()->toDateTimeString(),
                ];
                cookie()->queue(cookie('transactions', json_encode($transactions), 60 * 24 * 30)); // Simpan selama 30 hari
                cookie()->forget('cart'); // Hapus cart cookie
            }

            DB::commit();

            return Inertia::render('Berhasil', [
                'order' => $order,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['checkout_error' => $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        // Jika user login, ambil dari database
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())
                ->latest()
                ->get(['transaction_code', 'consumer_name', 'payment_method', 'total_amount', 'created_at']);
        }
        // Jika guest, ambil dari cookie 'transactions'
        else {
            $transactions = json_decode($request->cookie('transactions', '[]'), true);

            $orders = collect($transactions)->map(function ($transaction) {
                return (object) [
                    'transaction_code' => $transaction['transaction_code'],
                    'consumer_name' => $transaction['consumer_name'],
                    'payment_method' => $transaction['payment_method'],
                    'total_amount' => $transaction['total_amount'],
                    'created_at' => $transaction['created_at'],
                ];
            });
        }

        return Inertia::render('Transaksi', [
            'transactions' => $transactions,
        ]);
    }
}

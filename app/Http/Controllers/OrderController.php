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
                'notes' => $request->notes,
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
                    'notes' => $order->notes,
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
        if (Auth::check()) {
            // User login → ambil semua transaksi user dari database
            $transactions = Order::where('user_id', Auth::id())
                ->latest()->with('items.item')
                ->get();
        } else {
            // Guest → ambil kode dari cookie
            $cookieTransactions = json_decode($request->cookie('transactions', '[]'), true);

            // Ambil hanya kode transaksi dari cookie
            $transactionCodes = collect($cookieTransactions)
                ->pluck('transaction_code')
                ->filter()
                ->toArray();

            // Query ke database pakai kode transaksi dari cookie
            $transactions = Order::whereIn('transaction_code', $transactionCodes)
                ->latest()->with('items.item')
                ->get();
        }

        return Inertia::render('Transaksi', [
            'transactions' => $transactions,
        ]);
    }

    public function viewOrder(Order $order, Request $request)
    {
        return Inertia::render('DetailTransaksi', [
            'order' => $order->load('items.item'),
        ]);
    }

    public function uploadBukti(Request $request, Order $order)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048', // max 2MB
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $order->update([
            'status' => 'under-review',
        ]);
        $order->payment()->updateOrCreate(
            ['order_id' => $order->id],
            [
                'amount_paid' => $order->total_amount,
                'payment_method' => $order->payment_method,
                'proof' => $path,
            ]
        );
        return back()->with('message', 'Bukti pembayaran berhasil diupload!');
    }
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:paid,unpaid,under-review,rejected,done',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('message', 'Status transaksi berhasil diperbarui!');
    }
}

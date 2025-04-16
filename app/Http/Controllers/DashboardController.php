<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function render_home(Request $request)
    {
        $activeItemCount = Item::where('stock', '>', 0)->count();
        $orderCount = Order::count();
        $supplierCount = Supplier::count();
        $customerCount = User::where('role', 'customer')->count();
        $todayIncome = Order::whereDate('created_at', now())
            ->whereIn('status', ['paid', 'done'])
            ->with('items')
            ->get()
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->sum(function ($orderItem) {
                return $orderItem->quantity * $orderItem->price;
            });
        $profit = Order::whereDate('created_at', now())
            ->whereIn('status', ['paid', 'done'])
            ->with('items.item')
            ->get()
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->sum(function ($orderItem) {
                return ($orderItem->price - $orderItem->supplier_price) * $orderItem->quantity;
            });
        return Inertia::render('admin/Home', [
            'stats' => [
                'items' => $activeItemCount,
                'orders' => $orderCount,
                'supplier' => $supplierCount,
                'customer' => $customerCount,
                'income' => $todayIncome,
                'profit' => $profit,
            ],
        ]);
    }
    public function render_menu(Request $request)
    {
        $search = $request->input('search');

        $itemsQuery = Item::query();

        if ($search) {
            $itemsQuery->where('name', 'like', '%' . $search . '%');
        }

        $items = $itemsQuery->latest()->get();

        return Inertia::render('admin/Menu', [
            'items' => $items,
            'filters' => [
                'search' => $search,
            ],
            'suppliers' => Supplier::all()
        ]);
    }
    public function render_users(Request $request)
    {
        $search = $request->input('search');
        $usersQuery = User::query();
        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%');
        }
        $users = $usersQuery->latest()->get();
        return Inertia::render('admin/Pengguna', [
            'users' => $users,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    public function render_supplier(Request $request)
    {
        $search = $request->input('search');
        $suppliersQuery = Supplier::query()->with('items');
        if ($search) {
            $suppliersQuery->where('name', 'like', '%' . $search . '%');
        }
        $suppliers = $suppliersQuery->latest()->get()->map(function ($supplier) {
            $items = $supplier->items->pluck('name')->map(function ($name) {
                return $name;
            })->implode(', ');

            return [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'image' => $supplier->image,
                'whatsapp_number' => $supplier->whatsapp_number,
                'items' => $items,
            ];
        });
        return Inertia::render('admin/Supplier', [
            'suppliers' => $suppliers,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    public function render_report(Request $request)
    {
        return Inertia::render('admin/Laporan');
    }
    public function render_kasir_dashboard(Request $request)
    {
        $search = $request->input('search');

        $itemsQuery = Item::query();

        if ($search) {
            $itemsQuery->where('name', 'like', '%' . $search . '%');
        }

        $items = $itemsQuery->latest()->get();
        $carts = auth()->user()->carts->load('item');
        return Inertia::render('kasir/HomeDashboard', [
            'items' => $items,
            'carts' => $carts,
            'total' => $carts->reduce(function ($carry, $cart) {
                return $carry + ($cart->item->price * $cart->amount);
            }, 0),
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    public function render_kasir_orders(Request $request)
    {
        $search = $request->input('search');
        $ordersQuery = Order::query()->with(['items.item', 'payment'])->whereNot('status', 'done');
        if ($search) {
            $ordersQuery->where('invoice_number', 'like', '%' . $search . '%');
        }
        $orders = $ordersQuery->latest()->get();
        return Inertia::render('kasir/Pesanan', [
            'orders' => $orders,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    public function render_kasir_history(Request $request)
    {
        $search = $request->input('search');
        $ordersQuery = Order::query()->with(['items.item', 'payment'])->where('status', 'done');
        if ($search) {
            $ordersQuery->where('invoice_number', 'like', '%' . $search . '%');
        }
        $orders = $ordersQuery->latest()->get();
        return Inertia::render('kasir/Riwayat', [
            'orders' => $orders,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
}

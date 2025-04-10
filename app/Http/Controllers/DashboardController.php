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
        $orderCount = Order::count(); // Assuming you have an Order model
        $supplierCount = Supplier::count();
        $customerCount = User::where('role', 'customer')->count();

        return Inertia::render('admin/Home', [
            'stats' => [
                'items' => $activeItemCount,
                'orders' => $orderCount,
                'supplier' => $supplierCount,
                'customer' => $customerCount,
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

        $items = $itemsQuery->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'stock' => $item->stock,
                'image' => $item->media_path,
            ];
        });

        return Inertia::render('admin/Menu', [
            'items' => $items,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    public function render_users(Request $request)
    {
        $search = $request->input('search');
        $usersQuery = User::query();
        if ($search) {
            $usersQuery->where('name', 'like', '%' . $search . '%');
        }
        $users = $usersQuery->latest()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'image' => $user->media_path,
            ];
        });
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
}

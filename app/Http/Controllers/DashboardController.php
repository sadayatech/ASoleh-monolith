<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function render_home(Request $request)
    {
        return Inertia::render('admin/Home');
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
        return Inertia::render('admin/Supplier');
    }
    public function render_report(Request $request)
    {
        return Inertia::render('admin/Laporan');
    }
}

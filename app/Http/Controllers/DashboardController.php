<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
        return Inertia::render('admin/Pengguna');
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

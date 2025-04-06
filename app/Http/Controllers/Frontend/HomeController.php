<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function renderHomePage()
    {
        $items = Item::all();
        $items = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'stock' => $item->stock,
                'image' => $item->media_path,
            ];
        });

        return Inertia::render('Home', [
            'items' => $items,
        ]);
    }

    public function searchItems(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $items = Item::where(['name', 'price'], 'LIKE', "%$query%")->get();
        $items = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'stock' => $item->stock,
                'image' => $item->media_path,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $items,
        ]);
    }

    public function getItemByCategory($category): JsonResponse
    {
        $items = Item::where('category', $category)->get();
        if ($items->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No items found in this category',
            ], 404);
        }
        $items = $items->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'stock' => $item->stock,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $items,
        ]);
    }
}

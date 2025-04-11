<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media', 'public');
        }

        Item::create($data);

        return redirect()->back()->with('success', 'Item created successfully');
    }



    public function toggleActiveState(Item $item, Request $request) {        
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $item->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Item state updated successfully');
    }

    public function update(Item $item, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'supplier_price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media', 'public');
        }
        
        $item->update($data);

        return redirect()->back()->with('success', 'Item updated successfully');
    }
    public function destroy(Item $item) {
        $item->delete();
        return redirect()->back()->with('success', 'Item deleted successfully');
    }
}

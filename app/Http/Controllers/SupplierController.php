<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'whatsapp_number' => 'required',
        ]);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media', 'public');
        }
        Supplier::create($data);
        return redirect()->back()->with('success', 'Supplier created successfully');
    }

    public function update(Supplier $supplier, Request $request)
    {
        $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required',
            'whatsapp_number' => 'required',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media', 'public');
            if ($supplier->image) {
                Storage::delete($supplier->image);
            }
        }
        $supplier->update($data);


        return redirect()->back()->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->image) {
            Storage::delete($supplier->image);
        }
        $supplier->delete();

        return redirect()->back()->with('success', 'Supplier deleted successfully');
    }
}

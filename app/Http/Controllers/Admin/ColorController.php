<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    public function index()
    {
        $colors = ColorProduct::with('product')->get();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.colors.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('colors', 'public');
            
        }

        ColorProduct::create($validated);

        return redirect()->route('admin.colors.index')->with('success', 'Màu sắc đã được thêm thành công.');
    }

    public function edit($id)
    {
        $color = ColorProduct::findOrFail($id);
        $products = Product::all();
        return view('admin.colors.edit', compact('color', 'products'));
    }

    public function update(Request $request, $id)
    {
        $color = ColorProduct::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($color->image) {
                Storage::disk('public')->delete($color->image);
            }
            $validated['image'] = $request->file('image')->store('colors', 'public');
        } else {
            $validated['image'] = $color->image;
        }

        $color->update($validated);

        return redirect()->route('admin.colors.index')->with('success', 'Màu sắc đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $color = ColorProduct::findOrFail($id);

        if ($color->image) {
            Storage::disk('public')->delete($color->image);
        }

        $color->delete();

        return redirect()->route('admin.colors.index')->with('success', 'Màu sắc đã được xóa.');
    }
}

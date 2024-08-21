<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('colorProducts', 'category', 'brand')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); 
        $brands = Brand::all(); 
        

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pro_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail' => 'required|string',
            'category_id' => 'required|exists:category,id',
            'brand_id' => 'required|exists:brand,id',
        ]);
    
        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('products', 'public');
        }
    
    
        Product::create($validated);
    
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'pro_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail' => 'required|string',
            'category_id' => 'required|exists:category,id',
            'brand_id' => 'required|exists:brand,id',
        ]);

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $validated['img'] = $request->file('img')->store('products', 'public');
        } else {
            $validated['img'] = $product->img;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->img) {
            Storage::disk('public')->delete('image_product/'.$product->img);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa.');
    }
    
}

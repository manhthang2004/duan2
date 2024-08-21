<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brand,name',
        ]);

        Brand::create($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Hãng đã được thêm ');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:brand,name,'.$id,
        ]);

        $brand = Brand::find($id);
        $brand->update($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Sửa hãng thành công ');
    }

    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Xóa hãng thành công');
    }
}

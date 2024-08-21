<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ColorProduct;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::where('status', true)->get();
        $products = Product::all(); 
        $topDiscountedProducts = Product::whereNotNull('discount') 
                                    ->orderBy('discount', 'desc') 
                                    ->limit(12) 
                                    ->get();
        $laptops =  Product::where('category_id', 3)->get();
        $gamingMice =  Product::where('category_id', 2)->get();
        $gamingKeyboards =  Product::where('category_id', 1)->get();
        $headphones =  Product::where('category_id', 4)->get();

        return view('product.index', compact('products', 'laptops', 'gamingMice', 'gamingKeyboards', 'headphones','topDiscountedProducts','banners'));
    }

    public function list(Request $request)
{
    $brandId = $request->input('brand');
    $categoryId = $request->input('cate');

    $productsQuery = Product::with(['category', 'brand'])
        ->join('category', 'products.category_id', '=', 'category.id')
        ->join('brand', 'products.brand_id', '=', 'brand.id')
        ->select('products.*', 'brand.name as brand_name', 'category.name as cate_name');

    if ($brandId && $brandId !== 'all') {
        $productsQuery->where('products.brand_id', $brandId);
    }

    if ($categoryId && $categoryId !== 'all') {
        $productsQuery->where('products.category_id', $categoryId);
    }

    $products = $productsQuery->paginate(12);

    $brands = Brand::select('id', 'name')->get();
    $categories = Category::select('id', 'name')->get();

    return view('product.list', compact('products', 'brands', 'categories'));
}


    public function filter(Request $request)
    {
        $brandId = $request->input('brand');
        $categoryId = $request->input('cate');

        $query = Product::query()->with(['category', 'brand']);

        if ($brandId !== 'all') {
            $query->where('brand_id', $brandId);
        }

        if ($categoryId !== 'all') {
            $query->where('id_cate', $categoryId);
        }

        $products = $query->get();
        $count = $products->count();

        $brands = Brand::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();

        return view('product.list', compact('products', 'brands', 'categories', 'count'));
    }

    

    public function show($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $comments = Comment::where('product_id', $id)->get();
    
        $colorPro = $request->query('color') ? ColorProduct::find($request->query('color')) : null;
    
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->limit(3)
            ->get();
    
        
        $price_format = number_format($product->price, 0, ',', '.');
        $discount_format = $product->discount ? number_format($product->price * (1 - $product->discount / 100), 0, ',', '.') : $price_format;
        $newprice_format = $discount_format;
    
        return view('product.show', [
            'product' => $product,
            'colorPro' => $colorPro,
            'relatedProducts' => $relatedProducts,
            'price_format' => $price_format,
            'discount_format' => $discount_format,
            'newprice_format' => $newprice_format,
            'comments' => $comments

        ] );
    }
    


   
    public function submitComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000', 
            'product_id' => 'required|exists:products,id'
        ]);
    
        $userId = Auth::check() ? Auth::id() : null;
    
        if (!$userId) {
            return redirect()->route('product.show', $request->input('product_id'))
                             ->with('error', 'Bạn cần đăng nhập để gửi bình luận!');
        }
    
        Comment::create([
            'user_id' => $userId,
            'product_id' => $request->input('product_id'),
            'comment' => $request->input('comment'),
        ]);
    
        return redirect()->route('product.show', $request->input('product_id'))
                         ->with('success', 'Bình luận đã được gửi thành công!');
}


}

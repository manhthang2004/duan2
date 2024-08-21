<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

session_start();


Route::get('/', [ProductController::class, 'index'])->name('product.index');
// Show
Route::get('product/{id}/{color_id?}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/review', [ProductController::class, 'review'])->name('product.review');

Route::post('/comments/submit', [ProductController::class, 'submitComment'])->name('submit_comment');
Route::get('/sanpham/list', [ProductController::class, 'list'])->name('product.list');
Route::post('/sanpham/filter', [ProductController::class, 'filter'])->name('product.filter');

//Login

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/index', [AuthController::class, 'showAdmin'])->name('admin.index');
    });
});

// Cart 
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/cart/remove/{id_cart}/{color_id}', [CartController::class, 'remove'])->name('cart.remove');



Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout.post');
Route::get('/shipping-process', [CartController::class, 'shippingProcess'])->name('shipping_process');

Route::post('/voucher/apply', [CartController::class, 'applyVoucher'])->name('apply_voucher');


Route::get('/completed-order', [CartController::class, 'completedOrder'])->name('completed_order');
Route::get('/cancelled-order', [CartController::class, 'cancelledOrder'])->name('cancelled_order');
Route::get('/cancel-order/{id}', [CartController::class, 'cancelOrder'])->name('cancel_order');


//Admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('admin/brands', BrandController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('banners', BannerController::class);

    Route::resource('bills', BillController::class);

    Route::post('bills/{id}/confirm', [BillController::class, 'confirm'])->name('bills.confirm');
    Route::get('admin/bills/{id}/pdf', [BillController::class, 'generatePDF'])->name('bills.pdf');
    Route::post('bills/{id}/send-invoice', [BillController::class, 'sendInvoice'])->name('bills.send-invoice');});

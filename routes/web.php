<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\PemasokProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukdetailController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CekotController;
use App\Http\Controllers\ChekoutController;
use App\Http\Controllers\DataProdukController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\ProductRatingController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/product_ratings', [ProductRatingController::class, 'index'])->name('product_ratings.index');Route::get('/product-ratings', [ProductRatingController::class, 'index'])->name('product_ratings.index');


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// **ADMIN ROUTE** dengan prefix `/admin` dan middleware `admin`

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth', 'admin');
Route::resource('/admin/products', AdminProductController::class);
Route::resource('/admin/users', AdminUserController::class);
Route::resource('/admin/orders', AdminOrderController::class);
Route::post('/admin/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


// **PEMASOK ROUTE** dengan prefix `/pemasok` dan middleware `pemasok`
Route::middleware(['auth', 'staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', [PemasokController::class, 'index'])->name('pemasok.dashboard');
    Route::resource('/products', PemasokProductController::class)->names('staff.products');
});

//Route Shoop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/produkdetail/{id}', [ProdukdetailController::class, 'index'])->name('produkdetail.index');
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

//Route Riwayat Pesanan
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Pastikan ini ada di dalam group middleware 'auth' atau yang relevan untuk user
// Route untuk menampilkan halaman rating produk dalam sebuah pesanan
Route::get('/user/orders/{order}/rate', [App\Http\Controllers\UserOrderController::class, 'rateForm'])->name('user.orders.rate_form');

// Route untuk submit rating (akan dibuat di langkah selanjutnya)
// routes/web.php
Route::post('/user/orders/{order}/submit-ratings', [UserOrderController::class, 'submitRatings'])->name('user.orders.submit_ratings');

// Route yang sudah ada (pastikan cocok dengan perubahan controller sebelumnya)
Route::get('/user/orders', [App\Http\Controllers\UserOrderController::class, 'index'])->name('user.orders.index');
Route::delete('/user/orders/{order}', [App\Http\Controllers\UserOrderController::class, 'destroy'])->name('user.orders.destroy');
// Route::get('/cekot/confirm', [cekotController::class, 'confirm'])->name('cekot.confirm');
// Route::post('/cekot/confirm', [cekotController::class, 'store'])->name('cekot.store');
// Route::get('/cart/cekot',[CekotController::class, 'index'])->name('cekot.index');
// Route::get('/cekot', [CekotController::class, 'index'])->name('cekot.index');


//Route Riwayat Transaksi
Route::get('/riwayat/pemesanan/', [RiwayatController::class, 'index'])->name('riwayat.pemesanan.pesanan');
Route::get('/riwayat/pemesanan/detail', [RiwayatController::class, 'detail'])->name('riwayat.pemesanan.detail');
Route::get('/riwayat/transaksi/', [RiwayatController::class, 'trans'])->name('riwayat.transaksi.trans');
Route::get('/riwayat/transaksi/struk-preview', [RiwayatController::class, 'struk'])->name('riwayat.transaksi.struk-preview');

// Route::get('/cek-ongkir', [CekotController::class, 'index']);
Route::resource('/cekot', ChekoutController::class);
// Route::get('/get-provinces', [ChekoutController::class, 'getProvinces']);
Route::get('/get-cities/{provinceId}', [ChekoutController::class, 'getCities']);
// Route::post('/check-shipping-cost', [CekotController::class, 'checkShippingCost']);

// Cart route
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

Route::delete('/cart/deleteItem/{id}', [CartController::class, 'deleteItem'])->name(name: 'item.delete');

Route::post('/cekot/checkout', [ChekoutController::class, 'checkout'])->name('checkout');
Route::post('/cart/checkout', [ChekoutController::class, 'checkout'])->name('checkout.store');
Route::post(uri: '/checkCost', action: [ChekoutController::class, 'checkShippingCost'])->name('checkCost');

Route::get('/my-orders', [UserOrderController::class, 'index'])->name('user.orders.index');
Route::delete('/my-orders/{order}', [UserOrderController::class, 'destroy'])->name('user.orders.destroy');


require __DIR__ . '/auth.php';

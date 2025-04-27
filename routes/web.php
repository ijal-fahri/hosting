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

Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__ . '/auth.php';

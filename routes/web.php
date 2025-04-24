<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\PemasokProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukdetailController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CekotController;
use App\Http\Controllers\DataProdukController;

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
    Route::get('/profile/datapribadi', [ProfileController::class, 'datapribadi'])->name('profile.datapribadi');
    Route::get('/profile/datapribadi', [ProfileController::class, 'datapribadi'])->name('profile.datapribadi');
});

// **ADMIN ROUTE** dengan prefix `/admin` dan middleware `admin`

Route::get('/admin/dashboard',[AdminController::class, 'index'])->middleware('auth','admin');
Route::resource('/admin/products', AdminProductController::class);
Route::resource('/admin/users', AdminUserController::class);

// **PEMASOK ROUTE** dengan prefix `/pemasok` dan middleware `pemasok`
Route::middleware(['auth', 'staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', [PemasokController::class, 'index'])->name('pemasok.dashboard');
    Route::resource('/products', PemasokProductController::class)->names('staff.products');
});

//Route Shoop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/collection', [collectionController::class, 'index'])->name('collection.index');
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

//Route Riwayat Pesanan
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/produkdetail/{id?}', [ProdukdetailController::class, 'index'])->name('produkdetail.index');
Route::get('/cekot', [CekotController::class, 'index'])->name('cekot.index');
Route::get('/cekot/confirm', [cekotController::class, 'confirm'])->name('cekot.confirm');
Route::post('/cekot/confirm', [cekotController::class, 'store'])->name('cekot.store');

//Route Riwayat Transaksi
Route::get('/riwayat/pemesanan/', [RiwayatController::class, 'index']) ->name('riwayat.pemesanan.pesanan');
Route::get('/riwayat/pemesanan/detail', [RiwayatController::class, 'detail']) ->name('riwayat.pemesanan.detail'); 
Route::get('/riwayat/transaksi/', [RiwayatController::class, 'trans']) ->name('riwayat.transaksi.trans');
Route::get('/riwayat/transaksi/struk-preview', [RiwayatController::class, 'struk']) ->name('riwayat.transaksi.struk-preview');

require __DIR__.'/auth.php';

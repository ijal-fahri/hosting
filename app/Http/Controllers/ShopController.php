<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        // Ambil semua produk dengan status aktif
        $products = Product::where('status', 'aktif')->get();

        // Kirim ke view 'shop.index'
        return view('shop.index', compact('products'));
    }
}

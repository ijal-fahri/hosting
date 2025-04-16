<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        $products = Product::all();

        // Menghitung jumlah produk baru, misalnya berdasarkan kolom 'is_new

        return view('admin.products.index', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProdukdetailController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            // Jika ada ID, ambil hanya produk yang dipilih
            $products = Product::where('id', $id)->get();
        } else {
            // Jika tidak ada ID, ambil semua produk
            $products = Product::all();
        }

        return view('produkdetail.index', compact('products'));
    }
}


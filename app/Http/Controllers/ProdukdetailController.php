<?php

namespace App\Http\Controllers;


use App\Models\Product;

class ProdukdetailController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        // Mengambil semua produk
        $products = Product::all();
        
        // Mengirim data produk ke view
        return view('produkdetail.index', compact('products'));
    }

    // Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        // Mengambil produk berdasarkan ID
        $produk = Product::findOrFail($id);

        // Mengambil produk lain selain produk yang ditampilkan
        $products = Product::where('id', '!=', $id)->get(); 
        
        // Mengirim data produk dan produk lain ke view
        return view('produkdetail.show', compact('produk', 'products'));
    }
}
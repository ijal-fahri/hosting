<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProdukdetailController extends Controller
{
    public function index($id)
    {
        // Ambil produk berdasarkan ID, jika tidak ketemu akan 404
        $product = Product::where('id', $id)->firstOrFail();

        return view('produkdetail.index', compact('product'));
    }
}

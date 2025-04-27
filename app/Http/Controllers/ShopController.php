<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        // Update products with zero stock to inactive
        Product::where('stock', 0)->update(['status' => 'nonaktif']);

        // Get all active products
        $products = Product::where('status', 'aktif')->get();

        return view('shop.index', compact('products'));
    }
}

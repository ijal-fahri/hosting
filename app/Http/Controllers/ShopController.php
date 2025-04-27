<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Update products with zero stock to inactive
        Product::where('stock', 0)->update(['status' => 'nonaktif']);

        // Start with active products query
        $query = Product::where('status', 'aktif');

        // Apply search filter if search parameter exists
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get the filtered products
        $products = $query->get();

        // Pass search query back to view for displaying current search
        $searchQuery = $request->search;

        return view('shop.index', compact('products', 'searchQuery'));
    }
}

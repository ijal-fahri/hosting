<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPrice = 0;
        $totalItems = $cartItems->sum('quantity');

        foreach ($cartItems as $item) {
            $totalPrice += $item->product->harga_diskon * $item->quantity;
        }
        return view('cart.index', compact('cartItems', 'totalPrice', 'totalItems')); 
    }

    public function addToCart(Request $request)
    {

        $product = Product::find($request->id); //cari produk berdasarkan ID

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Ambil cart dari relasi, atau buat cart baru jika belum ada
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();

        // Jika produk sudah ada di cart, tambahkan quantity-nya
        if ($cartItem) {
            // Jika produk sudah ada di cart, tambahkan quantity-nya
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika produk belum ada di cart, tambahkan dengan quantity 1
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'price' => $product->harga_diskon,
                'quantity' => 1, // default quantity
                'picture' => $product->picture, // assuming you store product picture in cart
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function updateQuantity(Request $request) {
        $cartItem = Cart::findOrFail($request->id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $subtotal = $cartItem->quantity * $cartItem->product->harga_diskon;

        return response()->json([
            'success' => true,
            'new_subtotal' => $subtotal
        ]);
    }

    public function deleteItem($id) {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari cart');
    }

}

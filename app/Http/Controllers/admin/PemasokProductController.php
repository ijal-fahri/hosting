<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class PemasokProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('staff.products.index', compact('products'));
    }

    public function create()
    {
        return view('staff.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|unique:products|numeric',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        $harga_diskon = $request->price - ($request->price * ($request->diskon / 100));
        $photoPath = $request->file('photo') ? $request->file('photo')->store('products', 'public') : null;

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $photoPath,
            'status' => $request->status,
            'diskon' => $request->diskon,
            'harga_diskon' => $harga_diskon,
        ]);

        return redirect()->route('staff.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('staff.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('staff.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|numeric|unique:products,code,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'diskon' => 'nullable|numeric|min:0|max:100',
        ]);

        $product = Product::findOrFail($id);

        if ($request->file('photo')) {
            if ($product->photo) {
                Storage::delete('public/' . $product->photo); // Hapus foto lama
            }
            $photoPath = $request->file('photo')->store('products', 'public');
            $product->photo = $photoPath;
        }

        $harga_diskon = $request->price - ($request->price * ($request->diskon / 100));

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'diskon' => $request->diskon,
            'harga_diskon' => $harga_diskon,
        ]);

        return redirect()->route('staff.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->photo) {
            Storage::delete('public/' . $product->photo);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <--- tambahkan ini

class PemasokController extends Controller
{
    public function index()
    {
        $jumlahProduk = Product::count(); // <--- hitung total produk
        return view('staff.dashboard', compact('jumlahProduk')); // <--- kirim ke view
    }
}

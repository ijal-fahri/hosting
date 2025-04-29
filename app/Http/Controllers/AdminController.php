<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product; 
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahProduk = Product::count(); 
        $jumlahPesanan = Order::count();
        $jumlahUserdanStaff = User::count();// <--- hitung total produk
        return view('admin.dashboard', compact('jumlahProduk', 'jumlahPesanan', 'jumlahUserdanStaff')); // <--- kirim ke view
    }
}

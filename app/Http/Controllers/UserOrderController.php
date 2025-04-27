<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.orders.index', compact('orders'));
    }
}
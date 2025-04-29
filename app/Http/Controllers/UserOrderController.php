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

    public function destroy(Order $order)
{
    // Pastikan hanya yang status 'Completed' boleh dihapus
    if ($order->status != 'Completed') {
        return redirect()->route('user.orders.index')->with('error', 'Pesanan ini tidak dapat dihapus.');
    }

    $order->delete();

    return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil dihapus.');
}

}
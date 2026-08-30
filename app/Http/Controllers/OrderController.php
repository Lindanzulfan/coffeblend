<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
{
    // Pastikan user hanya bisa melihat order miliknya
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $order->load('items.product');

    return view('orders.show', compact('order'));
}
}
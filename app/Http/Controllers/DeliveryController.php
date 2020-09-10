<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function complete()
    {
        $orders = Order::with('orderAssigned.rider')
            ->where('status', 6)
            ->orderBy('created_at', 'DESC')->get();
        $orders->each->append('time', 'items', 'orderStatus');
        // dd($orders);
        return view('Delivery.complete', compact('orders'));
    }

    public function progress()
    {
        $orders = Order::with('orderAssigned.rider')
            ->whereIn('status', [1, 2, 3, 4, 5])
            ->orderBy('created_at', 'DESC')->get();
        $orders->each->append('time', 'items', 'orderStatus');
        // dd($orders);
        return view('Delivery.progress', compact('orders'));
    }
}

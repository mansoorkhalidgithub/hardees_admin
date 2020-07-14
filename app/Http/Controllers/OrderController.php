<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
		$model = Order::where('status', '!=', 1)->get();
		
		return view('order/index', compact('model'));
	}
	
	public function newOrders()
	{
		$model = Order::where(['status' => 1])->get();
		
		return view('order/new-orders', compact('model'));
	}
	
	public function orderStatus()
	{
		$model = OrderStatus::all();
		
		return view('order/order-status', compact('model'));
	}
	
}

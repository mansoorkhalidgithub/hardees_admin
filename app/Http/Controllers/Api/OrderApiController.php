<?php

namespace App\Http\Controllers\Api;

// use Auth;
use App\Cart;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\MenuItem;
use App\Order;
use App\OrderItem;
use App\OrderDeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends Controller {
	
	public function __construct() {
		
	}

	public function placeOrder(Request $request) {
		$restaurantId = $request->input('restaurant_id');
		$customerId = Auth::user()->id;
		$latitude = $request->input('latitude');
		$longitude = $request->input('longitude');
		$customerAddress = $request->input('customer_address');
		$orderTypeId = $request->input('order_type_id');

		$paymentDetail = $request->input('payment_detail');
		$orderItems = $request->input('order_items');

		$deliveryCharges = $paymentDetail['delivery_charges'];
		$discount = $paymentDetail['discount'];
		$subTotal = $paymentDetail['sub_total'];
		$total = $paymentDetail['total'];
		$paymentMethodId = $paymentDetail['payment_method_id'];

		$order = [
			'restaurant_id' => $restaurantId,
			'user_id' => $customerId,
			'delivery_charges' => $deliveryCharges,
			'discount' => $discount,
			'sub_total' => $subTotal,
			'total' => $total,
			'payment_method_id' => $paymentMethodId,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'customer_address' => $customerAddress,
			'order_type_id' => $orderTypeId,
		];

		$newOrder = Order::create($order);
		$orderId = $newOrder->id;

		foreach ($orderItems as $key => $item) {
			$itemId = $item['item_id'];
			$itemPrice = $item['item_price'];
			$itemQunatity = $item['item_quantity'];

			$orderItem = [
				'order_id' => $orderId,
				'menu_item_id' => $itemId,
				'item_price' => $itemPrice,
				'item_quantity' => $itemQunatity,
			];

			OrderItem::create($orderItem);
		}

		$contact_number = '111-222-333';
		$orderReference = Helper::orderReference($orderId);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order placed successfully',
			'data' => [
				'order_reference' => $orderReference,
				'contact_number' => $contact_number,
			],
		];

		return response()->json($response);
	}

	public function addCart(Request $request)
	{
		$userId = Auth::user()->id;
		
		$data = [
			'user_id'  => $userId,
			'item_id'  => $request->item_id,
			'quantity'  => $request->quantity,
			'deal_id'  => $request->deal_id,
			'deal_quantity'  => $request->deal_quantity,
		];
		
		$cartItem = "";
		$cartDeal = "";
		if(isset($request->item_id)) {
			$cartItem = Cart::where(['user_id' => $userId, 'item_id' => $request->item_id])->first();
		}
		
		if(isset($request->deal_id)) {
			$cartDeal = Cart::where(['user_id' => $userId, 'deal_id' => $request->deal_id])->first();
		}
		
		if(!empty($cartItem)) 
		{
			$quantity = $cartItem->quantity + $request->quantity;
			$cartItem->update(['quantity' => $quantity]);
		} else if(!empty($cartDeal))
		{
			$dealQuantity = $cartDeal->deal_quantity + $request->deal_quantity;
			$cartDeal->update(['deal_quantity' => $dealQuantity]);
		}
		else 
		{
			$cart = Cart::create($data);
		}
		
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
		];
		
		return response()->json($response);
	}

	public function getCart(Request $request)
	{
		$userId = Auth::user()->id;
		
		$cart = Cart::with('item')->where('user_id', '=', $userId)
			->where('status', '=', 1)->get();
		$cart->each->append(
			'total'
		);
		
		$grandTotal = $cart->sum('total');
		
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Get Cart Successfully',
			'data' => [
				'cart' => $cart,
				'cartTotalAmount' => $grandTotal,
			]
		];
		
		return response()->json($response);		
	}
	
	public function addQuantity(Request $request)
	{
		$cart = Cart::where('id', $request->cart_id)->first();
		
		$newQuantity = 0;
		if(!empty($cart))
		{
			if(isset($request->item_id)) {
				$newQuantity = $cart->quantity + 1;
				Cart::where('id', $request->cart_id)->update(['quantity' => $newQuantity]);
			}
			if(isset($request->deal_id)) {
				$newQuantity = $cart->deal_quantity + 1;
				Cart::where('id', $request->cart_id)->update(['deal_quantity' => $newQuantity]);
			}	
		}
		
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Quantiyt updated successfully',
		];
		
		return response()->json($response);	
	}
	
	public function removeQuantity(Request $request)
	{
		$cart = Cart::where('id', $request->cart_id)->first();
		
		$newQuantity = 0;
		if(!empty($cart) && $cart->quantity > 1)
		{
			$newQuantity = $cart->quantity - 1;
			Cart::where('id', $request->cart_id)->update(['quantity' => $newQuantity]);
			
		} else {
			Cart::destroy($request->cart_id);
		}
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Quantiyt updated successfully',
		];
		
		return response()->json($response);	
	}
	
	public function deleteCart(Request $request)
	{
		$userId = Auth::user()->id;
		
		$cartItems = Cart::where('user_id', $userId)->pluck('id');
		
		Cart::destroy($cartItems);
		
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'User cart removed successfully',
		];
		
		return response()->json($response);	
	}

	public function updateCart(Request $request) {
		$data['quantity'] = $request->quantity;
		$cart = Cart::find($request->id);
		if ($request->quantity == 0) {
			$cart->delete();
			$response = [
				'status' => 1,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Cart Item Deleted Successfully',
			];
			return response()->json($response);
		} else {
			$cart->update($data);
			$menuItem = MenuItem::find($cart->item_id);
			$price = $menuItem->price;
			$response = [
				'status' => 1,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Cart Updated Successfully',
				'data' => [
					'total' => $price * $cart->quantity,
					'quantity' => $cart->quantity,
				],
			];
			return response()->json($response);
		}
	}
	
	public function checkout(Request $request)
	{
		$model = new Order;
		$modelItems = new OrderItem;
		$modelDeals = new OrderItem;
		
		$userId = Auth::user()->id;
		
		$cartItems = Cart::where('user_id', $userId)->where('item_id', '!=', null)->pluck('item_id');
		
		$menuItems = MenuItem::whereIn('id', $cartItems)->get();
		
		$cartDeals = Cart::where('user_id', $userId)->where('deal_id', '!=', null)->pluck('deal_id');
		
		$deals = MenuItem::whereIn('id', $cartDeals)->get();
		
		$cart = Cart::where('user_id', '=', $userId)
			->where('status', '=', 1)->get();
		$cart->each->append(
			'total'
		);
		
		$total = $cart->sum('total');
		
		$orderData = [
			'user_id' => $userId,
			'latitude' => $request->latitude,
			'longitude' => $request->longitude,
			'customer_address' => $request->customer_address,
			'order_type_id' => $request->order_type_id,
			'payment_method_id' => $request->payment_method_id,
			'sub_total' => $total,
			'total' => $total,
		];
		
		$newOrder = Order::create($orderData);
		$orderId = $newOrder->id;

		foreach ($menuItems as $key => $item) {
			$itemId = $item->id;
			$itemPrice = $item->price;
			$itemQunatity = $item->quantity;

			$orderItem = [
				'order_id' => $orderId,
				'menu_item_id' => $itemId,
				'item_price' => $itemPrice,
				'item_quantity' => $itemQunatity,
			];

			OrderItem::create($orderItem);
		}
		
		foreach ($deals as $key => $deal) {
			$dealId = $deal->id;
			
			$orderDeals = [
				'order_id' => $orderId,
				'deal_id' => $dealId,
				'deal_quantity' => 1,
			];

			OrderDeal::create($orderDeals);
		}

		$contact_number = '111-222-333';
		$order_reference = Helper::orderReference($orderId);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order placed successfully',
			'data' => [
				'contact_number' => $contact_number,
				'order_reference' => $order_reference,
			],
		];

		return response()->json($response);
	}
}

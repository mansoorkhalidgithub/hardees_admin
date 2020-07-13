<?php

namespace App\Http\Controllers\Api;

// use Auth;
use App\Cart;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\MenuItem;
use App\Order;
use App\OrderItem;
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
		$data = $request->all();
		
		$userId = Auth::user()->id;
		
		$data['user_id'] = $userId;
		$data['status'] = 0;
		
		$cart = Cart::create($data);
		
		$cartRefrence = Helper::orderReference($cart->id);
		
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Item add to cart successfully',
			'data' => [
				
			]
		];
		
		return response()->json($response);
	}

	public function getCart(Request $request)
	{
		$userId = Auth::user()->id;
		
		$cart = Cart::with('item')->where('user_id', '=', $userId)
			->where('status', '=', 0)->get();
		$cart->each->append(
			'total'
		);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Get Cart Successfully',
			'data' => $cart
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
}

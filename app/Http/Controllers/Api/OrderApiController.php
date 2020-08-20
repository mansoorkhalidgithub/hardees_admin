<?php

namespace App\Http\Controllers\Api;

// use Auth;

use App\Bucket;
use Log;
use App\Cart;
use App\User;
use App\Order;
use App\MenuItem;
use App\OrderDeal;
use App\OrderItem;
use Kreait\Firebase;
use App\MenuCategory;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItemVariation;
use App\Variation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class OrderApiController extends Controller
{

	public function __construct()
	{
	}

	public function placeOrder(Request $request)
	{
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
			'addon_id'  => $request->addon_id,
			'addon_quantity'  => $request->addon_quantity,
			'addon_type_id'  => $request->addon_type_id,
		];

		$cartId = "";
		$cartItem = "";
		$cartDeal = "";
		if (isset($request->item_id)) {
			$cartItem = Cart::where(['user_id' => $userId, 'item_id' => $request->item_id])->first();
		}

		if (isset($request->deal_id)) {
			$cartDeal = Cart::where(['user_id' => $userId, 'deal_id' => $request->deal_id])->first();
		}

		if (isset($request->addon_id)) {
			$cartAddon = Cart::where(['user_id' => $userId, 'addon_id' => $request->addon_id, 'addon_type_id' => $request->addon_type_id])->first();
		}

		if (!empty($cartItem)) {
			$quantity = $cartItem->quantity + $request->quantity;
			$cartItem->update(['quantity' => $quantity]);
			$cartId = $cartItem->id;
		} else if (!empty($cartDeal)) {
			$dealQuantity = $cartDeal->deal_quantity + $request->deal_quantity;
			$cartDeal->update(['deal_quantity' => $dealQuantity]);
			$cartId = $cartDeal->id;
		} else if (!empty($cartAddon)) {
			$addonQuantity = $cartAddon->addon_quantity + $request->addon_quantity;
			$cartAddon->update(['addon_quantity' => $addonQuantity]);
			$cartId = $cartAddon->id;
		} else {
			$cart = Cart::create($data);
			$cartId = $cart->id;
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
			'data' => [
				'cart_id' => $cartId
			]
		];

		return response()->json($response);
	}

	public function getCart(Request $request)
	{
		$userId = Auth::user()->id;

		$cart = Cart::with('item', 'deal')->where('user_id', '=', $userId)
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

	/* public function addQuantity(Request $request)
	{
		$version = 1;
		$cart = Cart::where('id', $request->cart_id)->first();

		$newQuantity = 0;
		if (!empty($cart)) {
			if (isset($request->item_id)) {
				$version = 3;
				$newQuantity = $cart->quantity + 1;
				Cart::where('id', $request->cart_id)->update(['quantity' => $newQuantity]);
			}
			if (isset($request->deal_id)) {
				$newQuantity = $cart->deal_quantity + 1;
				Cart::where('id', $request->cart_id)->update(['deal_quantity' => $newQuantity]);
			}
			if (isset($request->addon_id)) {
				$newQuantity = $cart->addon_quantity + 1;
				Cart::where('id', $request->cart_id)->update(['addon_quantity' => $newQuantity]);
			}
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Quantity updated successfully',
		];

		return response()->json($response);
	} */

	/* public function removeQuantity(Request $request)
	{
		$cart = Cart::where('id', $request->cart_id)->first();

		$newQuantity = 0;
		if (isset($request->item_id) && $cart->quantity > 0) {
			$newQuantity = $cart->quantity - 1;
			Cart::where('id', $request->cart_id)->update(['quantity' => $newQuantity]);
		}
		if (isset($request->deal_id) && $cart->deal_quantity > 0) {
			$newQuantity = $cart->deal_quantity - 1;
			Cart::where('id', $request->cart_id)->update(['deal_quantity' => $newQuantity]);
		}
		if (isset($request->addon_id) && $cart->addon_quantity > 0) {
			$newQuantity = $cart->addon_quantity - 1;
			Cart::where('id', $request->cart_id)->update(['addon_quantity' => $newQuantity]);
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Quantity updated successfully',
		];

		return response()->json($response);
	} */

	public function removeCartItem(Request $request)
	{
		Cart::destroy($request->cart_id);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Item removed successfully',
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

	public function updateCart(Request $request)
	{
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

		$cartItems = $cart->pluck('id');

		Cart::destroy($cartItems);

		$rider = User::where('user_type', 'rider')->first();

		$rider = User::where('user_type', 'rider')->first();
		$deviceToken = $rider->device_token;

		Log::info($deviceToken);

		$riderNotificationData = [
			"order_id" => $orderId,
			"device_token" => $deviceToken,
			"status" => "TR",
			"message" => "New Order Assigned"
		];

		$restaurantNotificationData = [
			"order_id" => $orderId,
			"device_token" => $deviceToken,
			"status" => 1,
			"message" => "New Order"
		];

		$notification = Helper::sendNotification($riderNotificationData);

		//Helper::sendNotification($restaurantNotificationData);

		$contact_number = '111-222-333';
		$order_reference = Helper::orderReference($orderId);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order placed successfully',
			'data' => [
				'contact_number' => $contact_number,
				'order_reference' => $order_reference,
				'rider_id' => $rider->id,
				'notification' => json_decode($notification),
			],
		];

		return response()->json($response);
	}

	public static function notification(Request $request)
	{
		try {
			echo Helper::sendNotification($request->order_id, $request->device_token);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getMenu(Request $request)
	{
		$categories = MenuCategory::all();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Categories Fetched successfully',
			'categories' => $categories,
		];

		return response()->json($response);
	}

	public function getMenuItems(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'item_id' => 'required',
		]);
		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'errors' => $validator->messages()
			];

			return response()->json($response);
		}
		$id = $request->item_id;
		$category = MenuCategory::find($id);
		if ($category->name == 'deals')
			$items = [];

		else
			$items = MenuItem::where('menu_category_id', $id)->get();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Items Fetched successfully',
			'items' => $items,
		];

		return response()->json($response);
	}


	public function variations(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'item_id' => 'required',
		]);
		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'errors' => $validator->messages()
			];

			return response()->json($response);
		}
		$item_id = $request->item_id;
		$variations = ItemVariation::with('variation', 'addon')->where('menu_item_id', $item_id)->get();
		$variations->each->append('drinks', 'sides', 'extras');
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Variation Fetched successfully',
			'variations' => $variations,
		];

		return response()->json($response);
	}


	public function addBucket(Request $request)
	{
		$userId = Auth::user()->id;
		$validator = Validator::make($request->all(), [
			'item_id' => 'required',
			'variation_id' => 'required',
			'quantity' => 'required',
		]);
		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'errors' => $validator->messages()
			];

			return response()->json($response);
		}
		$addons = "";
		if (!empty($request->addons) && count($request->addons) > 0) {
			$addons = serialize($request->addons);
		}

		$data = [
			'user_id' => $userId,
			'item_id' => $request->item_id,
			'variation_id' => $request->variation_id,
			'drink_id' => $request->drink_id,
			'side_id' => $request->side_id,
			'extra_id' => $request->extra_id,
			'quantity' => $request->quantity,
			'addons' => $addons,
		];

		$bucket = Bucket::create($data);
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
			'data' => [
				'cart_id' => $bucket->id
			]
		];

		return response()->json($response);
	}

	public function getBucket(Request $request)
	{
		$user = Auth::user();
		$bucket = Bucket::where('user_id', $user->id)->where('status', 1)->get();
		$bucket->each->append('total', 'addon');
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
			'data' => $bucket
		];

		return response()->json($response);
	}

	public function addQuantity(Request $request)
	{
		$bucket = Bucket::where('id', $request->bucket_id)->first();

		$newQuantity = 0;
		if (!empty($bucket)) {
			$newQuantity = $bucket->quantity + 1;
			Bucket::where('id', $request->bucket_id)->update(['quantity' => $newQuantity]);
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Quantity updated successfully',
		];

		return response()->json($response);
	}

	public function removeQuantity(Request $request)
	{
		$bucket = Bucket::where('id', $request->bucket_id)->first();

		$newQuantity = 0;
		if (!empty($bucket)) {
			$newQuantity = $bucket->quantity - 1;
			if ($newQuantity > 0) {
				Bucket::where('id', $request->bucket_id)->update(['quantity' => $newQuantity]);
				$message = 'Quantity updated successfully';
			} else {
				$bucket->delete();
				$message = 'Cart Item Deleted successfully';
			}
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => $message,
		];

		return response()->json($response);
	}
}

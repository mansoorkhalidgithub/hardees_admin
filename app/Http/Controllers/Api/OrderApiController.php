<?php

namespace App\Http\Controllers\Api;

// use Auth;

use App\Bucket;
use Log;
use App\Cart;
use App\DealVariation;
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
use App\OrderAssigned;
use App\OrderVariation;
use App\Restaurant;
use App\Tracking;
use App\Transaction;
use App\Variation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
		$orderCheck = Order::select('id','status')->where([
		    ['user_id', '=', $customerId],
		    ['status', '<>', 6],
		])->limit(1)->get();


		if(!$orderCheck->isEmpty()){
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'You already have an active order',
			];

			return response()->json($response);
		}
		$latitude = $request->input('latitude');
		$longitude = $request->input('longitude');
		$customerAddress = $request->input('customer_address');
		$orderTypeId = $request->input('order_type_id');

		$paymentDetail = $request->input('payment_detail');
		$orderItems = $request->input('order_items');

		$deliveryCharges = $paymentDetail['delivery_charges'];
		$discount = $paymentDetail['discount'];
		$subTotal = $paymentDetail['sub_total'];
		$total = $paymentDetail['total']-30;
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

	public function customerReorder(Request $request)
	{
		$orderId = $request->id;
		$customerId = Auth::user()->id;

		$order = Order::find($orderId);
		$orderVariation = OrderVariation::where('order_id',$orderId)->get();

		if($orderId == ''){
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Id Required',
			];
			return response()->json($response);
		}

		foreach ($orderVariation as $key => $value) {
			$bucket = new Bucket;
			$bucket->user_id = $value->user_id;
			$bucket->item_id = $value->item_id;
			$bucket->variation_id = $value->variation_id;
			$bucket->drink_id = $value->drink_id;
			$bucket->side_id = $value->side_id;
			$bucket->extra_id = $value->extra_id;
			$bucket->quantity = $value->quantity;
			$bucket->addons = $value->addons;
			$bucket->deal_id = $value->deal_id;
			$bucket->deal_drinks = $value->deal_drinks;
			$bucket->save();
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Item Added Successfully',
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

	/* public function checkout(Request $request)
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
	} */

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
		$categories = MenuCategory::where('web_status', 1)->orderBy('sequence', 'asc')->get();
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
			'category_id' => 'required',
		]);
		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'errors' => $validator->messages()
			];

			return response()->json($response);
		}
		$id = $request->category_id;
		$category = MenuCategory::find($id);
		if ($category->name == 'Deals') {
			$items = MenuItem::where('menu_category_id', $id)->where('web_status', 1)->get();
			$message = 'Deals Fetched successfully';
		} else {
			$items = MenuItem::where('menu_category_id', $id)->where('web_status', 1)->get();
			$message = 'Items Fetched successfully';
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => $message,
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
		$getcat = MenuItem::find($item_id)->menu_category_id;
		$category = MenuCategory::find($getcat);
		if ($category->name != 'Deals') {
			$variations = ItemVariation::with('variation', 'addon')->where('menu_item_id', $item_id)->get();
			$variations->each->append('drinks', 'sides', 'extras');
		} else {
			$variations = DealVariation::with('addon')->where('menu_item_id', $item_id)->first();
            if(!empty($variations))
                $variations->append('drinks');
		}
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
			// 'variation_id' => 'required',
			'quantity' => 'required',
		]);
		// dd($request->all());
		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'errors' => $validator->messages()
			];
			return response()->json($response);
		}
		$data = $request->all();
		$addons = "";
		if (!empty($request->addons)) {
			$addons = serialize(json_decode($request->addons));
		}
		$getcat = MenuItem::find($request->item_id)->menu_category_id;
		$category = MenuCategory::find($getcat);
		if ($category->name != 'Deals') {
			$model = Bucket::where('user_id', $userId)
				->where('item_id', $request->item_id)
				->where('addons', $addons)
				->where('variation_id', $request->variation_id)
				->first();
			$data['item_id'] = $request->item_id;
		} else {
			$deal_drinks = "";
			if (!empty($request->drinks)) {
				$deal_drinks = serialize(json_decode($request->drinks));
			}
			$model = Bucket::where('user_id', $userId)
				->where('deal_id', $request->item_id)
				->where('addons', $addons)
				->where('deal_drinks', $deal_drinks)
				->first();
			if ($model) {
				$model->update(['quantity' => $model->quantity + $request->quantity]);
				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'success',
				];
				return response()->json($response);
			}
			$data['deal_id'] = $request->item_id;
			$data['deal_drinks'] = $deal_drinks;
		}
		if ($model) {
			if (isset($request->drink_id, $request->side_id, $request->extra_id)) {
				if ($model->drink_id == $request->drink_id && $model->side_id == $request->side_id && $model->extra_id == $request->extra_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->side_id, $request->extra_id)) {
				if ($model->side_id == $request->side_id && $model->extra_id == $request->extra_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->drink_id, $request->extra_id)) {
				if ($model->drink_id == $request->drink_id && $model->extra_id == $request->extra_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->drink_id, $request->side_id)) {
				if ($model->drink_id == $request->drink_id && $model->side_id == $request->side_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->side_id)) {
				if ($model->side_id == $request->side_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->drink_id)) {
				if ($model->drink_id == $request->drink_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} elseif (isset($request->extra_id)) {
				if ($model->extra_id == $request->extra_id) {
					$model->update(['quantity' => $model->quantity + $request->quantity]);
					$response = [
						'status' => 1,
						'method' => $request->route()->getActionMethod(),
						'message' => 'success',
					];
					return response()->json($response);
				}
			} else {
				$model->update(['quantity' => $model->quantity + $request->quantity]);
				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'success',
				];
				return response()->json($response);
			}
		}

		$data['user_id'] = $userId;
		$data['addons'] = $addons;

		Bucket::create($data);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
		];


		return response()->json($response);
	}

	public function getBucket(Request $request)
	{
		$user = Auth::user();
		$bucket = Bucket::where('user_id', $user->id)->where('status', 1)->get();
		$bucket->each->append('total', 'addon', 'deal_drink','item','drink','extra','side');
		$vat = $bucket->sum('total') * .0;
		$delivery_charges = 0;
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'success',
			'data' => $bucket,
			'sub_total' => $bucket->sum('total'),
			'delivery_charges' => $delivery_charges,
			'vat' => $vat,
			'total_amount' => $bucket->sum('total') + $delivery_charges + $vat,
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

	public function cartCount(Request $request)
	{
		$userId = (Auth::user()) ? Auth::user()->id : -1;

		$bucket = Bucket::where('user_id', '=', $userId)

			->where('status', '=', 1)->sum('quantity');

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Success',
			'count' => $bucket,
		];
		return response()->json($response);
	}

	public function checkout(Request $request)
	{

		$userId = Auth::user()->id;
		$orderCheck = Order::select('id','status')->where([
		    ['user_id', '=', $userId],
		    ['status', '<>', 6],
		])->limit(1)->get();


		if(!$orderCheck->isEmpty()){
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'You already have an active order',
			];

			return response()->json($response);
		}


		$bucket = Bucket::where('user_id', '=', $userId)
			->where('status', '=', 1)->get();
		if ($bucket->isEmpty()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Please Choose Items',

			];

			return response()->json($response);
		}
		$bucket->each->append(
			'total'
		);
		$restaurant_id = $this->nearestRestaurant($request->latitude, $request->longitude);
		$total = $bucket->sum('total');
		if ($restaurant_id) {
			$orderData = [
				'user_id' => $userId,
				'restaurant_id' => $restaurant_id,
				'latitude' => $request->latitude,
				'longitude' => $request->longitude,
				'customer_address' => $request->customer_address,
				'order_type_id' => 4,
				'payment_method_id' => $request->payment_method_id,
				'sub_total' => $total,
				'total' => $total,
			];
			$newOrder = Order::create($orderData);
			$orderId = $newOrder->id;
			$customerNotification = [
				"order_id" => $orderId,
				"device_token" => Auth::user()->device_token,
				"status" => 1,
				"message" => "Order Placed Successfully"
			];
			Helper::sendNotification($customerNotification);
			foreach ($bucket as $key => $entry) {
				$data = [
					'order_id' => $orderId,
					'user_id' => $userId,
					'item_id' => $entry->item_id,
					'variation_id' => $entry->variation_id,
					'drink_id' => $entry->drink_id,
					'side_id' => $entry->side_id,
					'extra_id' => $entry->extra_id,
					'quantity' => $entry->quantity,
					'addons' => $entry->addons,
				];
				OrderVariation::create($data);
			}
			// dd(count($data));
			$bucketIds = $bucket->pluck('id');
			Bucket::destroy($bucketIds);
			$restaurantUsers = User::role('user')->where('restaurant_id', $restaurant_id)->get();

			foreach ($restaurantUsers as $user) {
				$restaurantNotificationData = [
					"order_id" => $orderId,
					"device_token" => $user->device_token,
					"status" => 'TR',
					"message" => "New Order Arrived"
				];

				Helper::sendNotification($restaurantNotificationData);
				break;
			}
		}
		$riderId = $this->nearestRider($restaurant_id);
		if ($riderId) {
			$assignData = [
				'order_id' => $orderId,
				'rider_id' => $riderId,
				'trip_status_id' => 1,
			];
			$rider = User::find($riderId);
			$riderNotificationData = [
				"order_id" => $orderId,
				"device_token" => $rider->device_token,
				"status" => "TR",
				"message" => "New Order Assigned"
			];

			Helper::sendNotification($riderNotificationData);
			$modelAssign = new OrderAssigned();

			$modelAssign->create($assignData);
		}
		$order_reference = Helper::orderReference($orderId);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order placed successfully',
			'data' => [
				'contact_number' => Auth::user()->phone_number,
				'order_reference' => $order_reference,
				// 'rider_id' => $rider->id,
				// 'notification' => json_decode($notification),
			],
		];

		return response()->json($response);
	}

	protected function nearestRestaurant($latitude, $longitude)
	{
		$nearestRestaurants = Restaurant::select(
			"*",
			DB::raw("6371 * acos(cos(radians(" . $latitude . "))
				* cos(radians(restaurants.latitude))
				* cos(radians(restaurants.longitude) - radians(" . $longitude . "))
				+ sin(radians(" . $latitude . "))
				* sin(radians(restaurants.latitude))) AS nearest")
		)
			->where(['status' => 1])
			->having('nearest', '<', 10)
			->orderBy("nearest", 'asc')
			->limit(1)
			->get();
		// echo "<pre>";
		// print_r($nearestRestaurants[0]->id);
		// exit;
		return $nearestRestaurants[0]->id;
	}

	protected function nearestRider($restaurantId)
	{

		$availableRiderId = "";

		$restaurantRiders = User::role('rider')->where('restaurant_id', $restaurantId)->get();

		// dd($restaurantRiders);
		foreach ($restaurantRiders as $key => $rider) {

			if ($rider->getRiderStatus->trip_status == 'free' && $rider->getRiderStatus->online_status == 'online') {

				$availableRiderId = $rider->id;
				// Help
				break;
			}
		}
		return $availableRiderId;
	}

	public function currentOrder(Request $request)
	{
		$model = Order::with('restaurant', 'orderVariations')->where('user_id', Auth::user()->id)
			->whereIn('status', [1, 2, 3, 4, 5])->where('order_type_id', 4)->first();
		if (!empty($model)) {
			$model->append('orderStatus', 'orderItems', 'riderAsigned');
			$flag = 'yes';
		} else {
			$flag = 'no';
		}
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Current Order Fetched successfully',
			'flag' => $flag,
			'current_order' => $model,
		];

		return response()->json($response);
	}

	public function ordersHistory(Request $request)
	{
		$model = Order::with('restaurant')->where('user_id', Auth::user()->id)
			->where('status', 6)
			->where('order_type_id', 4)->get();
		if (!empty($model))
			$model->each->append('orderStatus', 'orderItems', 'riderAsigned');
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Orders History Fetched successfully',
			'current_order' => $model,
		];

		return response()->json($response);
	}


	public function trackorder(Request $request)
	{
		$model = Order::with('restaurant')->where('user_id', Auth::user()->id)
			->whereIn('status', [1, 2, 3, 4, 5])->where('order_type_id', 4)->first();
		$track_rider = [];
		if (!empty($model)) {
			$model->append('riderAsigned');
			$track_rider = Tracking::where('order_id', $model->id)->first();
		}
		$rider_lat = ($track_rider) ? $track_rider->current_lat : $model->restaurant->latitude;
		$rider_lng = ($track_rider) ? $track_rider->current_lng : $model->restaurant->longitude;;
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Tracking',
			'data' => [
				'start_lat' => $model->restaurant->latitude,
				'start_lng' => $model->restaurant->longitude,
				'end_lat' => $model->latitude,
				'end_lng' => $model->longitude,
				'rider_lat' => $rider_lat,
				'rider_lng' => $rider_lng,
				'rider' => $model->riderAsigned
			]
		];

		return response()->json($response);
	}
	public function getDeals(Request $request)
	{
		$deals = MenuItem::where('menu_category_id', 10)->where('web_status', 1)->get();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Deals Fetched successfully',
			'deals' => $deals,
		];

		return response()->json($response);
	}

    public function testNoti(Request $request){
        $id =Auth::user()->id;
		$user = User::find($id);
		// $user->device_token;
		$restaurantNotificationData = [
			"order_id" => 2292,
			"device_token" => $user->device_token,
			"status" => 1,
			"message" => "New Order Arrived"
		];

		Helper::sendNotification($restaurantNotificationData);
		return response()->json($restaurantNotificationData);
    }
}

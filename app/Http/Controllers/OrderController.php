<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Helper;
use App\Cart;
use App\Deal;
use App\User;
use App\Addon;
use App\Order;
use App\MenuItem;
use App\AddonType;
use App\OrderDeal;
use App\OrderItem;
use App\OrderAddon;
use App\Restaurant;
use App\OrderStatus;
use App\OrderAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$model = Order::where('status', '!=', 1)->orderBy('created_at', 'DESC')->get();

		return view('order/index', compact('model'));
	}

	public function edit(Request $request)
	{
		$orderId = $request->id;
		$order = Order::with('orderItems', 'orderDeals', 'orderAddons')->where('id', $orderId)->first();

		if ($order->user_id) {
			$customer = User::where('id', $order->user_id)->first();
		}
		if ($request->rider_id) {
			$riderId = decrypt($request->rider_id);
			$rider = User::where('id', $riderId)->first();
		}

		return view('order/edit', compact('order', 'rider', 'customer'));
	}

	public function view(Request $request)
	{
		$rider = [];
		$customer = [];
		$orderId =  $request->id;

		$order = Order::with('orderItems', 'orderDeals', 'orderAddons')->where('id', $orderId)->first();

		if ($order->user_id) {
			$customer = User::where('id', $order->user_id)->first();
		}
		if ($request->rider_id) {
			$riderId = decrypt($request->rider_id);
			$rider = User::where('id', $riderId)->first();
		}

		return view('order/view', compact('order', 'rider', 'customer'));
	}

	public function newOrders()
	{
		$model = Order::where(['status' => 1])->orderBy('created_at', 'DESC')->get();

		return view('order/new-orders', compact('model'));
	}

	public function orderStatus()
	{
		$model = OrderStatus::all();

		return view('order/order-status', compact('model'));
	}

	public function nearestRestaurant(Request $request)
	{
		$nearestRestaurants = Restaurant::select(
			"*",
			DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
			* cos(radians(restaurants.latitude))
			* cos(radians(restaurants.longitude) - radians(" . $request->longitude . "))
			+ sin(radians(" . $request->latitude . "))
			* sin(radians(restaurants.latitude))) AS nearest")
		)
			->where(['status' => 1])
			->having('nearest', '<', 10)
			->orderBy("nearest", 'asc')
			//->limit(1)
			->get();

		if (count($nearestRestaurants) > 0) {
			$restaurantHtml = '<select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="restaurant_id" required>';
			foreach ($nearestRestaurants as $key => $restaurant) {
				$restaurantHtml .= '<option value="' . $restaurant->id . '">' . $restaurant->name . '</option>';
			}
			$restaurantHtml .= '</select>';

			$restaurantRiders = User::role('rider')->where('restaurant_id', $nearestRestaurants[0]->id)->get();

			$riderHtml = '<select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="rider_id">';
			foreach ($restaurantRiders as $key => $rider) {
				if ($rider->getRiderStatus->trip_status == 'free') {
					$riderHtml .= '<option value="' . $rider->id . '">' . $rider->name . '</option>';
				}
			}
			$riderHtml .= '</select>';
		} else {
			$restaurantHtml = '<select style="margin-bottom: 10px; border-radius: 0px" required class="form-control"><option value=""> Select Branch </option></select>';
			$riderHtml = '<select style="margin-bottom: 10px; border-radius: 0px" required class="form-control"><option value=""> Select Rider </option></select>';;
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Nearest Restaurant And Rider',
			'data' => [
				'nearestRestaurants' => $restaurantHtml,
				'restaurantRiders' => $riderHtml
			]
		];

		return response()->json($response);
	}

	public function searchCustomer(Request $request)
	{
		$output = '';
		$data = [];
		if (isset($request["term"])) {

			$customerIds = User::role('customer')->pluck('id')->all();

			if (count($customerIds) > 0) {

				$customers = User::role('customer')->where('phone_number', $_REQUEST['term'])->orwhere('first_name', $_REQUEST['term'])->orwhere('email', $_REQUEST['term'])->get();

				foreach ($customers as $key => $customer) {

					if (in_array($customer->id, $customerIds, true)) {

						$orderRecord = Order::where(['user_id' => $customer->id])->first();

						if (!empty($orderRecord)) {
							$data[$customer->phone_number] = $customer->first_name . "|" . $customer->last_name . "|" . $customer->phone_number . "|" . $orderRecord->customer_address;
						} else {
							$data[$customer->phone_number] = $customer->first_name . "|" . $customer->last_name . "|" . $customer->phone_number . "|" . " ";
						}
					}
				}
			}
		}

		echo json_encode($data);
	}

	public function save(Request $request)
	{
		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$phone = $request->phone;
		$address = $request->address;
		$latitude = $request->latitude;
		$longitude = $request->longitude;
		$dropLocation = $request->drop_off_location;

		$restaurantId = $request->restaurant_id;
		$riderId = $request->rider_id;

		$model = new User;
		$modelOrder = new Order;
		$modelOrderItem = new OrderItem;

		$customerData = [
			'first_name' => $first_name,
			'last_name' => $last_name,
			'phone_number' => $phone,
			'user_type' => 'customer',
			'latitude' => $latitude,
			'longitude' => $longitude,
			'address' => $address,
		];

		$customer = User::role('customer')->where('phone_number', $phone)->first();

		if (!empty($customer)) {
			$customer->update($customerData);
		} else {
			$customer = User::create($customerData);
			$customer->assignRole('customer');
		}

		$userId = Auth::user()->id;

		$cart = Cart::where('user_id', '=', $userId)
			->where('status', '=', 1)->get();

		$cart->each->append(
			'total'
		);

		$cartItems = Cart::select('item_id', 'quantity')->where('item_id', '!=', null)->get();
		$cartDeals = Cart::select('deal_id', 'deal_quantity')->where('deal_id', '!=', null)->get();
		$cartAddons = Cart::select('addon_id', 'addon_quantity', 'addon_type_id')->where('addon_id', '!=', null)->get();

		$total = $cart->sum('total');

		$orderData = [
			'user_id' => $customer->id,
			'restaurant_id' => $restaurantId,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'customer_address' => $address,
			'order_type_id' => 1,
			'payment_method_id' => 1,
			'sub_total' => $total,
			'total' => $total,
		];

		$newOrder = Order::create($orderData);
		$orderId = $newOrder->id;

		foreach ($cartItems as $key => $cartItem) {
			if ($cartItem->item_id) {
				$item = MenuItem::where('id', $cartItem->item_id)->first();
				$itemId = $item->id;
				$itemPrice = $item->price;
				$itemQunatity = $cartItem->quantity;

				$orderItem = [
					'order_id' => $orderId,
					'menu_item_id' => $itemId,
					'item_price' => $itemPrice,
					'item_quantity' => $itemQunatity,
				];

				OrderItem::create($orderItem);
			}
		}

		foreach ($cartDeals as $key => $cartDeal) {
			if ($cartDeal->deal_id) {
				$deal = Deal::where('id', $cartDeal->deal_id)->first();
				$dealId = $deal->id;
				$dealPrice = $deal->price;
				$dealQunatity = $cartDeal->deal_quantity;

				$orderDeal = [
					'order_id' => $orderId,
					'deal_id' => $dealId,
					'deal_quantity' => $dealQunatity,
				];

				OrderDeal::create($orderDeal);
			}
		}

		foreach ($cartAddons as $key => $cartAddon) {
			if ($cartAddon->addon_id) {
				$addon = Addon::where('id', $cartAddon->addon_id)->first();
				$addonId = $addon->id;
				$addonQunatity = $cartAddon->addon_quantity;
				$addonTypeId = $cartAddon->addon_type_id;

				$addonType = AddonType::where('id', $addonTypeId)->first();

				$orderAddon = [
					'order_id' => $orderId,
					'addon_id' => $addonId,
					'price' => $addonType->price,
					'addon_quantity' => $addonQunatity,
				];

				OrderAddon::create($orderAddon);
			}
		}

		$cartIds = $cart->pluck('id');

		Cart::destroy($cartIds);

		/*********** Order Assign ************/

		if ($riderId) {
			$assignData = [
				'order_id' => $orderId,
				'rider_id' => $riderId,
				'trip_status_id' => 1,
			];

			$modelAssign = new OrderAssigned;

			$modelAssign->create($assignData);
		}


		/*********** Order Assign ************/

		$order = Order::with('orderItems')->where('id', $orderId)->first();

		return redirect()->route('order-summary',  ['order_id' => encrypt($order->id), 'rider_id' => encrypt($riderId)]);
	}

	public function summary(Request $request)
	{
		$rider = [];
		$customer = [];
		$orderId = decrypt($request->order_id);

		$order = Order::with('orderItems', 'orderDeals', 'orderAddons')->where('id', $orderId)->first();

		if ($order->user_id) {
			$customer = User::where('id', $order->user_id)->first();
		}
		if ($request->rider_id) {
			$riderId = decrypt($request->rider_id);
			$rider = User::where('id', $riderId)->first();
		}

		return view('order/summary', compact('order', 'rider', 'customer'));
	}

	public function notification(Request $request)
	{
		$orderId = $request->order_id;
		$restaurantId = $request->restaurant_id;
		$riderId = $request->rider_id;
		$deductionAmount = $request->deduction_amount;

		$order = Order::where('id', $orderId)->first();

		if ($deductionAmount) {
			$newTotal = $order->total - $deductionAmount;
			$order->update(['total' => $newTotal]);
		}

		$number = $order->customer->phone_number;
		$name = $order->customer->first_name;
		$orderReference = Helper::orderReference($orderId);

		$message = "Mr/Miss,%20" . $name . "%20your%20order%20" . $orderReference . "%20has%20been%20placed.%20Thank%20you";

		$messageData = [
			'number' => $number,
			'name' => $name,
			'order' => $orderReference,
			'message' => $message,
		];

		$restaurantUsers = User::role('user')->where('restaurant_id', $restaurantId)->get();

		$rider = User::where('id', $riderId)->first();

		$notification = "";
		if (!empty($rider) && $rider->device_token) {
			$riderNotificationData = [
				"order_id" => $orderId,
				"device_token" => $rider->device_token,
				"status" => "TR",
				"message" => "New Order Assigned"
			];

			$notification = Helper::sendNotification($riderNotificationData);
		}

		sleep(3);

		$notificationOne = "";
		foreach ($restaurantUsers as $user) {
			$restaurantNotificationData = [
				"order_id" => $orderId,
				"device_token" => $user->device_token,
				"status" => 1,
				"message" => "New Order Arrived"
			];

			$notificationOne = Helper::sendNotification($restaurantNotificationData);
		}

		$responseMessage = Helper::sendMessage($messageData);

		$responseData = [
			'code' => 1,
			'message' => "Notifications sent successfully.",
			'riderNotification' => json_decode($notification),
			'restaurantNotification' => json_decode($notificationOne),
			'restaurantUsers' => count($restaurantUsers),
			'responseMessage' => $responseMessage
		];

		echo json_encode($responseData);
	}

	public function resend($id)
	{
		$orderId = $id;
		$order = Order::with('orderItems', 'orderDeals', 'orderAddons')->where('id', $orderId)->first();
		$rider_id = $order->orderAssigned->rider_id;
		$change_assigned_status = OrderAssigned::where('rider_id', $rider_id)
			->where('trip_status_id', '=', 8)->orwhere('trip_status_id', '=', 9)
			->where('status', 1)->first();
		$change_assigned_status->status = 0;
		// $change_assigned_status->save();

		if ($order->user_id) {
			$customer = User::where('id', $order->user_id)->first();
		}
		if ($rider_id) {
			// $riderId = decrypt(2);
			$riders = User::role('rider')->where('id', '!=', $rider_id)
				->where('restaurant_id', $order->restaurant_id)->get();
		}
		// dd($riders->count());
		// exit;

		return view('order/resend', compact('order', 'riders', 'customer'));
	}

	public function resendOrder(Request $request)
	{
		$ids = OrderAssigned::where('order_id', $request->order_id)->pluck('id');
		OrderAssigned::whereIn('id', $ids)->update(['status' => 0]);
		$rider = User::where('id', $request->rider)->first();
		$data = [
			'order_id' => $request->order_id,
			'rider_id' => $rider->id,
			'trip_status_id' => 1
		];
		OrderAssigned::create($data);
		$notification = "";
		if (!empty($rider) && $rider->device_token) {
			$riderNotificationData = [
				"order_id" => $request->order_id,
				"device_token" => $rider->device_token,
				"status" => "TR",
				"message" => "New Order Assigned"
			];

			$notification = Helper::sendNotification($riderNotificationData);
		}

		sleep(3);

		return Redirect::route('orders');
	}
}

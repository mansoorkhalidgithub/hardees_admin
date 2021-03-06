<?php

namespace App\Http\Controllers;

use Log;
use App\Cart;
use App\Deal;
use App\User;
use App\Addon;
use App\Order;
use App\Rider;
use App\Bucket;
use App\MenuItem;
use App\AddonType;
use App\OrderDeal;
use App\OrderItem;
use App\OrderAddon;
use App\Restaurant;
use App\MasterModel;
use App\OrderStatus;
use App\RiderStatus;
use App\OrderAssigned;
use App\Helpers\Helper;
use App\OrderVariation;
use App\Template;
use App\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{

	public function __construct()
	{
	}

	public function index()
	{
		return view('order/index');
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

		$model = Order::where(['status' => 1])->orderBy('id', 'DESC')->get();

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

				if ($rider->getRiderStatus->trip_status == 'free' && $rider->getRiderStatus->online_status == 'online') {

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

			MasterModel::freetoride($riderId); // set to on delivery current rider

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

		$message = Template::find(1);
		$body = str_replace('{{MEMBER_NAME}}', $name, $message->message);
		$body = str_replace('{{COMPANY_NAME}}', env('APP_NAME'), $body);
		$body = str_replace('{{APP_URL}}', "http://hardeeswebsite.mindtech.pk/tracking/" . $orderId, $body);
		$body = str_replace('{{ORDER_NUMBER}}', $orderReference, $body);
		$body = str_replace('<p>', '%20', $body);
		$body = str_replace('</p>', '%20', $body);
		$body = str_replace(' ', '%20', $body);
		$message_data = [
			'number' => $number,
			'message' => $body
		];
		Helper::sendMessage($message_data);

		$restaurantUsers = User::role('user')->where('restaurant_id', $restaurantId)->get();

		$rider = User::where('id', $riderId)->first();

		$notification = "";

		if (!empty($rider) && $rider->device_token && $order->order_type_id == 1) {

			$riderNotificationData = [

				"order_id" => $orderId,

				"device_token" => $rider->device_token,

				"status" => "TR",

				"message" => "New Order Assigned"

			];

			$notification = Helper::sendNotification($riderNotificationData, $rider->device_type);
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

			Tracking::create([
				'order_id' => $orderId,
				'current_lat' => $order->restaurant->latitude,
				'current_lng' => $order->restaurant->longitude
			]);
			$notificationOne = Helper::sendNotification($restaurantNotificationData, '');
		}

		$message = Template::find(1);
		$body = str_replace('{{MEMBER_NAME}}', $name, $message->message);
		$body = str_replace('{{COMPANY_NAME}}', env('APP_NAME'), $body);
		$body = str_replace('{{APP_URL}}', "http://hardeeswebsite.mindtech.pk/tracking/" . $orderId, $body);
		$body = str_replace('{{ORDER_NUMBER}}', 45, $body);
		$body = str_replace('<p>', '%20', $body);
		$body = str_replace('</p>', '%20', $body);
		$body = str_replace(' ', '%20', $body);
		$message_data = [
			'number' => $number,
			'message' => $body
		];
		Helper::sendMessage($message_data);
		$responseData = [

			'code' => 1,

			'message' => "Notifications sent successfully.",

			'riderNotification' => json_decode($notification),

			'restaurantNotification' => json_decode($notificationOne),

			'restaurantUsers' => count($restaurantUsers),

			'responseMessage' => $message_data

		];

		echo json_encode($responseData);
	}

	public function resend($id)
	{

		$orderId = $id;

		$order = Order::with('orderItems', 'orderDeals', 'orderAddons')->where('id', $orderId)->first();

		// $rider_ids = OrderAssigned::where('order_id', $id)

		// 	->where('trip_status_id', '=', 8)->pluck('rider_id');

		if ($order->user_id) {

			$customer = User::where('id', $order->user_id)->first();
		}

		// if ($rider_ids) {

		$riders = User::role('rider')

			// ->whereNotIn('id',  $rider_ids)

			->where('restaurant_id', $order->restaurant_id)->get();

		// }

		return view('order/resend', compact('order', 'riders'));
	}

	public function resendOrder(Request $request)
	{

		$ids = OrderAssigned::where('order_id', $request->order_id)->pluck('id');

		OrderAssigned::whereIn('id', $ids)->update(['status' => 0]);

		$rider = User::role('rider')->where('id', $request->rider)->first();

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

			$notification = Helper::sendNotification($riderNotificationData, $rider->device_type);
		}

		sleep(3);

		return Redirect::route('orders');
	}

	public function saveOrder(Request $request)
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

		$userId = Auth::user()->id;

		$customer = User::where('id', $userId)->where('user_type', 'customer')->first();

		if (!empty($customer)) {

			$customer->update($customerData);
		} else {

			$customer = User::create($customerData);

			$customer->assignRole('customer');
		}



		$bucket = Bucket::where('user_id', '=', $userId)

			->where('status', '=', 1)->get();

		$bucket->each->append(

			'total'

		);

		$total = $bucket->sum('total');

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

				'deal_id' => $entry->deal_id,

				'deal_drinks' => $entry->deal_drinks

			];

			OrderVariation::create($data);
		}

		$bucketIds = $bucket->pluck('id');

		Bucket::destroy($bucketIds);

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

		$order = Order::with('orderVariations')->where('id', $orderId)->first();

		return redirect()->route('order-summary',  ['order_id' => encrypt($order->id), 'rider_id' => encrypt($riderId)]);
	}

	public function tripStatus($id)
	{
		$model = OrderAssigned::where('order_id', $id)
			->whereIn('trip_status_id', [2, 3, 4])->first();
		$model->update(['trip_status_id' => 11, 'status' => 0]);
		$order = Order::find($id);
		$order->status = 6;
		$order->save();

		// dd($order->status);

		$riderstatus = RiderStatus::where('rider_id', $model->rider_id)

			->where('status', 1)->first();

		$st = ($riderstatus->trip_status == 'ontrip' ? 'free' : 'free');

		$riderstatus->trip_status = $st;

		$riderstatus->save();
		$rider = User::find($riderstatus->rider_id);
		if (!empty($rider) && $rider->device_token) {

			$riderNotificationData = [

				"order_id" => $id,

				"device_token" => $rider->device_token,

				"status" => "RT",

				"message" => "Released From Trip"

			];

			$notification = Helper::sendNotification($riderNotificationData, $rider->device_type);
		}

		return redirect()->back();
	}

	public function removeOrderItem(Request $request)
	{
		$orderId = $request->order_id;
		$orderVeriationId = $request->order_variation_id;

		$order = Order::where('id', $orderId)->first();

		$orderVariation = OrderVariation::where('id', $orderVeriationId)->first();

		//echo $orderVariation->total;exit;

		$newTotal = $order->total - $orderVariation->total;

		Order::where('id', $orderId)->update(['sub_total' => $newTotal, 'total' => $newTotal]);

		OrderVariation::where('id', $orderVeriationId)->delete();

		echo json_encode(['code' => 200, 'message' => 'success']);
	}
}

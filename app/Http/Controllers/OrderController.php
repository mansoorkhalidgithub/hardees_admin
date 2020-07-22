<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Helper;
use App\Cart;
use App\User;
use App\Order;
use App\MenuItem;
use App\OrderAssigned;
use App\OrderItem;
use App\Restaurant;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
	
	public function nearestRestaurant(Request $request)
	{
		$nearestRestaurants = Restaurant::select("*"
			,DB::raw("6371 * acos(cos(radians(" .$request->latitude . "))
			* cos(radians(restaurants.latitude))
			* cos(radians(restaurants.longitude) - radians(" . $request->longitude . "))
			+ sin(radians(" .$request->latitude . "))
			* sin(radians(restaurants.latitude))) AS nearest"))
			->where(['status' => 1])
			->orderBy("nearest", 'asc')
			//->limit(1)
			->get();
			
		$restaurantHtml = '<select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="restaurant_id">';
		foreach($nearestRestaurants as $key => $restaurant) {
			$restaurantHtml .= '<option value="' . $restaurant->id . '">'. $restaurant->name .'</option>';
		}
		$restaurantHtml .= '</select>';
		
		$restaurantRiders = User::role('rider')->where('restaurant_id', $nearestRestaurants[0]->id)->get();
		$riderHtml = '<select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="rider_id">';
		foreach($restaurantRiders as $key => $rider) {
			$riderHtml .= '<option value="' . $rider->id . '">'. $rider->name .'</option>';
		}
		$riderHtml .= '</select>';
		
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
					
					if(in_array($customer->id, $customerIds, true)) {
						
						$orderRecord = Order::where(['user_id' => $customer->id])->first();
					
						if(!empty($orderRecord)) {
							$data[$customer->phone_number] = $customer->first_name . "|" . $customer->last_name . "|" . $customer->phone_number . "|" . $orderRecord->customer_address ;
						} else {
							$data[$customer->phone_number] = $customer->first_name . "|" . $customer->last_name . "|" . $customer->phone_number . "|" . " " ;
						}
					}
                }
            } 
        }

        echo json_encode($data);
	}
	
	public function save(Request $request)
	{
		$model = new User;
		$modelOrder = new Order;
		$modelOrderItem = new OrderItem;
		
		$userId = Auth::user()->id;
		$cart = Cart::where('user_id', '=', $userId)
			->where('status', '=', 1)->get();
		$cart->each->append(
			'total'
		);
		
		$total = $cart->sum('total');
		
		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$phone = $request->phone;
		$address = $request->address;
		$latitude = $request->latitude;
		$longitude = $request->longitude;
		$dropLocation = $request->drop_off_location;
		
		$restaurantId = $request->restaurant_id;
		$riderId = $request->rider_id;
		
		//echo $riderId;exit;
		
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
		
		if(!empty($customer)) {
			$customer->update($customerData);
		} else {
			$customer = User::create($customerData);
			$customer->assignRole('customer');
		}
		
		
		
		$orderData = [
			'user_id' => $userId,
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
		
		$cartItems = Cart::where('user_id', $userId)->where('item_id', '!=', null)->pluck('item_id');
		
		$menuItems = MenuItem::whereIn('id', $cartItems)->get();

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
		
		$cartIds = $cart->pluck('id');
		
		Cart::destroy($cartIds);
		
		/*********** Order Assign ************/
		
		$assignData = [
			'order_id' => $orderId,
			'rider_id' => $riderId,
			'trip_status_id' => 1,
		];
		
		$modelAssign = new OrderAssigned;
		
		/*********** Order Assign ************/
		
		$order = Order::with('orderItems')->where('id', $orderId)->first();
		
		return view('order/summary', compact('order', 'riderId'));
		
	}
	
	public function notification(Request $request)
	{
		$orderId = $request->order_id;
		$restaurantId = $request->restaurant_id;
		$riderId = $request->rider_id;
		
		$restaurantUsers = User::role('user')->where('restaurant_id', $restaurantId)->get();
		
		$rider = User::where('id', $riderId)->first();
		
		$riderNotificationData = [
			"order_id" => $orderId,
			"device_token" => $rider->device_token,
			"status" => "TR",
			"message" => "New Order Assigned"
		];
		
		$notification = Helper::sendNotification($riderNotificationData);
		
		sleep(3);
		
		foreach($restaurantUsers as $user) {
			$restaurantNotificationData = [
				"order_id" => $orderId,
				"device_token" => $user->device_token,
				"status" => 1,
				"message" => "New Order Arrived"
			];
		
			$notificationOne = Helper::sendNotification($restaurantNotificationData);
		}
		
		$responseData = [
			'code' => 1,
			'message' => "Notifications sent successfully.",
			'riderNotification' => json_decode($notification),
			'restaurantNotification' => json_decode($notification),
			'restaurantUsers' => count($restaurantUsers)
		];
		
		echo json_encode($responseData);
	}
	
}

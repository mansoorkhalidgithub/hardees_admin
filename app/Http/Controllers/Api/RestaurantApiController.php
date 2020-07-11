<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestaurantApiController extends Controller {
	public function recentOrders(Request $request) {
		$restaurant_id = $request->bearerToken();
		$data = Order::where('restaurant_id', $restaurant_id)->select(['id', 'user_id', 'created_at'])->get();
		return $data;
		$data = [];
		$data[] = [
			'time' => '09:23:01',
			'orderNo' => '#023',
			'customer' => 'Iram',
			'total' => '2000',
			'orderStatus' => 'Trip compeleted',
		];
		$data[] = [
			'time' => '10:23:01',
			'orderNo' => '#024',
			'customer' => 'Imran',
			'total' => '3000',
			'orderStatus' => 'Trip Started',
		];
		$data[] = [
			'time' => '10:44:01',
			'orderNo' => '#025',
			'customer' => 'Shoaib',
			'total' => '1500',
			'orderStatus' => 'Trip Cancel',
		];
		$data[] = [
			'time' => '09:53:09',
			'orderNo' => '#026',
			'customer' => 'Fatima',
			'total' => '900',
			'orderStatus' => 'Trip Request',
		];
		$data[] = [
			'time' => '11:33:01',
			'orderNo' => '#027',
			'customer' => 'Babu',
			'total' => '1400',
			'orderStatus' => 'Trip Rejected',
		];
		$data[] = [
			'time' => '23:23:05',
			'orderNo' => '#034',
			'customer' => 'Nisar',
			'total' => '340',
			'orderStatus' => 'Trip Compeleted',
		];
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order accepted',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function orderAccepted(Request $request) {
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order accepted',
		];
		return response()->json($response);
	}
	public function orderReadyForPickup(Request $request) {
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order ready for pick up',
		];
		return response()->json($response);
	}
	public function login(Request $request) {
		$loggedInUser = Restaurant::where('email', $request['email'])->first();
		if (!empty($loggedInUser)):
			if (Hash::check($request['password'], $loggedInUser->password)) {
				//$loggedInUser = Auth::user();
				// $tokenResult = $loggedInUser->createToken('restaurant');
				// $token = $tokenResult->token;
				// $token->expires_at = Carbon::now()->addDays(1);

				$customer = [
					'name' => $loggedInUser->name,
					'email' => $loggedInUser->email,
					'contact_number' => $loggedInUser->contact_number,
					'logo' => $loggedInUser->logo,
					'thumbnail' => $loggedInUser->thumbnail,
					// 'role' => $loggedInUser->roles->pluck('name'),
				];

				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'Customer logged in successfully !',
					'access_token' => $loggedInUser->id,
					'token_type' => 'Bearer',
					// 'customer_id' => $loggedInUser->customer_id,
					'customer_profile' => $customer,
					// 'expires_at' => Carbon::parse(
					// 	$tokenResult->token->expires_at
					// )->toDateTimeString(),
				];

				return response()->json($response);
			}

		endif;

		$response = [
			'status' => 0,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Invalid phone number or password !',
		];

		return response()->json($response);
	}
	public function dashboardByToday(Request $request) {
		$startDate = Carbon::now()->toDateString();
		$endDate = Carbon::now()->toDateTimeString();

		$revenue_summary = [
			'today' => 300,
		];
		$order_summary = [
			'total_orders' => 200,
			'cancel_orders' => 20,
			'accepted_orders' => 180,
		];
		$data = [
			'order_summary' => $order_summary,
			'revenue_summary' => $revenue_summary,
		];
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Data get successfully !',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function dashboardByWeek(Request $request) {
		$startDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i');
		$endDate = Carbon::now()->toDateTimeString();
		$revenue_summary = [
			'this_week' => 50000,
		];
		$order_summary = [
			'total_orders' => 1800,
			'cancel_orders' => 90,
			'accepted_orders' => 1710,
		];
		$data = [
			'order_summary' => $order_summary,
			'revenue_summary' => $revenue_summary,
		];
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Data get successfully !',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function dashboardByMonth(Request $request) {
		$startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i');
		$endDate = Carbon::now()->toDateTimeString();
		$revenue_summary = [
			'this_month' => 100000,
		];
		$order_summary = [
			'total_orders' => 2000,
			'cancel_orders' => 200,
			'accepted_orders' => 180,
		];
		$data = [
			'order_summary' => $order_summary,
			'revenue_summary' => $revenue_summary,
		];
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Data get successfully !',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function orderProcessing(Request $request) {
		$restaurant_id = $request->bearerToken();
		$accptedOrders = Order::has('ordersAccepted')->where('restaurant_id', $restaurant_id)->get();
		if ($accptedOrders->isNotEmpty()) {
			$accptedOrders->each->append(
				['bookingNo', 'ordertype', 'approxTime', 'riderAsigned', 'customerData', 'orderItemsWithName']
			);
			// $accptedOrders->order_items->each->append(
			// 	'Name'
			// );
		}

		$newOrders = Order::doesnthave('orders')->where('restaurant_id', $restaurant_id)->get();
		if ($newOrders->isNotEmpty()) {
			$newOrders->each->append(
				['bookingNo', 'ordertype', 'approxTime', 'customerData', 'orderItemsWithName']
			);
		}

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order processing',
			'accptedOrders' => $accptedOrders,
			'newOrders' => $newOrders,
		];

		return response()->json($response);
	}
}

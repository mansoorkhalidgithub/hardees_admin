<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class RestaurantApiController extends Controller
{
	public function recentYesterdayOrders(Request $request)
	{
		$restaurant_id = Auth::user()->restaurant_id;
		$dt = Carbon::yesterday();
		$startDate = $dt->copy()->startOfDay();
		$endDate = $dt->copy()->endOfDay();
		$model = Order::where('restaurant_id', $restaurant_id)->whereBetween('created_at', [$startDate, $endDate])->get();
		$model->each->append(
			['orderStatus', 'customerData', 'ridername']
		);
		$data = [];
		if ($model->isNotEmpty()) {
			foreach ($model as $value) {
				$data[] = [
					'time' => date("g:i A", strtotime($value->created_at)),
					'date' => $value->created_at->toDateString(),
					'orderNo' => '#0' . $value->id,
					'customer' => $value->customerData->name,
					'customer_phone_number' => $value->customerData->phone_number,
					'customer_address' => $value->customer_address,
					'rider_name' => $value->ridername,
					'total' => $value->total,
					'orderStatus' => $value->orderStatus,
					'menu_items' => $value->append('orderItems')->orderItems,
				];
			}
		}
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'All recent orders',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function recentTodayOrders(Request $request)
	{
		$restaurant_id = Auth::user()->restaurant_id;
		$startDate = Carbon::now()->toDateString();
		$endDate = Carbon::now()->toDateTimeString();
		$model = Order::where('restaurant_id', $restaurant_id)->whereBetween('created_at', [$startDate, $endDate])->get();
		$model->each->append(
			['orderStatus', 'customerData', 'ridername']
		);
		$data = [];
		if ($model->isNotEmpty()) {
			foreach ($model as $value) {
				$data[] = [
					'time' => date("g:i A", strtotime($value->created_at)),
					'date' => $value->created_at->toDateString(),
					'orderNo' => '#0' . $value->id,
					'customer' => $value->customerData->name,
					'customer_phone_number' => $value->customerData->phone_number,
					'customer_address' => $value->customer_address,
					'rider_name' => $value->ridername,
					'total' => $value->total,
					'orderStatus' => $value->orderStatus,
					'menu_items' => $value->append('orderItems')->orderItems
				];
			}
		}
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Today recent orders',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function recentAllOrders(Request $request)
	{
		$restaurant_id = Auth::user()->restaurant_id;
		$model = Order::where('restaurant_id', $restaurant_id)->get();
		$model->each->append(
			['orderStatus', 'customerData', 'ridername']
		);
		$data = [];
		if ($model->isNotEmpty()) {
			foreach ($model as $value) {
				$data[] = [
					'time' => date("g:i A", strtotime($value->created_at)),
					'date' => $value->created_at->toDateString(),
					'orderNo' => '#0' . $value->id,
					'customer' => $value->customerData->name,
					'customer_phone_number' => $value->customerData->phone_number,
					'customer_address' => $value->customer_address,
					'rider_name' => $value->ridername,
					'total' => $value->total,
					'orderStatus' => $value->orderStatus,
					'menu_items' => $value->append('orderItems')->orderItems
				];
			}
		}
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'All recent orders',
			'data' => $data,
		];
		return response()->json($response);
	}
	public function orderAccepted(Request $request)
	{
		$dataUpdate = Order::where('id', $request->order_id)->first();
		$dataUpdate->status = Config::get('constants.order_accepted');
		$dataUpdate->save();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order accepted',
		];
		return response()->json($response);
	}
	public function orderReadyForPickup(Request $request)
	{
		$dataUpdate = Order::where('id', $request->order_id)->first();
		$dataUpdate->status = Config::get('constants.order_ready');
		$dataUpdate->save();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Order ready for pick up',
		];
		return response()->json($response);
	}
	public function login(Request $request)
	{

		$loggedInUser = User::where('email', $request['email'])->first();
		$userRole = $loggedInUser->roles->pluck('name');

		if ($userRole[0] != 'user') {
			return $response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Access denied',
			];
		}
		if (!empty($loggedInUser)) :
			if (Hash::check($request['password'], $loggedInUser->password)) {

				$userData = [
					'device_type' => $request->device_type,
					'device_name' => $request->device_name,
					'device_token' => $request->device_token,
					'app_version' => $request->app_version,
					'device_id' => $request->device_id,
				];

				User::where('id', $loggedInUser->id)->update($userData);

				$tokenResult = $loggedInUser->createToken('restaurant');
				$token = $tokenResult->accessToken;
				$userRole = $loggedInUser->roles->pluck('name');
				$customer = [
					'name' => $loggedInUser->first_name . $loggedInUser->last_name ? $loggedInUser->last_name : '',
					'email' => $loggedInUser->email,
					'contact_number' => $loggedInUser->phone_number,
					'role' => $userRole[0],
				];

				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'Restaurant user logged in successfully !',
					'access_token' => $token,
					'token_type' => 'Bearer',
					'customer_profile' => $customer,
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
	public function dashboardByToday(Request $request)
	{
		$userRestaurantId = Auth::user()->restaurant_id;
		$startDate = Carbon::now()->toDateString();
		$endDate = Carbon::now()->toDateTimeString();
		$statusCompleted = Config::get('constants.order_completed');
		$statusCancel = Config::get('constants.order_rejected');
		$statusAccepted = Config::get('constants.order_accepted');
		$total_orders = $this->getTotalCount($userRestaurantId, [$startDate, $endDate]);
		$cancel_orders = $this->getCount($statusCancel, $userRestaurantId, [$startDate, $endDate]);
		$accepted_orders = $this->getCount($statusAccepted, $userRestaurantId, [$startDate, $endDate]);
		$total_completed = $this->getCount($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$total_accepted = $total_completed + $accepted_orders;
		$count = $this->getSum($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$revenue_summary = [
			'today' => $count,
		];
		$order_summary = [
			'total_orders' => $total_orders,
			'cancel_orders' => $cancel_orders,
			'accepted_orders' => $total_accepted,
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
	public function getSum($status, $restaurant_id, $date)
	{
		$total = Order::where('status', $status)->where('restaurant_id', $restaurant_id)->whereBetween('created_at', $date)->sum('total');
		return $total;
	}
	public function getTotalCount($restaurant_id, $date)
	{
		$total = Order::where('restaurant_id', $restaurant_id)->whereBetween('created_at', $date)->count();
		return $total;
	}
	public function getCount($status, $restaurant_id, $date)
	{
		$total = Order::where('status', $status)->where('restaurant_id', $restaurant_id)->whereBetween('created_at', $date)->count();
		return $total;
	}
	public function dashboardByWeek(Request $request)
	{
		$userRestaurantId = Auth::user()->restaurant_id;
		$startDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i');
		$endDate = Carbon::now()->toDateTimeString();
		$statusCompleted = Config::get('constants.order_completed');
		$statusCancel = Config::get('constants.order_rejected');
		$statusAccepted = Config::get('constants.order_accepted');
		$total_orders = $this->getTotalCount($userRestaurantId, [$startDate, $endDate]);
		$cancel_orders = $this->getCount($statusCancel, $userRestaurantId, [$startDate, $endDate]);
		$accepted_orders = $this->getCount($statusAccepted, $userRestaurantId, [$startDate, $endDate]);
		$total_completed = $this->getCount($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$total_accepted = $total_completed + $accepted_orders;
		$count = $this->getSum($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$revenue_summary = [
			'this_week' => $count,
		];
		$order_summary = [
			'total_orders' => $total_orders,
			'cancel_orders' => $cancel_orders,
			'accepted_orders' => $total_accepted,
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
	public function dashboardByMonth(Request $request)
	{
		$userRestaurantId = Auth::user()->restaurant_id;

		$startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i');
		$endDate = Carbon::now()->toDateTimeString();
		$statusCompleted = Config::get('constants.order_completed');
		$statusCancel = Config::get('constants.order_rejected');
		$statusAccepted = Config::get('constants.order_accepted');
		$total_orders = $this->getTotalCount($userRestaurantId, [$startDate, $endDate]);
		$cancel_orders = $this->getCount($statusCancel, $userRestaurantId, [$startDate, $endDate]);
		$accepted_orders = $this->getCount($statusAccepted, $userRestaurantId, [$startDate, $endDate]);
		$total_completed = $this->getCount($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$total_accepted = $total_completed + $accepted_orders;
		$count = $this->getSum($statusCompleted, $userRestaurantId, [$startDate, $endDate]);
		$revenue_summary = [
			'this_month' => $count,
		];
		$order_summary = [
			'total_orders' => $total_orders,
			'cancel_orders' => $cancel_orders,
			'accepted_orders' => $total_accepted,
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
	public function orderProcessing(Request $request)
	{
		// $restaurant_id = 1;
		$restaurant_id = auth()->user()->restaurant_id;
		$accptedOrders = Order::has('ordersAccepted')->where('restaurant_id', $restaurant_id)->get();
		if ($accptedOrders->isNotEmpty()) {
			$accptedOrders->each->append(
				['bookingNo', 'ordertype', 'approxTime', 'orderItems', 'riderAsigned', 'customerData']
			);
			// $accptedOrders->order_items->each->append(
			// 	'Name'
			// );
		}

		$newOrders = Order::has('newOrders')->where('restaurant_id', $restaurant_id)->get();
		if ($newOrders->isNotEmpty()) {
			$newOrders->each->append(
				['bookingNo', 'ordertype', 'orderItems', 'approxTime', 'customerData']
			);
			// $newOrders->each->append('orderItems')->orderItems;
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

	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => "You Are Logout",
		];
		return response()->json($response);
	}
}

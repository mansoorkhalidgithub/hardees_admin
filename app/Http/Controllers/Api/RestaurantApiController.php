<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestaurantApiController extends Controller {
	public function login(Request $request) {
		$loggedInUser = Restaurant::where('email', $request['email'])->first();
		if (!empty($loggedInUser)):
			if (Hash::check($request['password'], $loggedInUser->password)) {
				//$loggedInUser = Auth::user();
				// $tokenResult = $loggedInUser->createToken('customer');
				// $token = $tokenResult->token;
				// $token->expires_at = Carbon::now()->addDays(1);

				$customer = [
					'name' => $loggedInUser->name,
					'email' => $loggedInUser->email,
					'phone_number' => $loggedInUser->phone_number,
				];

				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'Customer logged in successfully !',
					'access_token' => $loggedInUser->id,
					'token_type' => 'Bearer',
					// 'customer_id' => $loggedInUser->customer_id,
					// 'customer_profile' => $customer,
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
	public function dashboard(Request $request) {
		if ($request->queryType = 'today') {
			$startDate = Carbon::now()->toDateString();
			$endDate = Carbon::now()->toDateTimeString();
		} elseif ($request->queryType = 'week') {
			$startDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i');
			$endDate = Carbon::now()->toDateTimeString();
		} elseif ($request->queryType = 'month') {
			$startDate = Carbon::now()->startOfMonth()->format('Y-m-d H:i');
			$endDate = Carbon::now()->toDateTimeString();
		}
		$data = [
			'totalOrder' => 200,
			'cancelOrder)' => 20,
			'acceptedOrder' => 180,
			'totalRevenue' => 25000,
		];
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Data get successfully !',
			'data' => $data,
		];
		return response()->json($response);
	}
}

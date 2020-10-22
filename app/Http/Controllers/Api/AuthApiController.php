<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\VerifyUser;
use App\Template;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\RestaurantUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
	public function __construct()
	{
	}

	public function signup(Request $request)
	{
		$phone_number = $request->phone_number;

		$messages = [
		    'email.unique' => 'The :attribute already exists.',
		    'phone_number.unique' => 'The :attribute already exists.',
		];

		$validator = Validator::make($request->all(), [
			'email' => 'required|email|unique:users',
			'phone_number' => [
				'required',
				Rule::unique('users')->where(function ($query) use ($phone_number) {
					$query->where(['phone_number' => $phone_number, 'user_type' => 'customer']);
				}),
			],
			'password' => 'required'
		], $messages);

		if ($validator->fails()) {
			$response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => $validator->errors()->first(),
			];

			return response()->json($response);
		}

		$data = $request->all();
		$data['password'] = Hash::make($request->password);
		$data['user_type'] = 'customer';
		$data['first_name'] = $request->first_name . " " . $request->last_name;
		$data['type'] = 4;

		//dd($data);
		$otp = rand(1000, 9999);		
		$user = User::create($data);
		$user->assignRole('customer');
		VerifyUser::create([
			'user_id' => $user->id,
			'user_otp' => $otp
			]);
			
		$message = Template::find(2);
		$body = str_replace('{{COMPANY_NAME}}', "Hardees", $message->message);
		$body = str_replace('{{OTP}}', $otp, $body);
		$body = str_replace(' ', '%20', $body);
		$message_data = [
			'number' => $user->phone_number,
			'message' => $body
		];
		Helper::sendMessage($message_data);
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Customer created successfully'
		];

		return response()->json($response);
	}

	public function login(Request $request)
	{
		$loggedInUser = User::where('phone_number', $request['phone_number'])
			->where('user_type', 'customer')->first();
		if (!empty($loggedInUser)) :
			if (Hash::check($request['password'], $loggedInUser->password)) {
				if ($loggedInUser->is_verified != 1) {
					$otp = rand(1000, 9999);
					$model = '';
					$model = VerifyUser::all()->firstwhere('user_id', $loggedInUser->id);
					if (!$model) {
						VerifyUser::create([
							'user_id' => $loggedInUser->id,
							'user_otp' => $otp
						]);
					} else {
						$model->update(['user_otp' => $otp]);
					}
					$message = Template::find(2);
					$body = str_replace('{{COMPANY_NAME}}', "Hardees", $message->message);
					$body = str_replace('{{OTP}}', $otp, $body);
					$body = str_replace(' ', '%20', $body);
					$message_data = [
						'number' => $loggedInUser->phone_number,
						'message' => $body
					];
					Helper::sendMessage($message_data);
					$response = [
						'status' => 2,
						'method' => $request->route()->getActionMethod(),
						'message' => 'OTP send to your Mobile Number !',
					];
					return response()->json($response);
				}
				//$loggedInUser = Auth::user();
				$tokenResult = $loggedInUser->createToken('customer');
				$token = $tokenResult->token;
				$token->expires_at = Carbon::now()->addDays(1);

				$customer = [
					'name' => $loggedInUser->name,
					'email' => $loggedInUser->email,
					'phone_number' => $loggedInUser->phone_number,
				];
				$data = [
					"device_type" => $request->device_type,
					"device_name" => $request->device_name,
					"device_token" => $request->device_token,
					"app_version" => $request->app_version,
					"device_id" => $request->device_id,
					"longitude" => $request->longitude,
					"latitude" => $request->latitude,
				];
				$loggedInUser->update($data);
				$response = [
					'status' => 1,
					'method' => $request->route()->getActionMethod(),
					'message' => 'Customer logged in successfully !',
					'access_token' => $tokenResult->accessToken,
					'token_type' => 'Bearer',
					'customer_id' => $loggedInUser->customer_id,
					'customer_profile' => $customer,
					'expires_at' => Carbon::parse(
						$tokenResult->token->expires_at
					)->toDateTimeString()
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


	public function loginRestaurant(Request $request)
	{
		$loggedInUser = RestaurantUser::where('email', $request['email'])->first();
		if (Hash::check($request['password'], $loggedInUser->password)) {
			//$loggedInUser = Auth::user();
			$tokenResult = $loggedInUser->createToken('restaurant-user');
			$token = $tokenResult->token;
			$token->expires_at = Carbon::now()->addDays(1);

			$customer = [
				'name' => $loggedInUser->name,
				'email' => $loggedInUser->email,
				'phone_number' => $loggedInUser->phone_number,
			];

			$response = [
				'status' => 1,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Customer logged in successfully !',
				'access_token' => $tokenResult->accessToken,
				'token_type' => 'Bearer',
				'restaurant_user_id' => $loggedInUser->id,
				'customer_profile' => $customer,
				'expires_at' => Carbon::parse(
					$tokenResult->token->expires_at
				)->toDateTimeString()
			];

			return response()->json($response);
		}

		$response = [
			'status' => 0,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Invalid phone number or password !',
		];

		return response()->json($response);
	}

	public function forgetPassword(Request $request)
	{
		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Forget password request URL',
			'data' => [
				'redirect_url' => url('password/reset')
			]
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

		public function verifyotp(Request $request)
	{
		$verify = VerifyUser::all()->firstWhere('user_otp', $request->otp);
		if ($verify) {
			$user = User::find($verify->user_id);
			$user->update(['is_verified' => 1]);
			$tokenResult = $user->createToken('customer');
			$token = $tokenResult->token;
			$token->expires_at = Carbon::now()->addDays(1);
			$verify->delete();
			$response = [
				'status' => 1,
				'method' => $request->route()->getActionMethod(),
				'message' => "OTP Verified",
				'access_token' => $tokenResult->accessToken,
				'token_type' => 'Bearer',
				'expires_at' => Carbon::parse(
					$tokenResult->token->expires_at
				)->toDateTimeString()
			];
			return response()->json($response);
		}
		$response = [
			'status' => 0,
			'method' => $request->route()->getActionMethod(),
			'message' => "Please Enter Correct OTP",
		];
		return response()->json($response);
	}

	public function resend(Request $request)
	{
		$device_id = $request->device_id;
		$customer = User::all()->firstWhere('device_id', $device_id);
		if ($customer) {
			$otp = rand(1000, 9999);
			VerifyUser::where('user_id', $customer->id)->delete();
			VerifyUser::create([
				'user_id' => $customer->id,
				'user_otp' => $otp
			]);
			$message = Template::find(2);
			$body = str_replace('{{COMPANY_NAME}}', "Hardees", $message->message);
			$body = str_replace('{{OTP}}', $otp, $body);
			$body = str_replace(' ', '%20', $body);
			$message_data = [
				'number' => $customer->phone_number,
				'message' => $body
			];
			Helper::sendMessage($message_data);
			$response = [
				'status' => 1,
				'method' => $request->route()->getActionMethod(),
				'message' => "OTP Resend",
			];
			return response()->json($response);
		}
		$response = [
			'status' => 0,
			'method' => $request->route()->getActionMethod(),
			'message' => "Please Signup Again",
		];
		return response()->json($response);
	}
}

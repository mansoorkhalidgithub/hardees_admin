<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
		$validator = Validator::make($request->all(), [
           'username' => 'required',
           'email' => 'required|email|unique:users',
           'phone_number' => 'required|unique:users',
           'password' => 'required'
		]);

		if ($validator->fails()) {
            $response = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Validation failed',
				'errors' => $validator->messages()
			];

			return response()->json($response);
		}
		
		$data = [
			'role' => 'customer',
			'username' => $request->username,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'password' => Hash::make($request->password),
			'latitude' => $request->latitude,
			'longitude' => $request->longitude,
			'device_token' => $request->device_token,
			'device_type' => $request->device_type,
			'device_id' => $request->device_id,
			'device_name' => $request->device_name,
			'app_version' => $request->app_version,
		];
		
		$user = User::create($data);
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Customer created successfully'
        ];

        return response()->json($response);
	}
	
	public function login(Request $request)
	{
		$loggedInCustomer = User::where('phone_number' ,$request['phone_number'])->first();
		if(Hash::check($request['password'], $loggedInCustomer->password))
        {
            //$loggedInCustomer = Auth::user();
            $tokenResult = $loggedInCustomer->createToken('customer');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addDays(1);

			$customer = [
				'name' => $loggedInCustomer->name,
				'email' => $loggedInCustomer->email,
				'phone_number' => $loggedInCustomer->phone_number,
			];

            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => 'Customer logged in successfully !',
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
				'customer_id' => $loggedInCustomer->customer_id,
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
}

<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerApiController extends Controller
{
	
    public function __construct()
	{
		
	}
	
	public function profile(Request $request)
	{
		$customer = Auth::user();
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Customer profile fetched successfully',
			'data' => [
				'profile' => [
					'username' => $customer->username,
					'name' => $customer->name,
					'email' => $customer->email,
					'phone_number' => $customer->phone_number,
					'address' => $customer->address,
					'profile_picture' => 'uploads/customer/picture.jpg',
					'points' => $customer->getPoints(),
				]
			]
        ];

        return response()->json($response);
	}
	
	public function updateProfile(Request $request)
	{
		$customer = Auth::user();
		
		$data = [
			'first_name' => $request->name,
			'username' => $request->username,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'address' => $request->address,
		];
		
		User::where('id', $customer->id)->update($data);
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Customer profile updated successfully',
			'data' => []
        ];

        return response()->json($response);
	}
	
	public function updateProfilePicture(Request $request)
	{
		$customer = Auth::user();
		
		$data = [
			'first_name' => $request->name,
			'username' => $request->username,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'address' => $request->address,
		];
		
		User::where('id', $customer->id)->update($data);
		
		$response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Customer profile updated successfully',
			'data' => []
        ];

        return response()->json($response);
	}
}

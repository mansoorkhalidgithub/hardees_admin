<?php

namespace App\Http\Controllers\Api;

use Image;
use Helper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
					'profile_picture' => $customer->profile_picture,
					'points' => $customer->getPoints(),
				]
			]
		];

		return response()->json($response);
	}

	public function updateProfilePicture(Request $request)
	{
		$customer = Auth::user();

		$data = [];

		if ($request->has('profile_picture')) {
			$image = $request->file('profile_picture');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/profile_pictures');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$logoPath = 'uploads/profile_pictures/' . $input['imagename'];

			$data['profile_picture'] = $logoPath;
		}

		User::where('id', $customer->id)->update($data);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Profile picture updated successfully',
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

	public function changePassword(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'old_password'  =>  'required',
			'new_password'  =>  'required|min:6|confirmed',
			'new_password_confirmation'  =>  'required|min:6',
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

		$customer = Auth::user();

		$customer->update(['password' => Hash::make($request->new_password)]);

		$response = [
			'status' => 1,
			'method' => $request->route()->getActionMethod(),
			'message' => 'Password changed successfully',
		];

		return response()->json($response);
	}
}

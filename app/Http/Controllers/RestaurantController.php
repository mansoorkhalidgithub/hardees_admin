<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\RestaurantRequest;
use App\Restaurant;
use App\RestaurantCategories;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class RestaurantController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$model = Restaurant::all();

		return view('restaurant/index', compact('model'));
	}

	public function add()
	{
		return view('restaurant/create');
	}

	public function store(RestaurantRequest $request)
	{
		$data = $request->all();
		$data['created_by'] = Auth::user()->id;
		$data['tags'] = serialize($request->tags);
		$data['password'] = Hash::make($request->password);

		if ($request->has('logo')) {
			$image = $request->file('logo');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/logo');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$logoPath = 'uploads/logo/' . $input['imagename'];

			$data['logo'] = $logoPath;
		}

		if ($request->has('cover')) {
			$image = $request->file('cover');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPathCover = public_path('/uploads/cover');
			if (!file_exists($destinationPathCover)) {
				mkdir($destinationPathCover, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPathCover . '/' . $input['imagename']);

			$coverPath = 'uploads/cover/' . $input['imagename'];

			$data['thumbnail'] = $coverPath;
		}
		// dd($data);
		$restaurant = Restaurant::create($data);
		if ($restaurant) {
			foreach ($request->categories as $key => $category) {
				$res_data = [
					'restaurant_id' => $restaurant->id,
					'title' => $category,
				];

				RestaurantCategories::create($res_data);
			}
		}

		Session::flash('success', 'New restaurant created successfully');

		return redirect('restaurants');
	}

	public function edit($restaurant)
	{
		$model = $this->findModel($restaurant);
		return view('restaurant.edit', compact('model'));
	}

	public function show($id)
	{
		$model = $this->findModel($id);
		return view('restaurant.show', compact('model'));
	}
	public function update(RestaurantRequest $request)
	{
		$restaurant = $this->findModel($request->id);
		// dd($restaurant);
		// die;
		$data = $request->all();
		$data['created_by'] = Auth::user()->id;
		$data['tags'] = serialize($request->tags);
		// $data['password'] = Hash::make($request->password);

		if ($request->has('logo')) {
			if (!empty($restaurant->logo)) {
				$restaurantImage = public_path($restaurant->logo); // get previous image from folder
				if (file_exists($restaurantImage)) {
					// unlink or remove previous image from folder
					unlink($restaurantImage);
				}
			}
			$image = $request->file('logo');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/logo');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$logoPath = 'uploads/logo/' . $input['imagename'];

			$data['logo'] = $logoPath;
		}

		if ($request->has('cover')) {
			$restaurantCover = public_path($restaurant->thumbnail); // get previous image from folder
			if (file_exists($restaurantCover)) {
				// unlink or remove previous image from folder
				unlink($restaurantCover);
			}
			$image = $request->file('cover');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPathCover = public_path('/uploads/cover');
			if (!file_exists($destinationPathCover)) {
				mkdir($destinationPathCover, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPathCover . '/' . $input['imagename']);

			$coverPath = 'uploads/cover/' . $input['imagename'];

			$data['thumbnail'] = $coverPath;
		}

		//dd($data);

		$restaurant->update($data);

		Session::flash('success', 'Restaurant Updated successfully');

		return redirect('restaurants');
	}

	public function destroy(Request $request)
	{
		$restaurant = $this->findModel($request->id);
		$restaurant->delete();
		return redirect()->route('restaurants');
	}
	protected function findModel($id)
	{
		return Restaurant::find($id);
	}

	public function status($id)
	{
		$restaurant = $this->findModel($id);
		$st = $restaurant->status === 1 ? 0 : 1;
		$restaurant->status = $st;
		$restaurant->save();
		return redirect()->back();
	}
	/*********************************** restaurant user ************************************/
	public function getrestaurantUser()
	{
		$model = User::role('user')->get();
		return view('restaurant/user', compact('model'));
	}
	public function createUser()
	{
		return view('restaurant/create-user');
	}
	public function storeRestaurantUser(Request $request)
	{
		$this->validateRestaurantUserData($request);
		$data = [];
		$parts = explode("@", $request['email']);
		$t = explode(" ", $request['title']);
		$ridername = $parts[0];
		if ($request->has('profile')) {
			$image = $request->file('profile');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/profile');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$profilePath = 'uploads/profile/' . $input['imagename'];

			// $data['profile_picture'] = $profilePath;
		}
		$data = [
			'profile_picture' => $profilePath,
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'username' => $ridername,
			'email' => $request->email,
			// 'created_by' => auth()->user()->id,
			'restaurant_id' => $request->restaurant_id,
			// 'state_id' => $request->state_id,
			// 'city_id' => $request->city_id,
			// 'cnic' => $request->cnic,
			// 'cnic_expire_date' => $request->cnic_expire_date,
			// 'country_id' => $request->country_id,
			// 'latitude' => $request->latitude,
			// 'longitude' => $request->longitude,
			'phone_number' => $request->phone_number,
			'password' => Hash::make($request->password),
		];

		// print_r($data);
		// die;
		$restaurantUser = User::create($data);
		$restaurantUser->assignRole('user');
		return Redirect::route('restaurant.user')->with('message', 'New User created successfully');
	}
	private function validateRestaurantUserData($request)
	{
		$this->validate($request, [
			'email' => 'required|unique:users,email',
			'first_name' => 'required',
			// 'menu_category_id' => 'required|numeric',
			// 'restaurant_id' => 'required|numeric',
			// 'price' => 'required|numeric',
			// 'quantity' => 'required|numeric',
			// 'discount' => 'required|numeric',
			// 'weight' => 'required|numeric',
			// 'status' => 'required|numeric|max:1',
			// 'is_favourite'=>'required|numeric|max:3',
			//'itemImg' => 'mimes:jpeg,jpg,png | max:1000',

		]
			// ,
			// [
			// 	'menu_category_id.numeric' => 'Please Select Categorie',
			// 	'restaurant_id.numeric' => 'Please Select Restaurants Branch',
			// ]
		);
	}
}

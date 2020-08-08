<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Carbon\Carbon;
use App\Restaurant;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\RestaurantCategories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RestaurantRequest;
use App\OrderAssigned;
use Illuminate\Support\Facades\Redirect;

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
		$data['delivery_type'] = 'home_delivery';
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
		// if ($restaurant) {
		// foreach ($request->categories as $key => $category) {
		// $res_data = [
		// 'restaurant_id' => $restaurant->id,
		// 'title' => $category,
		// ];

		// RestaurantCategories::create($res_data);
		// }
		// }

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
		$todaystart = Carbon::now()->startOfDay();
		$todayend = Carbon::now()->endOfDay();
		$startWeek = Carbon::now()->startOfWeek();
		$endWeek = Carbon::now()->endOfWeek();
		$startMonth = Carbon::now()->startOfMonth();
		$endMonth = Carbon::now()->endOfMonth();
		$laststartMonth = Carbon::now()->startOfMonth()->modify('-1 month');
		$lastendMonth = Carbon::now()->endOfMonth()->modify('-1 month');
		$today = Order::where('restaurant_id', $id)->whereBetween('created_at', [$todaystart, $todayend])->sum('total');
		$week  = Order::where('restaurant_id', $id)->whereBetween('created_at', [$startWeek, $endWeek])->sum('total');
		$month = Order::where('restaurant_id', $id)->whereBetween('created_at', [$startMonth, $endMonth])->sum('total');
		$pre_month = Order::where('restaurant_id', $id)->whereBetween('created_at', [$laststartMonth, $lastendMonth])->sum('total');
		$total = Order::where('restaurant_id', $id)->sum('total');
		$complete = Order::where('restaurant_id', $id)->where('status', 6)->count();
		$inprogress = Order::where('restaurant_id', $id)->whereIn('status', [1, 2, 3, 4, 5])->count();
		$model = $this->findModel($id);
		$order_ids = Order::where('restaurant_id', $id)
			->where('status', 6)->pluck('id');
		$rider = $this->getriderDetail($id);
		// dd($rider);
		return view('restaurant.show', compact('model', 'rider', 'total', 'today', 'week', 'month', 'pre_month', 'complete', 'inprogress'));
	}

	protected function getriderDetail($id)
	{
		$order_ids = Order::where('restaurant_id', $id)
			->where('status', 6)->pluck('id');
		$odr_ass = OrderAssigned::whereIn('order_id', $order_ids)->pluck('rider_id');
		$riders = User::whereIn('id', $odr_ass)
			->get();
		return $riders->each->append('RiderOrderCount');
	}
	public function update(RestaurantRequest $request)
	{
		$restaurant = $this->findModel($request->id);
		// dd($restaurant);
		// die;
		$data = $request->all();
		$data['created_by'] = Auth::user()->id;
		$data['tags'] = serialize($request->tags);
		$data['delivery_type'] = 'home_delivery';
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

	public function chart(Request $request)
	{
		$schedule = $request->type;
		$start = '';
		$end = '';
		switch ($schedule) {
			case 'Weekly':
				$start = Carbon::now()->startOfWeek();
				$end = Carbon::now()->endOfWeek();
				$laststart = Carbon::now()->startOfWeek()->modify('-1 week');
				$lastend = Carbon::now()->endOfWeek()->modify('-1 week');
				break;
			case 'Daily':
				$start = Carbon::now()->startOfDay();
				$end = Carbon::now()->endOfDay();
				$laststart = Carbon::now()->startOfDay()->modify('-1 day');
				$lastend = Carbon::now()->endOfDay()->modify('-1 day');
				break;
			case 'Monthly':
				$start = Carbon::now()->startOfMonth();
				$end = Carbon::now()->endOfMonth();
				$laststart = Carbon::now()->startOfMonth()->modify('-1 month');
				$lastend = Carbon::now()->endOfMonth()->modify('-1 month');
				break;
			case 'Select Schedule':
				$complete = Order::where('restaurant_id', $request->id)
					->where('status', '=', 6)->count();
				$inprogress = Order::where('restaurant_id', $request->id)
					->whereIn('status', [1, 2, 3, 4, 5])->count();
				$start = Carbon::now()->startOfMonth();
				$end = Carbon::now()->endOfMonth();
				$laststart = Carbon::now()->startOfMonth()->modify('-1 month');
				$lastend = Carbon::now()->endOfMonth()->modify('-1 month');
				$current = Order::where('restaurant_id', $request->id)
					->where('status', '=', 6)
					->whereBetween('created_at', [$start, $end])->sum('total');
				$previous = Order::where('restaurant_id', $request->id)
					->where('status', 6)
					->whereBetween('created_at', [$laststart, $lastend])->sum('total');

				$earning = [$previous, $current];
				$data =  [$complete, $inprogress];
				return response()->json(compact('data', 'earning'));
		}

		$complete = Order::where('restaurant_id', $request->id)
			->where('status', '=', 6)
			->whereBetween('created_at', [$start, $end])->count();
		$inprogress = Order::where('restaurant_id', $request->id)
			->whereIn('status', [1, 2, 3, 4, 5])
			->whereBetween('created_at', [$start, $end])->count();

		$current = Order::where('restaurant_id', $request->id)
			->where('status', '=', 6)
			->whereBetween('created_at', [$start, $end])->sum('total');
		$previous = Order::where('restaurant_id', $request->id)
			->where('status', 6)
			->whereBetween('created_at', [$laststart, $lastend])->sum('total');

		$earning = [$previous, $current];
		$data =  [$complete, $inprogress];
		return response()->json(compact('data', 'earning'));
	}
}

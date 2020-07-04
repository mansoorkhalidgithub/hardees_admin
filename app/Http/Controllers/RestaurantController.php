<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Helpers\Helper;
use App\Http\Requests\RestaurantRequest;
use App\RestaurantCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

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
					'title' => $category
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
				if (file_exists($restaurantImage)) { // unlink or remove previous image from folder
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
			if (file_exists($restaurantCover)) { // unlink or remove previous image from folder
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
}

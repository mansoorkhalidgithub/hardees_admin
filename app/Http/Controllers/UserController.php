<?php

namespace App\Http\Controllers;

use App\Auth;
use App\User;
use App\Restaurant;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$model = User::role('user')->get();
		$title = 'Customer';
		return view('user.index', compact('model', 'title'));
	}

	public function add($title)
	{
		$title = 'Create ' . $title;
		return view('user.create', compact('title'));
	}

	public function store(UserRequest $request)
	{
		DB::beginTransaction();
		try {
			$parts = explode("@", $request['email']);
			$username = $parts[0];
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

				$data['profile_picture'] = $profilePath;
			}
			$data = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'username' => $username,
				'email' => $request->email,
				'created_by' => auth()->user()->id,
				'restaurant_id' => $request->restaurant_id,
				'latitude' => $request->latitude,
				'longitude' => $request->longitude,
				'phone_number' => $request->phone_number,
				'password' => Hash::make($request->password),
			];

			$user = User::create($data);

			$user->assignRole($request->role);
			DB::commit();
			Session::flash('success', 'New User created successfully');

			return redirect('users');
		} catch (\Exception $ex) {
			DB::rollback();
			return response()->json(['error' => $ex->getMessage()], 500);
		}
	}

	public function edit($id, $title)
	{
		$title = 'Edit ' . $title;
		$model = $this->findModel($id);
		return view('user.edit', compact('model', 'title'));
	}

	public function update(UserRequest $request)
	{
		$user = $this->findModel($request->id);
		$data = $request->all();
		$data['created_by'] = auth()->user()->id;
		if ($request->has('profile')) {
			if (!empty($user->profile_picture)) {
				$userImage = public_path($user->profile_picture); // get previous image from folder
				if (file_exists($userImage)) { // unlink or remove previous image from folder
					unlink($userImage);
				}
			}
			$image = $request->file('profile');
			$input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

			$destinationPath = public_path('/uploads/profile');
			if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0777, true);
			}
			$img = Image::make($image->getRealPath());
			$img->save($destinationPath . '/' . $input['imagename']);

			$profilePath = 'uploads/profile/' . $input['imagename'];

			$data['profile_picture'] = $profilePath;
		}
		$user->update($data);
		$user->assignRole($request->role);
		return redirect('users');
	}
	public function show($id, $title)
	{
		$title = 'View ' . $title;
		$model = $this->findModel($id);
		return view('user.show', compact('model', 'title'));
	}

	public function destroy(Request $request)
	{
		$model = $this->findModel($request->id);
		$model->delete();
		return redirect()->route('users');
	}

	protected function findModel($id)
	{
		return User::find($id);
	}

	public function info(Request $request)
	{
		$restaurant = Restaurant::find($request->id);
		$data = [
			'address' => $restaurant->address,
			'latitude' => $restaurant->latitude,
			'longitude' => $restaurant->longitude,
		];

		echo json_encode($data);
	}
}

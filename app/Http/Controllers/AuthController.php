<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Helpers\Helper;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$model = Auth::all();
		return view('authuser.index', compact('model'));
	}

	public function create()
	{
		return view('authuser.create');
	}

	public function store(AuthRequest $request)
	{
		$data = [];

		if ($request->has('profile_picture')) {
			$image = $request->file('profile_picture');
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
			'username' => $request->username,
			'type' => $request->admin_type,
			'email' => $request->email,
			'created_by' => auth()->user()->id,
			'status' => $request->status,
			'state_id' => $request->state_id,
			'city_id' => $request->city_id,
			'country_id' => $request->country_id,
			'phone_number' => $request->phone_number,
			'password' => Hash::make($request->password),
			'role' => 'customer',
		];

		$user = Auth::create($data);

		Session::flash('success', 'New User created successfully');
		return Redirect::route('auth.index');
		// return redirect('users', 'page=' . $title);

	}

	public function edit($id)
	{
		$model = $this->findModel($id);
		return view('authuser.edit', compact('model'));
	}

	public function update(AuthRequest $request)
	{
		$user = $this->findModel($request->id);
		// dd($user);
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
		// $data['country_id'] = 166;
		$user->update($data);
		// $user->assignRole($request->role);
		return redirect()->route('auth.index');
	}
	public function show($id)
	{
		$model = $this->findModel($id);
		return view('authuser.show', compact('model'));
	}

	public function destroy(Request $request)
	{
		$model = $this->findModel($request->id);
		$model->delete();
		return redirect()->route('auth.index');
	}

	protected function findModel($id)
	{
		return Auth::find($id);
	}

	public function status($id)
	{
		$model = $this->findModel($id);
		$st = $model->status === 1 ? 0 : 1;
		$model->status = $st;
		$model->save();
		return redirect()->back();
	}
}

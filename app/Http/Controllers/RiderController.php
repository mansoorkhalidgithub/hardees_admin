<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Rider;
use App\Helpers\Helper;
use App\Http\Requests\RiderRequest;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Rider::all();
        return view('rider.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiderRequest $request)
    {
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
            'created_by' => auth()->user()->id,
            'restaurant_id' => $request->restaurant_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'country_id' => 166,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ];

        // print_r($data);
        // die;
        $rider = Rider::create($data);
        Session::flash('success', 'New User created successfully');
        return Redirect::route('rider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->findModel($id);
        return view('rider.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->findModel($id);
        return view('rider.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RiderRequest $request)
    {
        $rider = $this->findModel($request->id);
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        if ($request->has('profile')) {
            if (!empty($rider->profile_picture)) {
                $riderImage = public_path($rider->profile_picture); // get previous image from folder
                if (file_exists($riderImage)) { // unlink or remove previous image from folder
                    unlink($riderImage);
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
        $rider->update($data);
        return Redirect::route('rider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $model = $this->findModel($request->id);
        $model->delete();
        return redirect()->route('rider.index');
    }
    protected function findModel($id)
    {
        return Rider::find($id);
    }
    public function getCities(Request $request)
    {
        if (!$request->id) {
            $html = '<option value="">Select City</option>';
        } else {
            $html = '';
            $cities = City::where('state_id', $request->id)->get();
            foreach ($cities as $city) {
                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }
        if (!empty($html))
            return response()->json(['html' => $html]);
        else {
            $html = '<option value="">Select City</option>';
            return response()->json(['html' => $html]);
        }
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

    public function status($id)
    {
        $rider = $this->findModel($id);
        $st = $rider->status === Rider::STATUS_ACTIVE ? Rider::STATUS_INACTIVE : Rider::STATUS_ACTIVE;
        $rider->status = $st;
        $rider->save();
        return redirect()->back();
    }

    public function eStatus($id)
    {
        $rider = $this->findModel($id);
        $st = $rider->eStatus === Rider::STATUS_ONLINE ? Rider::STATUS_OFFLINE : Rider::STATUS_ONLINE;
        $rider->eStatus = $st;
        $rider->save();
        return redirect()->back();
    }
}

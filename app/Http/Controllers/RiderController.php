<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Rider;
use App\State;
use App\Country;
use App\Restaurant;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\RiderRequest;
use App\RiderDetail;
use App\RiderStatus;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
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
        $model = User::role('rider')->with('getRiderStatus')->get();
        // $model->each->append('Online');
        // foreach ($model as $model1) {
        //     $data = $model1->getRiderStatus;
        // }
        // print_r($data->online_status);
        // exit;
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
        // dd($request->all());
        $data = [];
        $profilePath = '';
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
            'address' => $request->address,
            'restaurant_id' => $request->restaurant_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'cnic' => $request->cnic,
            'cnic_expire_date' => $request->cnic_expire_date,
            'country_id' => $request->country_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'user_type' => 'rider',
        ];

        // print_r($data);
        // die;
        $rider = User::create($data);
        $rider->assignRole('rider');
        $rider_status = [
            'rider_id' => $rider->id,
            'online_status' => 'online',
            'trip_status' => 'free',
            'status' => 1
        ];
        $rider_detail = [
            'rider_id' => $rider->id,
            'vehicle_number' => $request->vehicle_number,
        ];
        RiderDetail::create($rider_detail);
        RiderStatus::create($rider_status);
        Session::flash('success', 'New Rider created successfully');
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
        // $data['created_by'] = auth()->user()->id;
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
        // dd($data);
        $rider->update($data);
        $rider_detailupdate = [
            'rider_id' => $rider->id,
            'vehicle_number' => $request->vehicle_number,
        ];
        $rider_detail = RiderDetail::where('rider_id', $rider->id)->first();
        $rider_detail->update($rider_detailupdate);
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
        return User::find($id);
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

    public function getBranches(Request $request)
    {
        $total = '';
        $online = '';
        $offline = '';
        if (isset($request) && !empty($request->name)) {
            $city_id = City::where('name', '=', $request->name)->firstOrFail();
            $total = User::where('city_id', '=', $city_id->id)->count();
            // $online = User::where('eStatus', '=', Config::get('constants.STATUS_ONLINE'))
            //     ->where('city_id', '=', $city_id->id)->count();
            // $offline = User::where('eStatus', '=', Config::get('constants.STATUS_OFFLINE'))
            //     ->where('city_id', '=', $city_id->id)->count();
            $online = 1;
            $offline = 0;
            if (!$city_id->id) {
                $html = '<option value="">Select Branch</option>';
            } else {
                $html = '<option value="">Select Branch</option>';
                $restaurants = Restaurant::where('city_id', $city_id->id)->get();
                foreach ($restaurants as $restaurant) {
                    $html .= '<option value="' . $restaurant->name . '">' . $restaurant->name . '</option>';
                }
            }
            if (!empty($html))
                echo json_encode([
                    'total' => $total,
                    'html' => $html,
                    'online' => $online,
                    'offline' => $offline,
                ]);
            else {
                $html = '<option value="">Select Branch</option>';
                echo json_encode([
                    'total' => $total,
                    'html' => $html,
                    'online' => $online,
                    'offline' => $offline,
                ]);
            }
        } else {
            $html = '<option value="">Select City First</option>';
            echo json_encode([
                'total' => $total,
                'html' => $html,
                'online' => $online,
                'offline' => $offline,
            ]);
        }
    }
    public function getStates(Request $request)
    {
        $total = '';
        $online = '';
        $offline = '';
        if (isset($request) && !empty($request->name)) {
            $country_id = Country::where('name', '=', $request->name)
                ->where('status', '=', 1)
                ->firstOrFail();
            $total = User::where('country_id', '=', $country_id->id)->count();
            // $online = User::where('eStatus', '=', Config::get('constants.STATUS_ONLINE'))
            //     ->where('country_id', '=', $country_id->id)->count();
            // $offline = User::where('eStatus', '=', Config::get('constants.STATUS_OFFLINE'))
            //     ->where('country_id', '=', $country_id->id)->count();
            $online = 5;
            $offline = 1;
            if (!$country_id->id) {
                $html = '<option value="">Select State</option>';
            } else {
                $html = '<option value="">Select State</option>';
                $states = State::where('country_id', '=', $country_id->id)->get();
                foreach ($states as $state) {
                    $html .= '<option value="' . $state->name . '">' . $state->name . '</option>';
                }
            }
            if (!empty($html)) {
                echo json_encode([
                    'total' => $total,
                    'html' => $html,
                    'online' => $online,
                    'offline' => $offline,
                ]);
                // return response()->json(['html' => $html]);
            } else {
                $html = '<option value="">Select State</option>';
                echo json_encode([
                    'total' => $total,
                    'html' => $html,
                    'online' => $online,
                    'offline' => $offline,
                ]);
            }
        } else {
            $html = '<option value="">Select State</option>';
            echo json_encode([
                'total' => $total,
                'html' => $html,
                'online' => $online,
                'offline' => $offline,
            ]);
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

    public function delivery_boy_management()
    {
        $cities = '';
        $countries = '';
        $model = User::role('rider')->get();
        if (!empty($model)) {
            foreach ($model as $key => $rider) {
                $city[] = $rider->city->name;
                $cities = array_unique($city);
                $country[] = $rider->country->name;
                $countries = array_unique($country);
            }
        }
        // dd($city);
        return view('rider.delivery_boy_management', compact('model', 'cities', 'countries'));
    }

    public function status($id)
    {
        $rider = $this->findModel($id);
        $st = $rider->status === Config::get('constants.STATUS_ACTIVE') ? Config::get('constants.STATUS_INACTIVE') : Config::get('constants.STATUS_ACTIVE');
        $rider->status = $st;
        $rider->save();
        return redirect()->back();
    }

    public function eStatus($id)
    {
        $rider = RiderStatus::where('rider_id', $id)
            ->where('status', 1)->first();
        $st = ($rider->online_status == 'online' ? 'offline' : 'online');
        $rider->online_status = $st;
        $rider->save();
        return redirect()->back();
    }

    public function tripStatus($id)
    {
        $rider = RiderStatus::where('rider_id', $id)
            ->where('status', 1)->first();
        $st = ($rider->trip_status == 'ontrip' ? 'free' : 'ontrip');
        $rider->trip_status = $st;
        $rider->save();
        return redirect()->back();
    }
}

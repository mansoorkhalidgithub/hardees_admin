<?php

namespace App\Http\Controllers\Api;

use App\User;
use DateTime;
use App\Order;
use App\Review;
use Carbon\Carbon;
use App\Restaurant;
use App\MasterModel;
use App\ReviewDetail;
use App\OrderAssigned;
use App\Helpers\Helper;
use App\RiderEarningSummary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TripStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class RiderApiController extends Controller
{

    public function riderRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
            'phone_number' => 'required',
            'password' => 'required',
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'errors' => $validator->messages()
            ];

            return response()->json($response);
        }
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $rider = User::create($data);
        $rider->assignRole('rider');
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Rider Registerd Successfully",
            'data' => $rider
        ];

        return response()->json($response);
    }
    /**
     * Login Rider Api.
     *
     * @return \Illuminate\Http\Response
     */
    public function riderLogin(Request $request)
    {
        $loggedInRider = User::where('phone_number', $request['phone_number'])->where('user_type', 'rider')->first();

        if (!empty($loggedInRider)) :
            if (Hash::check($request['password'], $loggedInRider->password)) {
                $data = [
                    "device_type" => $request->device_type,
                    "device_name" => $request->device_name,
                    "device_token" => $request->device_token,
                    "app_version" => $request->app_version,
                    "device_id" => $request->device_id,
                    "longitude" => $request->longitude,
                    "latitude" => $request->latitude,
                ];
                $loggedInRider->update($data);

                $role = $loggedInRider->roles->pluck('name');
                $tokenResult = $loggedInRider->createToken('rider');
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addDays(1);
                $status = ($loggedInRider->status == 1 ?  "Active" : "InActive");
                $trip_status = ($loggedInRider->status == 1 ?  "Yes" : "No");
                $response = [
                    'status' => 1,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Rider logged in successfully !',
                    'data' => [
                        'datamodel' => [
                            'rider_id' => $loggedInRider->id,
                            'first_name' => $loggedInRider->first_name,
                            'last_name' => $loggedInRider->last_name,
                            'email' => $loggedInRider->email,
                            'phone_number' => $loggedInRider->phone_number,
                            "city" => $loggedInRider->city->name,
                            "state" => $loggedInRider->state->name,
                            "country" => $loggedInRider->country->name,
                            "latitude" => $loggedInRider->latitude,
                            "longitude" => $loggedInRider->longitude,
                            "profile_picture" => asset($loggedInRider->profile_picture),
                            "status" => $status,
                            "trip_status" => $trip_status,
                            "notification_status" => "Yes",
                        ],
                        'dataDevices' => [
                            "device_type" => $loggedInRider->device_type,
                            'role' => $role,
                            "device_name" => $loggedInRider->device_name,
                            "device_id" => $loggedInRider->device_id,
                            "device_token" => $loggedInRider->device_token,
                            "app_version" => $loggedInRider->app_version,
                            'access_token' => $tokenResult->accessToken,
                            'token_type' => 'Bearer',
                            'expires_at' => Carbon::parse(
                                $tokenResult->token->expires_at
                            )->toDateTimeString(),
                            // "eLoginWith" => "N",
                            // "eVisible" => "Y"
                        ],
                        'dataVehicle' => [
                            "id" => 262,
                            "plate_number" => "leu-112",
                            "made_by" => "Suzuki",
                            "model" => "125",
                            "color" => "RED",
                            "image" => asset('images/ic_gallery.jpg'),
                            "model_year" => "2017",
                            "vehicle_type_id" => 52,
                            "title" => "Delivery Lahore"
                        ]
                    ]
                ];

                return response()->json($response);
            }
        endif;


        $response = [
            'status' => 0,
            'method' => $request->route()->getActionMethod(),
            'message' => 'Invalid phone number or password !',
        ];

        return response()->json($response);
    }
    /**
     * Display a Order requested  of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tripManage(Request $request)
    {
        $total_time = '';
        $eta = '';
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            // 'order_number' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'rider_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'errors' => $validator->messages()
            ];

            return response()->json($response);
        }
        $user_id = $request->user_id;
        $rider_id = $request->rider_id;
        $order_id = $request->order_id;
        $status = TripStatus::where('name', '=', $request->status)->first();
        // echo $status->name;
        // die;
        $user  = User::find($user_id);
        $rider = User::find($rider_id);
        $order = Order::with('orderItems.items')
            ->where('id', $order_id)->firstOrFail();

        $restaurant = Restaurant::find($order->restaurant_id);
        // Delivery Rejected
        if ($status->name == Config::get('constants.STATUS_REJECT')) {
            $data = [
                'order_id' => $request->order_id,
                'rider_id' => $request->rider_id,
                'trip_status_id' => $status->id
            ];
            $order = OrderAssigned::create($data);
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
                'data' => $order
            ];
            // MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }

        // Delivery Accepted
        if ($status->name == Config::get('constants.STATUS_ACCEPT')) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            // MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            $eta = 45;
        }

        // Rider Arrived 
        if ($status->name == Config::get('constants.STATUS_ARRIVED')) {
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
            ];
            // MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }

        // Rider Pickup
        if ($status->name == Config::get('constants.STATUS_PICKUP')) {
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
            ];
            MasterModel::notification($user->device_token, 'Your Order is Pickup');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }

        // Delivery Started
        if ($status->name == Config::get('constants.STATUS_START_DELIVERY')) {
            // session_start();
            // $_SESSION['start_time'][$rider_id][$order_id] = date('Y-m-d h:i:s');
            // $message = $status->description;
            $data = [
                'order_id' => $order_id,
                'rider_id' => $rider_id,
                'trip_status_id' => $status->id
            ];
            OrderAssigned::updateOrCreate($data);
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
        }

        // Delivery Complete
        if ($status->name == Config::get('constants.STATUS_COMPLETE_DELIVERY')) {
            $validator = Validator::make($request->all(), [
                'end_lat' => 'required',
                'end_long' => 'required',
                // 'rider_id' => 'required'
            ]);
            if ($validator->fails()) {
                $response = [
                    'status' => 0,
                    'method' => $request->route()->getActionMethod(),
                    'errors' => $validator->messages()
                ];

                return response()->json($response);
            }
            $lat2 = $request->end_lat;
            $lon2 = $request->end_long;
            $order->latitude = $lat2;
            $order->longitude = $lon2;
            $order->status = 10;
            $order->save();
            // $message = $status->description;
            $order_status = TripStatus::where('name', '=', 'TS')->first();
            $order_assigned = OrderAssigned::where('order_id', $order_id)
                ->where('rider_id', $rider_id)
                ->where('trip_status_id', $order_status->id)->first();
            $order_assigned->trip_status_id = $status->id;
            $order_assigned->save();
            $start = date_create($order_assigned->created_at);
            $end = date_create($order_assigned->updated_at);
            MasterModel::notification($user->device_token, 'Your Order is Delivered Now');
            MasterModel::notification($rider->device_token, $status->description);
            $total_time = date_diff($end, $start)->format('%H:%i:%s');
        }

        // Cash Collected
        if ($status->name == Config::get('constants.STATUS_CASH_COLLECTED')) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            // session_start();
            // $start_time = $_SESSION['start_time'][$rider_id][$order_id];
            // unset($_SESSION['start_time'][$rider_id][$order_id]);
            // echo $status->id;
            // die;
            $order_status = TripStatus::where('name', '=', 'TC')->first();
            $order_assigned = OrderAssigned::where('order_id', $order_id)
                ->where('rider_id', $rider_id)
                ->where('trip_status_id', $order_status->id)->first();
            $start = date_create($order_assigned->created_at);
            $end = date_create($order_assigned->updated_at);
            MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            $total_time = $end->diff($start)->format('%H:%i:%s');
            // $total_time = date_diff($end, $start);
            // $message = $status->description;

            // $rider_payment = [
            //     'order_id' => $order_id,
            //     'rider_id' => $rider_id,
            //     'amount' => $restaurant->delivery_charges
            // ];
            // RiderEarningSummary::create($rider_payment);
        }

        // Review By Rider 
        if ($status->name == Config::get('constants.STATUS_REVIEW')) {
            $data = [
                'user_id' => $request->rider_id,
                'order_id' => $request->order_id,
                'note' => $request->note,
                'rating' => $request->rating,
                'amount' => $request->amount
            ];
            $review = Review::updateOrCreate($data);
            if ($request->has('signatures')) {
                $image = $request->file('signatures');
                $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/uploads/signatures');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);

                $signaturePath = 'uploads/signatures/' . $input['imagename'];
                $signature = [
                    'review_id' => $review->id,
                    'review_img' => $signaturePath,
                    'review_type' => 'signature',
                ];
                ReviewDetail::create($signature);
                // $data['profile_picture'] = $profilePath;
            }
            if ($request->has('product_img')) {
                $images = $request->file('product_img');
                foreach ($images as $key => $image) {
                    $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('/uploads/orders');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath . '/' . $input['imagename']);

                    $ordersPath = 'uploads/orders/' . $input['imagename'];
                    $signature = [
                        'review_id' => $review->id,
                        'review_img' => $ordersPath,
                        'review_type' => 'orders',
                    ];
                    ReviewDetail::updateOrCreate($signature);
                }
            }
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
                // 'detail' => $order
            ];
            MasterModel::notification($user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }
        $lat1 = $restaurant->latitude;
        $lon1 = $restaurant->longitude;

        $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);
        $distance = round($distance, 2);
        $eta = $distance > 10 ? round(5 * $distance) // if
            : ($distance > 5 && $distance <= 10 ? round(7 * $distance) // elseif
                : ($status == Config::get('constants.STATUS_COMPLETE_DELIVERY') ? $total_time // elseif
                    : round(10 * $distance))); // else
        $order['distance'] = $distance;
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $status->description,

            'data' => [
                "booking_id" => 2000,
                "booking_number" => "Hardees002000",
                "country" => $order->customer->country,
                "state" => $order->customer->city,
                "city" => $order->customer->city,
                'name' => $order->customer->name,
                'phone_number' => $order->customer->phone_number,
                'email' => $order->customer->email,
                "invoice_number" => $order->id,
                "total" => $order->total,
                'items' => $order->orderItems->pluck('items.name'),
                "start_latitude" => $order->restaurant->latitude,
                "start_longitude" => $order->restaurant->longitude,
                "start_point" => $order->restaurant->name,
                "end_latitude" => $order->latitude,
                "end_longitude" => $order->longitude,
                "end_point" => $order->customer_address,
                "total_time" => $total_time,
                "distance" => $distance,
                "delivery_date" => $order->created_at,
                "booking_date" => $order->created_at,
                "end_delivery_date" => $order->updated_at,
                'ETA' => $eta . "Mins",
                "status" => "TPDD",
                "trip_status" => "N",
                "user_rating" => 2,
                "Payment_type" => $order->ordertype
            ]

            // 'items' => [
            //     OrderItem::where('order_id', $order->id)
            //         ->with('items')->get()->pluck('items.name')
            // ]
        ];

        return response()->json($response);
    }

    /**
     * Creating Rejected a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestRejected(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            // 'order_number' => 'required',
            'rider_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'errors' => $validator->messages()
            ];
            return response()->json($response);
        }

        $data = $request->all();
        $order = OrderAssigned::create($data);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Order Rejected By Rider",
            'detail' => $order
        ];
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReview(Request $request)
    {
        $data = [
            'user_id' => $request->rider_id,
            'order_id' => $request->order_id,
            'note' => $request->note,
            'rating' => $request->rating,
        ];
        $review = Review::updateOrCreate($data);
        if ($request->has('signatures')) {
            $image = $request->file('signatures');
            $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/signatures');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img = Image::make($image->getRealPath());
            $img->save($destinationPath . '/' . $input['imagename']);

            $signaturePath = 'uploads/signatures/' . $input['imagename'];
            $signature = [
                'review_id' => $review->id,
                'review_img' => $signaturePath,
                'review_type' => 'signature',
            ];
            ReviewDetail::create($signature);
            // $data['profile_picture'] = $profilePath;
        }
        if ($request->has('product_img')) {
            $images = $request->file('product_img');
            foreach ($images as $key => $image) {
                $input['imagename'] = Helper::generateRandomString() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('/uploads/orders');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);

                $ordersPath = 'uploads/orders/' . $input['imagename'];
                $signature = [
                    'review_id' => $review->id,
                    'review_img' => $ordersPath,
                    'review_type' => 'orders',
                ];
                ReviewDetail::updateOrCreate($signature);
            }
        }
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Review Added Successfully",
            // 'detail' => $order
        ];
        return response()->json($response);
    }

    public function earningDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rider_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'errors' => $validator->messages()
            ];
            return response()->json($response);
        }

        $from = date('Y-m-d 00:00:01');
        $to = date('Y-m-d 23:59:59');
        $today_booking = Order::whereBetween('created_at', [$from, $to])->get();
        $datenow = date('Y-m-d'); // date now
        $firstdayofweek = new DateTime($datenow);
        $lastdayofweek = new DateTime($datenow);
        $firstdayofweek->modify('last Monday');
        $lastdayofweek->modify('this sunday');
        $week_booking = Order::whereBetween('created_at', [$firstdayofweek, $lastdayofweek])->get();
        print_r($week_booking->count());
    }

    public function riderDetail(Request $request)
    {
        $loggedInRider = User::where('device_id', '=', $request->device_id)->first();
        $loggedInRider->append(
            'name'
        );
        if (!$loggedInRider) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'message' => "Rider Detail Not Found",
            ];
            return response()->json($response);
        }
        $status = ($loggedInRider->status == 1 ?  "Active" : "InActive");
        $trip_status = ($loggedInRider->status == 1 ?  "Yes" : "No");
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Rider Detail",
            'data' => [
                'datamodel' => [
                    'rider_id' => $loggedInRider->id,
                    'first_name' => $loggedInRider->first_name,
                    'last_name' => $loggedInRider->last_name,
                    'email' => $loggedInRider->email,
                    'phone_number' => $loggedInRider->phone_number,
                    "city" => $loggedInRider->city->name,
                    "state" => $loggedInRider->state->name,
                    "country" => $loggedInRider->country->name,
                    "latitude" => $loggedInRider->latitude,
                    "longitude" => $loggedInRider->longitude,
                    "profile_picture" => asset($loggedInRider->profile_picture),
                    "status" => $status,
                    "trip_status" => $trip_status,
                    "notification_status" => "Yes",
                ],
                'dataDevices' => [
                    "device_type" => $loggedInRider->device_type,
                    "device_name" => $loggedInRider->device_name,
                    "device_id" => $loggedInRider->device_id,
                    "device_token" => $loggedInRider->device_token,
                    "app_version" => $loggedInRider->app_version,
                    'token_type' => 'Bearer',
                    // "eLoginWith" => "N",
                    // "eVisible" => "Y"
                ],
                'dataVehicle' => [
                    "id" => 262,
                    "plate_number" => "leu-112",
                    "made_by" => "Suzuki",
                    "model" => "125",
                    "color" => "RED",
                    "image" => asset('images/ic_gallery.jpg'),
                    "model_year" => "2017",
                    "vehicle_type_id" => 52,
                    "title" => "Delivery Lahore"
                ]
            ]
        ];

        return response()->json($response);
    }


    public function deliveryDetail(Request $request)
    {
        $order = Order::with('orderItems.items')
            ->where('id', $request->order_id)->firstOrFail();
        // dd($order);
        // die;
        $total_time = $order->updated_at->diff($order->created_at)->format('%H:%i:%s');
        if (!$order) {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'message' => "Order Detail Not Found",
            ];
            return response()->json($response);
        }
        $start_lat = $order->restaurant->latitude;
        $start_lon = $order->restaurant->longitude;
        $end_lat = $order->latitude;
        $end_lon = $order->longitude;
        $distance = MasterModel::distance($start_lat, $start_lon, $end_lat, $end_lon);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Order Detail",
            'data' => [
                "booking_id" => 2000,
                "booking_number" => "Hardees002000",
                "country" => $order->customer->country,
                "state" => $order->customer->city,
                "city" => $order->customer->city,
                'name' => $order->customer->name,
                'phone_number' => $order->customer->phone_number,
                'email' => $order->customer->email,
                "invoice_number" => $order->id,
                "total" => $order->total,
                'items' => $order->orderItems->pluck('items.name'),
                "start_latitude" => $order->restaurant->latitude,
                "start_longitude" => $order->restaurant->longitude,
                "start_point" => $order->restaurant->name,
                "end_latitude" => $order->latitude,
                "end_longitude" => $order->longitude,
                "end_point" => $order->customer_address,
                "total_time" => $total_time,
                "distance" => $distance,
                "delivery_date" => $order->created_at,
                "booking_date" => $order->created_at,
                "end_delivery_date" => $order->updated_at,
                "status" => "TPDD",
                "trip_status" => "N",
                "user_rating" => 2,
                "Payment_type" => $order->ordertype
            ]

        ];

        return response()->json($response);
    }
    public function updateProfile(Request $request)
    {
        return 'Update Profile';
    }
}

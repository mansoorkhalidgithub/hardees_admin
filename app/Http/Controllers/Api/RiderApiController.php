<?php

namespace App\Http\Controllers\Api;

use App\User;
use DateTime;
use App\Order;
use App\Review;
use App\Version;
use Carbon\Carbon;
use App\Restaurant;
use App\TripStatus;
use App\MasterModel;
use App\RiderStatus;
use App\ReviewDetail;
use App\OrderAssigned;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class RiderApiController extends Controller
{
    public function __construct()
    {
    }

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
        $order_id = '';
        $loggedInRider = User::where('phone_number', $request['phone_number'])->where('user_type', 'rider')->first();
        if ($loggedInRider->device_id != $request->device_id) :
            DB::table('oauth_access_tokens')
                ->where('user_id', $loggedInRider->id)->delete();
            $logout = [
                "order_id" => 'order_id',
                "device_token" => $loggedInRider->device_token,
                "status" => "logout",
                "message" => "You are Logout"
            ];
            Helper::sendNotification($logout);
        endif;
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
                $rider_status = RiderStatus::where('rider_id', $loggedInRider->id)
                    ->where('status', 1)->first();
                $st = ($rider_status->online_status = 'offline' ? 'online' : 'online');
                $rider_status->online_status = $st;
                $rider_status->save();
                $role = $loggedInRider->roles->pluck('name');
                $tokenResult = $loggedInRider->createToken('rider');
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addDays(1);
                $status = ($loggedInRider->status == 1 ?  "Active" : "InActive");
                $trip_status = ($loggedInRider->getRiderStatus->trip_status == 'ontrip' ?  "Yes" : "No");
                if ($rider_status->trip_status == 'ontrip') {
                    $gt_ord = OrderAssigned::where('rider_id', $loggedInRider->id)
                        ->where('status', 1)
                        ->whereIn('trip_status_id', [2, 3, 4])->first();
                    $order_id = $gt_ord->order_id;
                    // exit;
                }
                $response = [
                    'status' => 1,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Rider logged in successfully !',
                    'data' => [
                        'datamodel' => [
                            'order_id' => $order_id,
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
                            'role' => $role,
                        ],
                        'dataDevices' => [
                            "device_type" => $loggedInRider->device_type,
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
                            "plate_number" => $loggedInRider->vehicle->vehicle_number,
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
        $rider_id = Auth::user()->id;
        // die;
        $total_time = '';
        $message_response = '';
        $eta = '';
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            // 'order_number' => 'required',
            // 'user_id' => 'required',
            'status' => 'required',
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
        // $user_id = $request->user_id;
        $order_id = $request->order_id;
        $get_order_status = OrderAssigned::where('order_id', '=', $order_id)
            ->where('rider_id', $rider_id)
            ->where('status', 1)->first();
        $rider = User::find($rider_id);
        $status = TripStatus::where('name', '=', $request->status)->first();
        // echo $status->name;
        // die;
        // $user  = User::find($user_id);
        //$rider = User::find($rider_id);
        $order = Order::where('id', $order_id)->firstOrFail();
        $user = User::find($order->user_id);
        $restaurant = Restaurant::find($order->restaurant_id);
        // Delivery Rejected
        if ($status->name == Config::get('constants.STATUS_REJECT')) {
            $data = [
                'order_id' => $request->order_id,
                'rider_id' => $rider_id,
                'trip_status_id' => $status->id
            ];
            $order = OrderAssigned::create($data);
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
                'data' => $order
            ];
            // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }

        // Delivery Accepted
        if ($status->name == Config::get('constants.STATUS_ACCEPT')) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            $rider_status = RiderStatus::where('rider_id', '=', $rider_id)
                ->where('online_status', '=', 'online')
                ->where('status', '=', 1)
                ->where('trip_status', '=', 'free')
                ->first();
            $rider_status->trip_status = 'ontrip';
            $rider_status->save();
            $get_order_status->trip_status_id = $status->id;
            $get_order_status->save();
            // $rider = OrderAssigned::where('order_id', '=', $order_id)->where('trip_status_id', '=', 1)->first();
            // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
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
            $get_order_status->trip_status_id = $status->id;
            $get_order_status->save();
            // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
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
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }

        // Delivery Started
        if ($status->name == Config::get('constants.STATUS_START_DELIVERY')) {
            // session_start();
            // $_SESSION['start_time'][$rider_id][$order_id] = date('Y-m-d h:i:s');
            // $message = $status->description;
            if ($order->status == 4 || $order->status == 5 || $order->status == 6) {
                $data = [
                    'order_id' => $order_id,
                    'rider_id' => $rider_id,
                    'trip_status_id' => $status->id
                ];
                $order->status = 5;
                $order->save();
                $get_order_status->trip_status_id = $status->id;
                $get_order_status->save();
                OrderAssigned::updateOrCreate($data);
                $lat2 = $order->latitude;
                $lon2 = $order->longitude;
                $message = "Great%20choice%20.%20Your%20order%20is%20on%20its%20way.%20Check%20below%20for%20your%20order%20details.%20Your%20Rider%20Name%20is%20" . Auth::user()->first_name . "%20" . Auth::user()->last_name . "%20And%20Total%20Amount%20is%20" . $order->total . "%20And%20Rider%20Mobile%20Number%20is%20" . Auth::user()->phone_number;

                $messageData = [
                    'number' => $user->phone_number,
                    'message' => $message,
                ];
                // Helper::sendMessage($messageData);
                $customerNotification = [
                    'order_id' => $order->id,
                    'device_token' => $user->device_token,
                    'status' => 'OFD',
                    'message' => 'Your Order is on the Way'
                ];
                Helper::sendNotification($customerNotification);
                MasterModel::notification($rider->device_token, $status->description);
            } else {
                $response = [
                    'status' => 0,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Order is Not Prepared Yet',
                ];
                MasterModel::notification($rider->device_token, 'Order is Not Prepared Yet');
                return response()->json($response);
            }
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
            $order->status = 6;
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
            $customerNotification = [
                'order_id' => $order->id,
                'device_token' => $user->device_token,
                'status' => 'TC',
                'message' => 'Your Order is Delivered Now'
            ];
            Helper::sendNotification($customerNotification);
            // MasterModel::notification($user->device_token, 'Your Order is Delivered Now');
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
            $ids = OrderAssigned::where('order_id', $request->order_id)
                ->whereNotIn('trip_status_id', [5])->update(['status' => 0]);
            // OrderAssigned::whereIn('id', $ids)->update(['status' => 0]);
            $order_status = TripStatus::where('name', '=', 'TC')->first();
            $order_assigned = OrderAssigned::where('order_id', $order_id)
                ->where('rider_id', $rider_id)
                ->where('trip_status_id', $order_status->id)->first();
            $start = date_create($order_assigned->created_at);
            $end = date_create($order_assigned->updated_at);
            $message = "Thank%20you%20for%20ordering%20food%20at%20Hardees%20,%20enjoy%20your%20meal.";

            $messageData = [
                'number' => Auth::user()->phone_number,
                'name' => Auth::user()->name,
                'order' => $order->total,
                'message' => $message,
            ];
            // Helper::sendMessage($messageData);
            // MasterModel::notification($user->device_token, 'Your Order is on the Way');
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
            OrderAssigned::where('order_id', $request->order_id)->update(['status' => 0]);
            $data = [
                'user_id' => $order->user_id,
                'order_id' => $request->order_id,
                'note' => $request->note,
                'rating' => $request->rating,
                // 'amount' => $request->amount
            ];
            $rider_status = RiderStatus::where('rider_id', '=', $rider_id)
                ->where('online_status', '=', 'online')
                ->where('status', '=', 1)
                ->where('trip_status', '=', 'ontrip')
                ->first();
            $rider_status->trip_status = 'free';
            $rider_status->save();
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
            // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
            MasterModel::notification($rider->device_token, $status->description);
            return response()->json($response);
        }
        if ($status->name == Config::get('constants.STATUS_REJECTED_AFTER_ACCEPT')) {
            $get_order_status->trip_status_id = $status->id;
            $get_order_status->save();
            $rider_status = RiderStatus::where('rider_id', '=', $rider_id)
                ->where('online_status', '=', 'online')
                ->where('status', '=', 1)
                ->where('trip_status', '=', 'ontrip')
                ->first();
            $rider_status->trip_status = 'free';
            $rider_status->save();
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => $status->description,
                // 'detail' => $order
            ];
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
        $trip_status = ($rider->getRiderStatus->trip_status == 'ontrip' ?  "ontrip" : "free");
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $status->description,

            'data' => [
                "booking_id" => $order->id,
                "booking_number" => "Hardees00000" . $order->id,
                "country" => $order->customer->country,
                "state" => $order->customer->city,
                "city" => $order->customer->city,
                'name' => $order->customer->name,
                'user_id' => $order->user_id,
                'profile_img' => asset($order->customer->profile_picture),
                'phone_number' => $order->customer->phone_number,
                'email' => $order->customer->email,
                "invoice_number" => $order->id,
                "total" => $order->total,
                'menu_items' => [
                    'items' => $order->append('orderItems')->orderItems
                ],
                // 'deals' => $order->orderDeals->pluck('deal.dealItems.name'),
                // 'addons' => $order->orderAddons->pluck('addon.name'),
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
                'ETA' => $eta . " Mins",
                "status" => "TR",
                "trip_status" => $trip_status,
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
        $loggedInRider =  Auth::user();
        $order_id = '';

        $status = ($loggedInRider->status == 1 ?  "Active" : "InActive");
        $trip_status = ($loggedInRider->getRiderStatus->trip_status == 'ontrip' ?  "ontrip" : "free");
        if ($loggedInRider->getRiderStatus->trip_status == 'ontrip') {
            $gt_ord = OrderAssigned::where('rider_id', $loggedInRider->id)
                ->where('status', 1)
                ->whereIn('trip_status_id', [2, 3, 4])->first();
            if ($gt_ord)
                $order_id = $gt_ord->order_id;
            // exit;
        }
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Rider Detail",
            'data' => [
                'datamodel' => [
                    'order_id' => $order_id,
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
                    "plate_number" => $loggedInRider->vehicle->vehicle_number,
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
        $trip_status = OrderAssigned::where('order_id', $request->order_id)
            ->where('trip_status_id', '!=', 9)
            ->where('trip_status_id', '!=', 8)
            ->first();

        $start_lat = $order->restaurant->latitude;
        $start_lon = $order->restaurant->longitude;
        $end_lat = $order->latitude;
        $end_lon = $order->longitude;
        // $profile_img = 
        $distance = MasterModel::distance($start_lat, $start_lon, $end_lat, $end_lon);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Order Detail",
            'data' => [
                "booking_id" => $order->id,
                "booking_number" => "Hardees00000" . $order->id,
                "country" => $order->customer->country,
                "state" => $order->customer->city,
                "city" => $order->customer->city,
                'user_id' => $order->customer->id,
                'profile_img' => asset($order->customer->profile_picture),
                'name' => $order->customer->name,
                'phone_number' => $order->customer->phone_number,
                'email' => $order->customer->email,
                "invoice_number" => $order->id,
                "total" => $order->total,
                'menu_items' => [
                    'items' => $order->append('orderItems')->orderItems
                ],
                "start_latitude" => $order->restaurant->latitude,
                "start_longitude" => $order->restaurant->longitude,
                "start_point" => $order->restaurant->name,
                "end_latitude" => $order->latitude,
                "end_longitude" => $order->longitude,
                "end_point" => $order->customer_address,
                "total_time" => $total_time,
                "distance" => $distance,
                // Carbon\Carbon::parse($input)->format($format1);
                "delivery_date" => Carbon::parse($order->created_at)->format('Y-m-d'),
                "delivery_time" => Carbon::parse($order->created_at)->format('H:i:s'),
                "booking_date" => Carbon::parse($order->created_at)->format('Y-m-d'),
                "booking_time" => Carbon::parse($order->created_at)->format('H:i:s'),
                "end_delivery_date" => Carbon::parse($order->updated_at)->format('Y-m-d'),
                "end_delivery_time" => Carbon::parse($order->updated_at)->format('H:i:s'),
                "status" => "TR",
                "trip_status" => "N",
                "user_rating" => 2,
                "Payment_type" => $order->ordertype
            ]

        ];

        return response()->json($response);
    }
    public function updateProfile(Request $request)
    {
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Profile Is Updated",
        ];
        return response()->json($response);
    }

    public function ordersHistory(Request $request)
    {
        $rider_id = Auth::user()->id;
        $today = Carbon::today();
        $todayStart = $today->copy()->startOfDay();
        $todayEnd = $today->copy()->endOfDay();
        // current day Rider order
        // Rider Total Order Id
        $get_rider_today = OrderAssigned::where('rider_id', '=', $rider_id)
            ->where('trip_status_id', '5')
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->pluck('order_id');
        $total_earning_today = Order::whereIn('id', $get_rider_today)->sum('total');
        $today_orders = Order::whereIn('id', $get_rider_today)->get();
        $today_orders->each->append('orderItems', 'customername', 'rating', 'time', 'distance');
        $get_rider_all = OrderAssigned::where('rider_id', '=', $rider_id)
            ->where('trip_status_id', '5')
            ->pluck('order_id');

        $total_earning_all = Order::whereIn('id', $get_rider_all)->sum('total');
        // dd($get_rider_all->all());
        $orders = Order::whereIn('id', $get_rider_all)->get();
        $orders->each->append('orderItems', 'customername', 'rating', 'time', 'distance');
        // print_r($orders);
        // exit;
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "Order History",
            'data' => [
                'today' => [
                    "myearning" => "₨: " . $total_earning_today,
                    "spendtime" => "0h 0m",
                    "completedtrip" => $today_orders->count(),
                    "memberdata" => $today_orders,
                ],
                'all_orders' => [
                    "myearning" => "₨: " . $total_earning_all,
                    "spendtime" => "0h 0m",
                    "completedtrip" => $orders->count(),
                    "memberdata" => $orders
                ]
            ]
        ];
        return response()->json($response);
    }

    public function riderStatus(Request $request)
    {
        $rider = Auth::user();
        $rider_status = RiderStatus::where('rider_id', '=', $rider->id)
            ->where('status', '=', 1)->first();
        $rider_status->online_status = $request->status;
        $rider_status->save();
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "You Are " . $rider_status->online_status,
        ];
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $rider_id = Auth::user()->id;
        $request->user()->token()->revoke();
        $rider_status = RiderStatus::where('rider_id', $rider_id)
            ->where('online_status', 'online')->where('status', 1)->first();
        $rider_status->online_status = 'offline';
        $rider_status->save();
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => "You Are Logout",
        ];
        return response()->json($response);
    }


    public function token()
    {
        $token = 'f4Me_EHmPMw:APA91bFYuZ65TmS7jjGWPt0lFm6FYwghqltps8BAA012RwU1M-RFgL66Ou8Mcg7gGmK9E-3S45DfvKKzMYs2FWYB2-4fkRvSc-670x73vRpYK7LwRMfpDhModSm8ny3zlnyBVlGltr_w';
        MasterModel::notification($token, 'test');
        return '2000';
    }

    public function version(Request $request)
    {
        $version = Version::where('type', 'rider')->first();
        if ($request->device_type == 'A') {
            if ($version->android == $request->version) {
                $response = [
                    'status' => 1,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Your app is updated'
                ];
                return response()->json($response);
            } else {
                $response = [
                    'status' => 0,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Please update Your App'
                ];
                return response()->json($response);
            }
        } elseif ($request->device_type == 'I') {
            if ($version->android == $request->version) {
                $response = [
                    'status' => 1,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Your app is updated'
                ];
                return response()->json($response);
            } else {
                $response = [
                    'status' => 0,
                    'method' => $request->route()->getActionMethod(),
                    'message' => 'Please update Your App'
                ];
                return response()->json($response);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\User;
use DateTime;
use App\Order;
use Carbon\Carbon;
use App\Restaurant;
use App\MasterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderAssigned;
use App\RiderEarningSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $loggedInRider = User::where('phone_number', $request['phone_number'])->first();
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
                            "iDriverVehicleId" => 262,
                            "vPlateno" => "leu-112",
                            "vMake" => "Suzuki",
                            "vModel" => "125",
                            "vColour" => "RED",
                            "vImage" => "https://beshappii.happiiride.org/uploads/images/Membercar/default.png",
                            "vYear" => "2017",
                            "iVehicleTypeId" => 52,
                            "vTitle" => "Delivery Lahore"
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
        $status = $request->status;
        $user  = User::find($user_id);
        $order = Order::with('orderItems.items')
            ->where('id', $order_id)->firstOrFail();

        $restaurant = Restaurant::find($order->restaurant_id);

        // Delievry Rejected
        if ($status == Order::STATUS_REJECT) {
            $data = [
                'order_id' => $request->order_id,
                'rider_id' => $request->rider_id,
                'status' => $status
            ];
            $order = OrderAssigned::create($data);
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => "Order Rejected By Rider",
                'data' => $order
            ];
            return response()->json($response);
        }

        // Delivery Accepted
        if ($status == Order::STATUS_ACCEPT) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            $message = 'DELIVERY_ACCPETED !';
            $eta = 45;
        }

        // Delivery Started
        if ($status == Order::STATUS_START_DELIVERY) {
            // session_start();
            // $_SESSION['start_time'][$rider_id][$order_id] = date('Y-m-d h:i:s');
            // Session::put('start_time', $time);
            $message = "START_DELIVERY";
            $data = [
                'order_id' => $order_id,
                'rider_id' => $rider_id,
                'status' => Order::STATUS_START_DELIVERY
            ];
            OrderAssigned::updateOrCreate($data);
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
        }

        // Delievry Complete
        if ($status == Order::STATUS_COMPLETE_DELIVERY) {
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
            $order->save();
            $message = 'DELIVERY_COMPLETED !';
            $order_assigned = OrderAssigned::where('order_id', $order_id)
                ->where('rider_id', $rider_id)
                ->where('status', Order::STATUS_START_DELIVERY)->first();
            $order_assigned->status = Order::STATUS_COMPLETE_DELIVERY;
            $order_assigned->save();
            $start = date_create($order_assigned->created_at);
            $end = date_create($order_assigned->updated_at);

            $total_time = date_diff($end, $start);
        }

        // Cash Collected
        if ($status == Order::STATUS_CASH_COLLECTED) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            // session_start();
            // $start_time = $_SESSION['start_time'][$rider_id][$order_id];
            // unset($_SESSION['start_time'][$rider_id][$order_id]);

            $order_assigned = OrderAssigned::where('order_id', $order_id)
                ->where('rider_id', $rider_id)
                ->where('status', Order::STATUS_COMPLETE_DELIVERY)->first();
            $start = date_create($order_assigned->created_at);
            $end = date_create($order_assigned->updated_at);

            $total_time = date_diff($end, $start);
            $message = "CASH_COLLECTED";

            // $rider_payment = [
            //     'order_id' => $order_id,
            //     'rider_id' => $rider_id,
            //     'amount' => $restaurant->delivery_charges
            // ];
            // RiderEarningSummary::create($rider_payment);
        }
        $lat1 = $restaurant->latitude;
        $lon1 = $restaurant->longitude;

        $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);
        $distance = round($distance, 2);
        $eta = $distance > 10 ? round(5 * $distance) // if
            : ($distance > 5 && $distance <= 10 ? round(7 * $distance) // elseif
                : ($status == Order::STATUS_COMPLETE_DELIVERY ? $total_time->i // elseif
                    : round(10 * $distance))); // else
        $order['distance'] = round($distance, 2);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $message,

            'data' => [
                'name' => $user->first_name . " " . $user->last_name,
                'phone_number' => $user->phone_number,
                'invoice_number' => $order->id,
                'total_amount' => $order->total,
                'distance' => $order->distance,
                'pickup' => $restaurant->name,
                'dropoff' => $user->address,
                'start_lat' => $restaurant->latitude,
                'start_lon' => $restaurant->longitude,
                'end_lat' => $lat2,
                'end_lon' => $lon2,
                'items' => $order->orderItems->pluck('items.name'),
                'ETA' => $eta . " Mins",
                'total_time' => $total_time,
            ],

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
        echo "Review";
        exit;
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
}

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
        if (Auth::guard('web')->attempt(['phone_number' => $request['phone_number'], 'password' => $request['password']], $request->get('remember'))) {
            $loggedInRider = Auth::user();
            $role = $loggedInRider->roles->pluck('name');
            $tokenResult = $loggedInRider->createToken('rider');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addDays(1);

            $rider = [
                'name' => $loggedInRider->first_name . " " . $loggedInRider->last_name,
                'email' => $loggedInRider->email,
                'phone_number' => $loggedInRider->phone_number,
                'role' => $role
            ];

            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => 'Rider logged in successfully !',
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'rider_id' => $loggedInRider->id,
                'customer_profile' => $rider,
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ];

            return response()->json($response);
        }
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
    public function requestAccepted(Request $request)
    {
        $total_time = '';
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
        if ($status == Order::STATUS_ACCEPT) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            $message = 'DELIVERY_ACCPETED !';
        }
        if ($status == Order::STATUS_START_DELIVERY) {
            session_start();
            $time = date('Y-m-d h:i:s');
            $_SESSION['start_time'][$rider_id][$order_id] = $time;
            // Session::put('start_time', $time);
            $response = [
                'status' => 1,
                'method' => $request->route()->getActionMethod(),
                'message' => "START_DELIVERY",
                'data' => [
                    'start_time' => $time
                ]
            ];

            return response()->json($response);
        }
        if ($status == Order::STATUS_COMPLETE) {
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
        }
        if ($status == Order::STATUS_CASH_COLLECTED) {
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            session_start();
            $start_time = $_SESSION['start_time'][$rider_id][$order_id];
            // unset($_SESSION['start_time'][$rider_id][$order_id]);
            // print_r($start_time);
            // die;
            $start = date_create($start_time);
            $end = date_create(date('Y-m-d h:i:s'));
            $total_time = date_diff($end, $start);
            $message = "CASH_COLLECTED";
        }
        $lat1 = $restaurant->latitude;
        $lon1 = $restaurant->longitude;

        $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);
        $distance = round($distance, 2);

        $order['distance'] = round($distance, 2);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $message,
            'user' => $user->first_name . " " . $user->last_name,
            'order_detail' => [
                'invoice_number' => $order->id,
                'total_amount' => $order->total,
                'distance' => $order->distance,
                'items' => $order->orderItems->pluck('items.name'),
            ],
            'total_time' => $total_time,
            // 'items' => [
            //     OrderItem::where('order_id', $order->id)
            //         ->with('items')->get()->pluck('items.name')
            // ]
            'location' => [
                'pickup' => $restaurant->name,
                'dropoff' => $user->address,
                'start_lat' => $restaurant->latitude,
                'start_lon' => $restaurant->longitude,
                'end_lat' => $lat2,
                'end_lon' => $lon2,
            ]
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

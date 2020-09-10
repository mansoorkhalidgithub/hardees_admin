<?php

namespace App\Http\Controllers\Api;

use App\User;
use DateTime;
use App\Order;
use App\Review;
use Carbon\Carbon;
use App\Restaurant;
use App\TripStatus;
use App\MasterModel;
use App\ReviewDetail;
use App\OrderAssigned;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\RiderStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class RiderAuthController extends Controller
{
    public function tripManage(Request $request)
    {
        if (Auth::user()->user_type == 'rider') {
            $rider = Auth::user();
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'status' => 0,
                    'method' => $request->route()->getActionMethod(),
                    'errors' => $validator->messages()
                ];

                return response()->json($response);
            }
            $order = Order::with('orderItems.items')
                ->where('id', $request->order_id)->firstOrFail();
            $status = TripStatus::where('name', '=', $request->status)->first();
            if ($status->name == Config::get('constants.STATUS_REJECT')) {
                return $this->reject($request, $rider, $status);
            }
            if ($status->name == Config::get('constants.STATUS_ACCEPT')) {
                return $this->accept($request, $order, $rider, $status);
            }
            if ($status->name == Config::get('constants.STATUS_ARRIVED')) {
                return $this->arrived($request, $rider, $status);
            }
            if ($status->name == Config::get('constants.STATUS_START_DELIVERY')) {
                return $this->start($request, $order, $rider, $status);
            }
            if ($status->name == Config::get('constants.STATUS_COMPLETE_DELIVERY')) {
                return $this->complete($request, $order, $rider, $status);
            }
            if ($status->name == Config::get('constants.STATUS_CASH_COLLECTED')) {
            }
        } else {
            $response = [
                'status' => 0,
                'method' => $request->route()->getActionMethod(),
                'errors' => "Please contact to Support center"
            ];

            return response()->json($response);
        }
    }


    protected function reject($request, $rider, $status)
    {
        $data = [
            'order_id' => $request->order_id,
            'rider_id' => $rider->id,
            'trip_status_id' => $status->id
        ];
        OrderAssigned::create($data);
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $status->description,
        ];
        // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
        MasterModel::notification($rider->device_token, $status->description);
        return response()->json($response);
    }

    protected function accept($request, $order, $rider, $status)
    {
        $data = [
            'order_id' => $request->order_id,
            'rider_id' => $rider->id,
            'trip_status_id' => $status->id
        ];
        OrderAssigned::create($data);
        $lat2 = $order->latitude;
        $lon2 = $order->longitude;
        $this->riderStatus($rider->id);
        MasterModel::notification($rider->device_token, $status->description);
        $lat1 = $order->restaurant->latitude;
        $lon1 = $order->restaurant->longitude;

        $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);

        $order['eta'] = $distance > 10 ? round(5 * $distance) // if
            : ($distance > 5 && $distance <= 10 ? round(7 * $distance) // elseif
                : round(10 * $distance)); // else
        $order['distance'] = $distance;
        $order['trip_status'] = ($rider->getRiderStatus->trip_status == 'free' ? 'N' : 'Y');

        return $this->getJsonResponse($request, $status, $order);
    }

    protected function arrived($request, $rider, $status)
    {
        $response = [
            'status' => 1,
            'method' => $request->route()->getActionMethod(),
            'message' => $status->description,
        ];
        $data = [
            'order_id' => $request->order_id,
            'rider_id' => $rider->id,
            'trip_status_id' => $status->id
        ];
        OrderAssigned::create($data);
        // MasterModel::notification($user->device_type,$user->device_token, 'Your Order is on the Way');
        MasterModel::notification($rider->device_token, $status->description);
        return response()->json($response);
    }

    protected function start($request, $order, $rider, $status)
    {
        if ($order->status == 4) {
            $data = [
                'order_id' => $request->order_id,
                'rider_id' => $rider->id,
                'trip_status_id' => $status->id
            ];
            $order->status = 5;
            $order->save();
            OrderAssigned::create($data);
            $lat2 = $order->latitude;
            $lon2 = $order->longitude;
            MasterModel::notification($rider->device_token, $status->description);
            $lat1 = $order->restaurant->latitude;
            $lon1 = $order->restaurant->longitude;

            $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);

            $order['eta'] = $distance > 10 ? round(5 * $distance) // if
                : ($distance > 5 && $distance <= 10 ? round(7 * $distance) // elseif
                    : round(10 * $distance)); // else
            $order['distance'] = $distance;
            $order['trip_status'] = ($rider->getRiderStatus->trip_status == 'free' ? 'N' : 'Y');

            return $this->getJsonResponse($request, $status, $order);
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

    protected function complete($request, $order, $rider, $status)
    {
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
        $lat1 = $order->restaurant->latitude;
        $lon1 = $order->restaurant->longitude;
        $lat2 = $request->end_lat;
        $lon2 = $request->end_long;
        $order->latitude = $lat2;
        $order->longitude = $lon2;
        $order->status = 6;
        $order->save();
        $data = [
            'order_id' => $request->order_id,
            'rider_id' => $rider->id,
            'trip_status_id' => $status->id
        ];

        $get_start_time = OrderAssigned::where('order_id', $order->id)
            ->where('rider_id', $rider->id)
            ->where('trip_status_id', 4)->first();
        $order_assigned = OrderAssigned::create($data);
        $start = date_create($get_start_time->created_at);
        $end = date_create($order_assigned->updated_at);
        // MasterModel::notification($user->device_token, 'Your Order is Delivered Now');
        MasterModel::notification($rider->device_token, $status->description);
        $total_time = date_diff($end, $start)->format('%H:%i:%s');
        $distance = MasterModel::distance($lat1, $lon1, $lat2, $lon2);

        $order['eta'] = $total_time;
        $order['distance'] = $distance;
        $order['trip_status'] = ($rider->getRiderStatus->trip_status == 'free' ? 'N' : 'Y');
        return $this->getJsonResponse($request, $status, $order);
    }

    protected function cashCollected()
    {
    }

    protected function riderStatus($id)
    {
        $rider_status = RiderStatus::where('rider_id', '=', $id)
            ->where('online_status', '=', 'online')
            ->where('status', '=', 1)
            ->where('trip_status', '=', 'free')
            ->first();
        $rider_status->trip_status = 'ontrip';
        return $rider_status->save();
    }

    protected function getJsonResponse($request, $status, $order)
    {
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
                'items' => $order->orderItems->pluck('items.name'),
                "start_latitude" => $order->restaurant->latitude,
                "start_longitude" => $order->restaurant->longitude,
                "start_point" => $order->restaurant->name,
                "end_latitude" => $order->latitude,
                "end_longitude" => $order->longitude,
                "end_point" => $order->customer_address,
                "total_time" => '',
                "distance" => $order->distance,
                "delivery_date" => $order->created_at,
                "booking_date" => $order->created_at,
                "end_delivery_date" => $order->updated_at,
                'ETA' => $order->eta . " Mins",
                "status" => "TPDD",
                "trip_status" => $order->trip_status,
                "user_rating" => 2,
                "Payment_type" => $order->ordertype
            ]
        ];

        return response()->json($response);
    }
}

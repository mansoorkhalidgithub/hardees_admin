<?php

namespace App;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    const ADMIN_TYPE = [
        '1' => 'Country Admin',
        '2' => 'City Admin',
        '3' => 'State Admin',
        '4' => 'Support User Admin',
        '5' => 'Support Driver Admin',
    ];
    public function createdBy()
    {
        return $this->hasOne(Auth::class, 'id', 'created_by');
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public static function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0 . " KM";
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            return round($miles * 1.609344, 2);
        }
    }

    public static function notification($token, $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $token = $token;
        // $token = 'fxmjoRhkQwea2oGRI0EXBc:APA91bFzgUy7x-FR6NvbTl_IZ1YneV8FMYzBeZN3QjCY4usYmz-8K21Qn-v3-DDsF1OwjhmLY07jKKsxpVNpYdJZdGh_ZCg5uVrU6XT8pea9ZzAPnW7cQM1UUCxSrDQKEqXu4EkNlPhm';

        $notification = [
            'body' => $message,
            'sound' => true,
        ];

        //$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'to' => $token, //single token
            'notification' => $notification,
            //'data' => $extraNotificationData
        ];
        // dd(env('FIREBASE_NOTIFICATION_KEY'));
        $headers = [
            "Authorization: key=AAAATu-jqzQ:APA91bG56HzPaO7tGxO84bKzaaVrKloKT6xDFNnPVlQa7HLtLV417SmI-mAKTlZ33uJJmKPO0ZdLjuJQcgaZcDf5oC2GUBkgfai5KYc1wzBT1f6whA6IoR1w9txku1IujcIMd-bwLaZZ",
            'Content-Type: application/json',
            "TTL: 600"
        ];

        // dd($headers);
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));

        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        // dd($result);
        return $result;
    }


    public static function freetoride($id)
    {
        $model = RiderStatus::where('rider_id', '=', $id)
            ->where('online_status', '=', 'online')
            ->where('status', '=', 1)
            ->first();
        $st = ($model->trip_status == 'free' ?  "ontrip" : "free");
        $model->trip_status = $st;
        $model->save();
    }
}

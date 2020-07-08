<?php

namespace App;

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
            return ($miles * 1.609344) . "KM";
        }
    }
}

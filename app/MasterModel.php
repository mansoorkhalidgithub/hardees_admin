<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
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
}

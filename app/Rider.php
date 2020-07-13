<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Rider extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'created_by',
        'restaurant_id',
        'dob',
        'device_token',
        'status',
        'eStatus',
        'email',
        'password',
        'api_token',
        'address',
        'phone_number',
        'profile_picture',
        'latitude',
        'longitude',
        'device_type',
        'device_id',
        'device_name',
        'app_version',
        'language_code',
        'cnic',
        'cnic_expire_date',
        'city_id',
        'state_id',
        'last_login_at',
        'country_id',
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
}

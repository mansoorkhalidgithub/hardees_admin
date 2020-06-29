<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends MasterModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_ONLINE = 10;
    const STATUS_OFFLINE = 9;
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'created_by',
        'restaurant_id',
        'dob',
        'device_token',
        'status',
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
        'country_id',
    ];
}

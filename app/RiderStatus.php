<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class RiderStatus extends Model
{
    protected $table = 'rider_status';
    protected $fillable = [
        'rider_id', 'online_status', 'trip_status', 'status'
    ];
}

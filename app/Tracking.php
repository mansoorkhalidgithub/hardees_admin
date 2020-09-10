<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'rider_id', 'order_id', 'current_lat', 'current_lng'
    ];
}

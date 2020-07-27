<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiderDetail extends Model
{
    protected $table = 'rider_detail';
    protected $fillable = [
        'vehicle_number', 'rider_id'
    ];
}

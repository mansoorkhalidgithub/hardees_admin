<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripStatus extends Model
{
    protected $table = 'trip_status';
    protected $fillabel = [
        'name', 'description'
    ];
}

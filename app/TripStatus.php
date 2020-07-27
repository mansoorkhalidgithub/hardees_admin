<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripStatus extends Model
{
    public $timestamps = false;
    protected $table = 'trip_status';
    protected $fillabel = [
        'name', 'description'
    ];
}

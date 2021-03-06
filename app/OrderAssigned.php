<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAssigned extends Model
{
    // public $timestamps = false;
    protected $table = 'order_assigned';

    protected $fillable = [
        'order_id',
        'rider_id',
        'trip_status_id'
    ];

    public function rider()
    {
        return $this->hasOne(User::class, 'id', 'rider_id');
    }

    public function deliveryStatus()
    {
        return $this->hasOne(TripStatus::class, 'id', 'trip_status_id');
    }
}

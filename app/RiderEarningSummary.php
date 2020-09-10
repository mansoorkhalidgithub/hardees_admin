<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiderEarningSummary extends Model
{
    protected $table = 'rider_earning_summary';
    protected $fillable = [
        'rider_id', 'order_id', 'amount', 'status'
    ];
}

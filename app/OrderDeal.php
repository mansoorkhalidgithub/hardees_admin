<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDeal extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['order_id', 'deal_id', 'deal_quantity'];
}

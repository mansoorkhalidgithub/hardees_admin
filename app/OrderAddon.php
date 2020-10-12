<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['order_id', 'addon_id', 'price', 'addon_quantity'];
	
	public function addon()
	{
		return $this->belongsTo(Addon::class, 'addon_id');
	}
}

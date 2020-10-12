<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model {
	
	public $timestamps = false;
	
	protected $table = 'order_status';
	
	protected $fillable = [
		'name',
		'order_type_id',
	];
	
	public function belongtoOrderType() {
		return $this->belongsTo(OrderType::class, 'order_type_id');
	}
	
	public function orderType()
	{
		return $this->belongsTo(OrderType::class, 'order_type_id');
	}
}

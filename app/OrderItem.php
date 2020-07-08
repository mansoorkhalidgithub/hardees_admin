<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'order_id',
		'menu_item_id',
		'item_price',
		'item_quantity',
	];

	public function items()
	{
		return $this->hasOne(MenuItem::class, 'id', 'menu_item_id');
	}
}

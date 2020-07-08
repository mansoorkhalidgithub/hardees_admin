<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	const STATUS_REJECT             = 0;
	const STATUS_ACCEPT             = 1;
	const STATUS_PICKUP             = 2;
	const STATUS_START_DELIVERY     = 3;
	const STATUS_COMPLETE           = 4;
	const STATUS_CASH_COLLECTED     = 5;
	// const STATUS_START_DELIVERY     = 6;
	protected $with = ['orderItems'];

	protected $fillable = [
		'restaurant_id',
		'user_id',
		'delivery_charges',
		'discount',
		'tax',
		'sub_total',
		'total',
		'payment_method_id',
		'latitude',
		'longitude',
		'customer_address',
		'order_type_id',
	];

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class, 'order_id');
	}


	public function restaurant()
	{
		return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
	}

	public function customer()
	{
		return $this->hasOne(User::class, 'id', 'user_id');
	}
}

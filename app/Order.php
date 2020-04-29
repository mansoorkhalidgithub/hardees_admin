<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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

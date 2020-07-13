<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
		$data = $this->hasMany(OrderItem::class, 'order_id');
		// $data->each->append(
		// 	'Name'
		// );
		return $data;
	}
	public function getorderItemsWithNameAttribute()
	{
		$data = OrderItem::where('order_id', $this->id)->get();
		$data->each->append(
			'Name'
		);
		return $data;
	}
	public function ordersAccepted()
	{
		return $this->hasOne(Order_status::class, 'order_id')->where('name', 'Accepted');
	}
	public function orders()
	{
		return $this->hasOne(Order_status::class, 'order_id');
	}
	public function belongToUser()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	public function getOrdertypeAttribute()
	{
		$orderStatus = OrderType::find($this->order_type_id);
		if ($orderStatus) {
			return $orderStatus->type;
		}
	}
	public function getcustomerDataAttribute()
	{
		$user = User::where('id', $this->user_id)->select(['id', 'first_name', 'last_name', 'phone_number'])->first();
		$user->append(
			'orderAddress'
		);
		return $user;
	}
	public function getapproxTimeAttribute()
	{
		return 15;
	}
	public function getmenueItemNameAttribute()
	{
		$orderitems = OrderItem::where('order_id', $this->id)->select('menu_item_id')->first();
		$menueItem = MenuItem::where('id', $orderitems->menu_item_id)->select('name')->first();
		return $menueItem->name;
	}
	public function getriderAsignedAttribute()
	{
		$OrderAssigned = OrderAssigned::where('order_id', $this->id)->first();
		$data = [];
		if ($OrderAssigned) {
			$data = User::where('id', $OrderAssigned->rider_id)->select(['first_name', 'last_name', 'phone_number'])->first();
			$data->append(
				'Rating'
			);
		}
		return $data;
	}
	public function getbookingNoAttribute()
	{

		return $this->id;
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
	protected $fillable = [
		'name',
		'status',
		'created_by',
		'address',
		'email',
		'contact_number',
		'latitude',
		'longitude',
		'min_order_price',
		'expense_type',
		'currency_symbol',
		'currency_name',
		'delivery_charges',
		'delivery_charges_km',
		'payment_method_id',
		'category_id',
		'delivery_time',
		'logo',
		'thumbnail',
		'password',
		'tags',
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function createdBy()
	{
		return $this->hasOne(Auth::class, 'id', 'created_by');
	}
}

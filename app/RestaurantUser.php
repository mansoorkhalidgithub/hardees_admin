<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantUser extends Model
{
    protected $fillable = [
		'username',
		'email',
		'password'
	];
	
	public function restaurant()
	{
		return $this->belongsTo(Restaurant::class, 'restaurant_id');
	}
}

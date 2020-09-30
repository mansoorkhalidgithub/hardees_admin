<?php

namespace App;

use App\MasterModel;

class MenuItem extends MasterModel
{
	public function getIngredientsAttribute($value)
	{
		return implode(', ', unserialize($value));
	}

	public function getWeightAttribute($value)
	{
		return $value . "g";
	}

	public function category()
	{
		return $this->hasOne(MenuCategory::class, 'id', 'menu_category_id');
	}

	public function createdBY()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	public function getItemAvailabilityAttribute()
	{
		$auth_id = app('Illuminate\Contracts\Auth\Guard')->user()->restaurant_id;
		return (RestaurantItems::where('restaurant_id', $auth_id)
			->where('menu_item_id', $this->id)->first()) ? 'Unavaiable' : 'Available';
	}
}

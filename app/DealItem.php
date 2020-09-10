<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealItem extends Model
{
	public $timestamps = false;

	protected $appends = [
		'item_name'
	];

	protected $hidden = [
		'menuItem'
	];

	public function menuItem()
	{
		return $this->belongsTo(MenuItem::class, 'menu_item_id');
	}

	public function getItemNameAttribute()
	{
		return $this->menuItem->name;
	}
}

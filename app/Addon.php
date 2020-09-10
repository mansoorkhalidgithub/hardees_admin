<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
	public $timestamps = false;
	
	protected $fillable = [
		'menu_item_id',
		'name',
		'price',
		'addon_category_id',
		'image',
	];
	
	public function addonTypes()
	{
		return $this->hasMany(AddonType::class, 'addon_id');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVariation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'menu_item_id',
		'variation_id',
		'price',
		'is_drink',
		'is_side',
		'is_extra'
	];

	public function memuItem()
	{
		return $this->belongsTo(MenuItem::class, 'menu_item_id');
	}

	public function variation()
	{
		return $this->belongsTo(Variation::class, 'variation_id');
	}

	public function getDrinksAttribute()
	{
		$menuItem = MenuItem::where('id', $this->menu_item_id)->first();
		$menuCategory = MenuCategory::where('id', $menuItem->menu_category_id)->first();
		
		$drinks = [];

		$is_drink = $this->is_drink;

		if ($is_drink == 1 || $menuCategory->type == 'Deal') {
			$drinks = Drink::all();
		} 

		return $drinks;
	}

	public function getSidesAttribute()
	{
		$sides = [];

		$is_side = $this->is_side;

		if ($is_side == 1) {
			$sides = Side::all();
		}

		return $sides;
	}

	public function getExtrasAttribute()
	{
		$extras = [];

		$is_extra = $this->is_extra;

		if ($is_extra == 1) {
			$extras = Extra::all();
		}

		return $extras;
	}

	public function addon()
	{
		return $this->hasMany(Addon::class, 'menu_item_id', 'menu_item_id');
	}

	public function getVariationNameAttribute()
	{
		return Variation::find($this->variation_id)->name;
	}
}

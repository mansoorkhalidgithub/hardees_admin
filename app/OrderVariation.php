<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVariation extends Model
{
	public $timestamps = false;

	protected $appends = ['addon', 'total', 'deal_drinks'];
	
    protected $fillable = [
		'user_id',
		'order_id',
		'item_id',
		'variation_id',
		'drink_id',
		'side_id',
		'extra_id',
		'quantity',
		'addons',
		'deal_id',
		'deal_quantity',
		'drinks'
	];
	
	
	public function itemVariation()
	{
		return $this->belongsTo(ItemVariation::class, 'variation_id');
	}

	public function drink()
	{
		return $this->belongsTo(Drink::class, 'drink_id');
	}

	public function side()
	{
		return $this->belongsTo(Side::class, 'side_id');
	}

	public function extra()
	{
		return $this->belongsTo(Extra::class, 'extra_id');
	}

	public function getAddonAttribute()
	{
		$total = 0;

		if($this->addons) {
			$addonIds = unserialize($this->addons);
			$addons = Addon::whereIn('id', $addonIds)->get();
			if(count($addons) > 0) {
				foreach($addons as $addon) {
					$total = $total + $addon->price;
				}
			}
		}

		return $total;
	}
	
	public function getTotalAttribute()
	{
		$variationId = $this->variation_id;
		$itemId = $this->item_id;

		$variation = ItemVariation::where('variation_id', $variationId)->where('menu_item_id', $itemId)->first();

		$total = $variation->price;

		if ($this->addons) {
			$addonIds = unserialize($this->addons);
			$addons = Addon::whereIn('id', $addonIds)->get();
			if (count($addons) > 0) {
				foreach ($addons as $addon) {
					$total = $total + $addon->price;
				}
			}
		}

		if ($this->drink_id) {
			$drink = Drink::find($this->drink_id);
			if ($drink->default == 1) {
				$total = $total;
			} else {
				$total = $total + $drink->price;
			}
		}

		if ($this->side_id) {
			$side = Side::find($this->side_id);
			if ($side->default == 1) {
				$total = $total;
			} else {
				$total = $total + $side->price;
			}
		}

		if ($this->extra_id) {
			$extra = Extra::find($this->extra_id);

			$total = $total + $extra->price;
		}

		$total = $total * $this->quantity;

		return $total;
	}
	
	public function getDealDrinksAttribute($value)
	{
		$data = [];
		if ($value) {
			$drinkIds = unserialize($value);
			$data = Drink::whereIn('id', $drinkIds)->pluck('name');
		}
		return $data;
	}
}

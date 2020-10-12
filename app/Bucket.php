<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
	protected $table = "bucket";

	protected $fillable = [
		'user_id',
		'item_id',
		'variation_id',
		'drink_id',
		'side_id',
		'extra_id',
		'quantity',
		'addons',
		'deal_id',
		'deal_drinks'
	];
	public function item()
	{
		return $this->belongsTo(MenuItem::class, 'item_id');	
	}
	public function getTotalAttribute()
	{
		$variationId = $this->variation_id;
		$itemId = $this->item_id ?? $this->deal_id;
		if (!empty($variationId))
			$variation = ItemVariation::where('variation_id', $variationId)->where('menu_item_id', $itemId)->first();
		else
			$variation = DealVariation::where('menu_item_id', $itemId)->first();
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

	public function getAddonAttribute()
	{
		$data = [];
		if ($this->addons) {
			$addonIds = unserialize($this->addons);
			$data = Addon::whereIn('id', $addonIds)->select('name', 'price')->get();
		}
		return $data;
	}

	public function getDealDrinkAttribute()
	{
		$data = [];
		if ($this->deal_drinks) {
			$drinkIds = unserialize($this->deal_drinks);
			$data = Drink::whereIn('id', $drinkIds)->pluck('name');
		}
		return $data;
	}

	public function getItemAttribute()
	{
		if (!empty($this->item_id))
			return MenuItem::find($this->item_id);
		else
			return MenuItem::find($this->deal_id);
	}

	public function getDrinkAttribute(){
		$data = [];
		if(!empty($this->drink_id))
			return Drink::find($this->drink_id);
		else return (object)$data;
	}

	public function getSideAttribute(){
		$data = [];
		if(!empty($this->side_id))
			return Side::find($this->side_id);
		else return (object)$data;
	}

	public function getExtraAttribute(){
		$data = [];
		if(!empty($this->extra_id))
			return Extra::find($this->extra_id);
		else return (object)$data;
	}
}

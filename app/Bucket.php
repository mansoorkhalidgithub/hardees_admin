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
		'deal_quantity'
	];
	
	public function getTotalAttribute()
    {
		$variationId = $this->variation_id;
		$itemId = $this->item_id;
		
		$variation = ItemVariation::where('variation_id', $variationId)->where('menu_item_id', $itemId)->first();
		
		$total = $variation->price;
		
		if($this->addons) {
			$addonIds = unserialize($this->addons);
			$addons = Addon::whereIn('id', $addonIds)->get();
			if(count($addons) > 0) {
				foreach($addons as $addon) {
					$total = $total + $addon->price;
				}
			}
		}
		
		$total = $total * $this->quantity;
		
		if($this->drink_id) {
			$drink = Drink::find($this->drink_id);
			if($drink->default == 1) {
				$total = $total;
			} else {
				$total = $total + $drink->price;
			}
		}
		
		if($this->side_id) {
			$side = Side::find($this->side_id);
			if($side->default == 1) {
				$total = $total;
			} else {
				$total = $total + $side->price;
			}
		}
		
		if($this->extra_id) {
			$extra = Extra::find($this->extra_id);
			
			$total = $total + $extra->price;
		}
		
        return $total;
    }
	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVariation extends Model
{
	public $timestamps = false;

	protected $appends = ['addon'];
	
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
		'deal_quantity'
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
}

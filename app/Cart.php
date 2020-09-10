<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $price;
    // protected $total;
    protected $table = 'cart';
	
    protected $fillable = [
        'item_id', 
		'user_id', 
		'status', 
		'quantity', 
		'deal_id', 
		'deal_quantity',
		'addon_id',
		'addon_quantity',
		'addon_type_id',
    ];
	
	public function item()
	{
		return $this->belongsTo(MenuItem::class, 'item_id');
	}
	
	public function deal()
	{
		return $this->belongsTo(Deal::class, 'deal_id');
	}

    public function getTotalAttribute()
    {
		$total = 0;
		
		if($this->item_id) {
			$item = MenuItem::find($this->item_id);
			$itemTotal = $item->price * $this->quantity;
			$total = $total + $itemTotal;
		}
			
		if($this->deal_id) {
			$deal = Deal::find($this->deal_id);
			$dealTotal = $deal->payable_price * $this->deal_quantity;
			$total = $total + $dealTotal;
		}
		
		if($this->addon_id) {
			$addon = AddonType::where('id', $this->addon_type_id)->where('addon_id', $this->addon_id)->first();
			$totalPrice = $addon->price * $this->addon_quantity;
			$total = $total + $totalPrice;
		}
		
        return $total;
    }
}

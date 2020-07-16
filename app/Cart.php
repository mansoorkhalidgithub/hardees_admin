<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $price;
    // protected $total;
    protected $table = 'cart';
	
    protected $fillable = [
        'item_id', 'user_id', 'status', 'quantity', 'deal_id', 'deal_quantity'
    ];
	
	public function item()
	{
		return $this->belongsTo(MenuItem::class, 'item_id');
	}
	
	public function deal()
	{
		return $this->belongsTo(Deals::class, 'deal_id');
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
		
        return $total;
    }
}

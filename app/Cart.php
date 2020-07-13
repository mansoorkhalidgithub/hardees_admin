<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // protected $price;
    // protected $total;
    protected $table = 'cart';
	
    protected $fillable = [
        'item_id', 'user_id', 'status', 'quantity'
    ];
	
	public function item()
	{
		return $this->belongsTo(MenuItem::class, 'item_id');
	}

    public function getTotalAttribute()
    {
        $item = MenuItem::find($this->item_id);
        return $item->price * $this->quantity;
        // return [
        //     'total_amount' => $item->price * $this->quantity,
        //     'price' => $item->price
        // ];
    }
}

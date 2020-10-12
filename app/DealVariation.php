<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealVariation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'menu_item_id',
        'drinks_quantity',
        'price'
    ];

    public function addon()
    {
        return $this->hasMany(Addon::class, 'menu_item_id', 'menu_item_id')->where('web_status',1);
    }

    public function getDrinksAttribute()
    {
        $drinks = [];

        $quantity = $this->drinks_quantity;
        if(!empty($quantity)){
            for ($i = 1; $i <= $quantity; $i++) {
                $drinks[] = ['Coke','Sprite','Fanta'];
            }
        }
        return $drinks;
    }
}

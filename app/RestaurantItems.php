<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantItems extends Model
{
    public $timestamps = false;
    protected $table = 'restaurant_items';

    protected $fillable = [
        'restaurant_id', 'menu_item_id', 'menu_cat_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantCategories extends Model
{
    public $timestamps = false;
    protected $table = 'restaurant_categories';

    protected $fillable = [
        'restaurant_id',
        'title',
    ];
}

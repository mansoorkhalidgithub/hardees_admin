<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealVariation extends Model
{
	public $timestamps = false; 
	
    protected $fillable = ['menu_item_id', 'items', 'drinks', 'sides', 'extras'];
}

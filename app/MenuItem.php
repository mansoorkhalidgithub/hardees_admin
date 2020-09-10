<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
	public function getIngredientsAttribute($value)
    {
        return unserialize($value);
    }
	
	public function getWeightAttribute($value)
    {
        return $value . "g";
    }
}

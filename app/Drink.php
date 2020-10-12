<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public $timestamps = false;

	public function getPriceAttribute($value)
    {
		if($this->default == 1) 
		{
			$value = "";
		}
        
		return $value;
    }
}

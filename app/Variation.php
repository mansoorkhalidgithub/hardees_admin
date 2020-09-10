<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public $timestamps = false;
	
	// public function sides()
	// {
		// return $this->hasMany(Side::class, 'variation_id');
	// }
	
	// public function extras()
	// {
		// return $this->hasMany(Extra::class, 'variation_id');
	// }
	
	// public function drinks()
	// {
		// return $this->hasMany(Drink::class, 'variation_id');
	// }
}

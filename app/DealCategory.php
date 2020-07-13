<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealCategory extends Model
{
    public $timestamps = false;
	
	public function deals()
	{
		return $this->hasMany(Deal::class, 'deal_category_id');
	}
}

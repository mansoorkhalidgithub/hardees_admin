<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
	protected $with = [
		'dealItems'
	];
	
    public function dealItems()
	{
		return $this->hasMany(DealItem::class, 'deal_id');
	}
}

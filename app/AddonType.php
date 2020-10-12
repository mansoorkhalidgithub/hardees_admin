<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonType extends Model
{
    public $timestamps = false;
	
	public function addon()
	{
		return $this->belongsTo(Addon::class, 'addon_id');
	}
}

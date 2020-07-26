<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
	public $timestamps = false;
	
	public function addonTypes()
	{
		return $this->hasMany(AddonType::class, 'addon_id');
	}
}

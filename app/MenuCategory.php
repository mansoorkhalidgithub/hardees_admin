<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
	protected $fillable = ['name', 'type'];
	
	public $timestamps = false;

	public $table = 'menu_categories';
	
	public function menuItems()
	{
		return $this->hasMany(MenuItem::class, 'menu_category_id');
	}
	
	public function getTypeAttribute($value)
	{
		$type = "Single Item";
		if($value == 'deal')
		{
			$type = "Deal";
		}
		
		return $type;
	}
}

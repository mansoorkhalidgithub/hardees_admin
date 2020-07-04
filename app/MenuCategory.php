<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
	protected $fillable = ['name'];
	
	public $timestamps = false;

	public $table = 'menu_categories';
	
	public function menuItems()
	{
		return $this->hasMany(MenuItem::class, 'menu_category_id');
	}
}

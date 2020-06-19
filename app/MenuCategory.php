<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
	protected $fillable = ['name'];
	public $timestamps = false;

	public $table = 'menu_categories';
}

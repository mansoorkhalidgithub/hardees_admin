<?php

namespace App;

use App\MasterModel;

class MenuItem extends MasterModel {
	public function getIngredientsAttribute($value) {
		return unserialize($value);
	}

	public function getWeightAttribute($value) {
		return $value . "g";
	}

	public function category() {
		return $this->hasOne(MenuCategory::class, 'id', 'menu_category_id');
	}

	public function createdBY() {
		return $this->hasOne(User::class, 'id', 'created_by');
	}
}

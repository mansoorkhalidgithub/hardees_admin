<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    public function createdBy()
    {
        return $this->hasOne(Auth::class, 'id', 'created_by');
    }

    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, 'id', 'restaurant_id');
    }
}

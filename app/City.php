<?php

namespace App;

use App\MasterModel;
use Illuminate\Database\Eloquent\Model;

class City extends MasterModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public $timestamps = false;

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}

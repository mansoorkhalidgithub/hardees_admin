<?php

namespace App;

use App\MasterModel;
use Illuminate\Database\Eloquent\Model;

class State extends MasterModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public $timestamps = false;
}

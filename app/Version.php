<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'android', 'ios', 'type'
    ];
}

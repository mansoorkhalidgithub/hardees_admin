<?php

namespace App;

use App\MasterModel;
// use Illuminate\Database\Eloquent\Model;

class Slider extends MasterModel
{
    protected $fillable = [
        'description',
        'status',
        'created_by',
        'image'
    ];
} 

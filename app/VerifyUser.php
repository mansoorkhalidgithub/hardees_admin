<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $fillable = [
        'user_id', 'user_otp'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewDetail extends Model
{
    protected $table = 'review_detail';
    protected $fillable = [
        'review_id', 'review_img', 'review_type'
    ];
}

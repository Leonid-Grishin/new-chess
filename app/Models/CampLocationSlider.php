<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampLocationSlider extends Model
{
    protected $fillable = [
        'order',
        'image_prev',
        'image_big',
    ];
}

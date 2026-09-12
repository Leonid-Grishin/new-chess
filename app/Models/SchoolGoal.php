<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolGoal extends Model
{
    protected $fillable = [
        'title',
        'description',
        'text',
        'image',
        'image_alt',
    ];
}

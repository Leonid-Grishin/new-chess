<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampScheduleMeal extends Model
{
    protected $fillable = [
        'order',
        'time',
        'title',
        'description',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampPriceInclude extends Model
{
    protected $fillable = [
        'order',
        'description',
        'is_discount',
    ];
}

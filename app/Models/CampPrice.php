<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampPrice extends Model
{
    protected $fillable = [
        'order',
        'title',
        'amount',
        'description',
        'is_discount',
        'second_amount',
        'second_description',
    ];
}

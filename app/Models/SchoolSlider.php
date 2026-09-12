<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSlider extends Model
{
    use HasFactory;

    protected $table = 'school_sliders';

    protected $fillable = [
        'image',
        'image_big',
        'image_alt',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}

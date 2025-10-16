<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampGallerySlider extends Model
{
    protected $table = 'camp_gallery_sliders';
    protected $fillable = [
        'order',
        'image_prev',
        'image_big',
    ];
}

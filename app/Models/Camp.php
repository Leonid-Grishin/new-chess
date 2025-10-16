<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $fillable = [
        'h1',
        'intro_feature_1',
        'intro_feature_2',
        'intro_feature_3',
        'intro_video_big',
        'intro_video_short',
        'intro_video_poster',
        'about_h2',
        'date_1',
        'date_2',
        'date_departure',
        'date_duration',
        'schedule_h2',
        'teachers_h2',
        'teachers_description',
        'location_h2',
        'location_title',
        'location_address',
        'location_description',
        'location_title_2',
        'location_description_2',
        'location_title_3',
        'location_description_3',
        'is_camp_promo',
        'camp_promo_year',
    ];
}

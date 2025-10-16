<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampAboutFeatureItem extends Model
{
    protected $fillable = [
        'camp_about_feature_id',
        'order',
        'title',
    ];
}

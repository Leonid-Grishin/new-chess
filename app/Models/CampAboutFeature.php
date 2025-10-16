<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampAboutFeature extends Model
{
    protected $fillable = [
        'order',
        'title',
        'description',
        'features_image',
    ];

    public function items() {
        return $this->hasMany(CampAboutFeatureItem::class);
    }
}

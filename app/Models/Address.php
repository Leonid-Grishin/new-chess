<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'title',
        'name',
        'address',
        'address_link',
        'phone',
        'phone_link',
        'image_1',
        'image_1_alt',
        'image_2',
        'image_2_alt',
        'sort_order',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(AddressFeature::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}

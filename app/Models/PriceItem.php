<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceItem extends Model
{
    protected $fillable = [
        'price_id',
        'title',
        'sort_order',
    ];

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }
}

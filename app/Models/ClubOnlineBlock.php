<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubOnlineBlock extends Model
{
    protected $table = 'club_online_blocks';

    protected $fillable = [
        'title',
        'image',
        'image_alt',
    ];

    /**
     * Пункты блока онлайн-обучения.
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            ClubOnlineBlockItem::class,
            'club_online_block_id'
        )
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}

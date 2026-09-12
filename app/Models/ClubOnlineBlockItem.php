<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubOnlineBlockItem extends Model
{
    protected $table = 'club_online_block_items';

    protected $fillable = [
        'club_online_block_id',
        'text',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Родительский блок онлайн-обучения.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(
            ClubOnlineBlock::class,
            'club_online_block_id'
        );
    }
}

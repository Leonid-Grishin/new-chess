<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubCampBlockItem extends Model
{
    protected $table = 'club_camp_block_items';

    protected $fillable = [
        'club_camp_block_id',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'club_camp_block_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Родительский блок «Шахматный лагерь».
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(
            ClubCampBlock::class,
            'club_camp_block_id'
        );
    }
}

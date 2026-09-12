<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubCampBlock extends Model
{
    protected $table = 'club_camp_blocks';

    protected $fillable = [
        'title',
        'description',
        'image_1',
        'image_1_alt',
        'image_2',
        'image_2_alt',
    ];

    /**
     * Пункты блока «Шахматный лагерь».
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            ClubCampBlockItem::class,
            'club_camp_block_id'
        )->orderBy('sort_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGroupItem extends Model
{
    protected $table = 'student_group_items';

    protected $fillable = [
        'student_group_id',
        'text',
        'sort_order',
    ];

    protected $casts = [
        'student_group_id' => 'integer',
        'sort_order' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            StudentGroup::class,
            'student_group_id'
        );
    }
}

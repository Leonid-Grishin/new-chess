<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentGroup extends Model
{
    protected $table = 'student_groups';

    protected $fillable = [
        'image',
        'image_alt',
        'title',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(StudentGroupItem::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}

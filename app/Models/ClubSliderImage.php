<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubSliderImage extends Model
{
    protected $fillable = [
        'filename',
        'alt',
        'sort',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Базовый путь к папке слайдера
    const BASE_PATH = 'images/club/slider/';

    /**
     * Полный публичный URL до файла
     */
    public function getUrlAttribute(): string
    {
        return asset(self::BASE_PATH . $this->filename);
    }

    /**
     * Абсолютный путь на диске
     */
    public function getFullPathAttribute(): string
    {
        return public_path(self::BASE_PATH . $this->filename);
    }

    /**
     * Scope: только активные, по сортировке
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort')->orderBy('id');
    }
}

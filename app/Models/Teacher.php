<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'rank',
        'order',
        'tg',
        'camp_image',
        'camp_order',
        'is_camp_teacher'
        ];

    public function achievements() {
        return $this->hasMany(TeacherAchievement::class)->orderBy('order');
    }
}

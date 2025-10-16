<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'teacher_id',
        'title',
        'order',
        'is_camp_achievement',
    ];
}

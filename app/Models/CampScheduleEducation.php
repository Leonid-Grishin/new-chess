<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampScheduleEducation extends Model
{
    protected $table = 'camp_schedule_educations';
    protected $fillable = [
        'order',
        'time',
        'title',
        'description',
    ];
}

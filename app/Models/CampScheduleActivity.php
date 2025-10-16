<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampScheduleActivity extends Model
{
    protected $table = 'camp_schedule_activities';
    protected $fillable = [
        'order',
        'time',
        'title',
        'description',
    ];
}

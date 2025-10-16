<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['photo', 'name', 'email', 'telephone', 'description', 'parent', 'rating_classic', 'rating_rapid', 'rating_blitz', 'rating_classic_change_class', 'birth_date', 'fshr_id', 'rating_rapid_change_class', 'rating_blitz_change_class', 'rating_classic_change', 'rating_rapid_change', 'rating_blitz_change'];

    protected $attributes = [
        'photo' => 'images/students/default-photo.jpg',
        'rating_classic' => 0,
        'rating_rapid' => 0,
        'rating_blitz' => 0,
    ];
}

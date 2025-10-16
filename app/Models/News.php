<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['date', 'title', 'image', 'link'];

    protected $attributes = [
        'image' => 'images/news/default-news.jpg',
    ];
}

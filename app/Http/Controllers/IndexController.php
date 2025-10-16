<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index() {
        $reviews = Review::limit(5)->get();
        $news = News::orderByDesc('date')->limit(3)->get();
        $meta = [
            'title' => 'Шахматный клуб «А5» для детей в Санкт-Петербурге',
            'description' => 'Шахматный клуб «А5» предлагает детям занятия шахматами в классах и онлайн. Мы организовываем турниры, сборы и другие мероприятия в Санкт-Петербурге. Наши ученики часто становятся победителями различных первенств. Телефон клуба +79022027148',
            'og-image' => 'images/pavel-children-og.jpg'
        ];

        return view('index', ['reviews' => $reviews, 'news' => $news, 'meta' => $meta]);
    }
}

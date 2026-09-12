<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Review;
use App\Models\SchoolSlider;

class SchoolController extends Controller
{
    public function school() {
        $reviews = Review::limit(5)->get();
        $meta = [
            'title' => 'Школа шахмат «А5» для детей в Санкт-Петербурге',
            'description' => 'Школа шахмат А5 для детей на севере Санкт-Петербурга занимается подготовкой к соревнованиям по дисциплине шахматы. Наши спортсмены часто становятся победителями и призерами городских и междугородних соревнований. Телефон школы +79022027148',
            'og-image' => 'images/school/chess-school-og.jpg'
        ];

        $promos = Promo::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $schoolSliders = SchoolSlider::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        return view('school', ['reviews' => $reviews, 'meta' => $meta, 'promos' => $promos, 'schoolSliders' => $schoolSliders]);
    }
}

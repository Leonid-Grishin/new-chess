<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\CampAboutFeature;
use App\Models\CampGallerySlider;
use App\Models\CampLocationSlider;
use App\Models\CampPrice;
use App\Models\CampPriceInclude;
use App\Models\CampScheduleActivity;
use App\Models\CampScheduleEducation;
use App\Models\CampScheduleMeal;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function camp() {

        $meta = [
            'title' => 'Шахматный лагерь А5 в Санкт-Петербурге',
            'description' => 'Каждое лето мы проводим выездной шахматный лагерь для детей. Здесь дети интенсивно занимаются, учатся взаимодействию в коллективе и быть самостоятельными. Конечно же присутствует много теории и практики шахмат.',
            'og-image' => 'images/camp/camp-og.jpg'
        ];

        $camp = Camp::first();
        $prices = CampPrice::orderBy('order')->get();
        $priceIncludes = CampPriceInclude::orderBy('order')->get();
        $teachers = Teacher::where('is_camp_teacher', 1)
        ->orderBy('order', 'ASC')
            ->with(['achievements' => function ($query) {
                $query->where('is_camp_achievement', 1);
            }])
            ->get();
        $educations = CampScheduleEducation::all();
        $meals = CampScheduleMeal::all();
        $activities = CampScheduleActivity::all();
        $features = CampAboutFeature::orderBy('order', 'ASC')
        ->with(['items' => function ($query) {
            $query->orderBy('order', 'ASC');
        }])
        ->get();
        $locationSliders = CampLocationSlider::all();
        $firstSlider = CampGallerySlider::where('id', 1)->first();
        $secondSlider = CampGallerySlider::where('id', 2)->first();
        $thirdSlider = CampGallerySlider::where('id', 3)->first();
        $fourthSlider = CampGallerySlider::where('id', 4)->first();
        $fifthSlider = CampGallerySlider::where('id', 5)->first();
        $hiddenSliders = CampGallerySlider::where('id', '>', 5)->orderBy('order')->get();

        return view('camp', [
            'meta' => $meta,
            'camp' => $camp,
            'prices' => $prices,
            'priceIncludes' => $priceIncludes,
            'teachers' => $teachers,
            'educations' => $educations,
            'meals' => $meals,
            'activities' => $activities,
            'features' => $features,
            'locationSliders' => $locationSliders,
            'firstSlider' => $firstSlider,
            'secondSlider' => $secondSlider,
            'thirdSlider' => $thirdSlider,
            'fourthSlider' => $fourthSlider,
            'fifthSlider' => $fifthSlider,
            'hiddenSliders' => $hiddenSliders,
        ]);
    }
}

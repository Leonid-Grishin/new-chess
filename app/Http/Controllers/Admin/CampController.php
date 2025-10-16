<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\CampAboutFeature;
use App\Models\CampAboutFeatureItem;
use App\Models\CampGallerySlider;
use App\Models\CampLocationSlider;
use App\Models\CampPrice;
use App\Models\CampPriceInclude;
use App\Models\CampScheduleActivity;
use App\Models\CampScheduleEducation;
use App\Models\CampScheduleMeal;
use App\Src\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CampController extends Controller
{

    public function index()
    {
        //return view('admin.camp');
    }
    public function edit()
    {
        $camp = Camp::first();
        $prices = CampPrice::orderBy('order')->get();
        $priceIncludes = CampPriceInclude::orderBy('order')->get();
        $educations = CampScheduleEducation::all();
        $meals = CampScheduleMeal::all();
        $activities = CampScheduleActivity::all();
        $features = CampAboutFeature::orderBy('order', 'ASC')
            ->with('items')
            ->get();

       return view('admin.camp', [
           'camp' => $camp,
           'prices' => $prices,
           'priceIncludes' => $priceIncludes,
           'educations' => $educations,
           'meals' => $meals,
           'activities' => $activities,
           'features' => $features,
           ]);
    }

    public function update(Request $request)
    {

        $camp = Camp::first();

//Карточки с ценами
        $currentCampPriceCards = CampPrice::all();

        $newCampPriceCards = array_filter($request->campPrices, function($campPrice){
            return !isset($campPrice['id']);
        });

        $idsCampPriceCards = array_map(function ($campPrice){
            return $campPrice['id'];
        }, array_filter($request->campPrices, function($campPrice){
            return isset($campPrice['id']);
        }));

        $removedCampPriceCards = $currentCampPriceCards->filter(function($campPrice) use($idsCampPriceCards) {
            return !in_array($campPrice->id, $idsCampPriceCards);
        });

        $remainCampPrice = $currentCampPriceCards->filter(function($campPrice) use($idsCampPriceCards) {
            return in_array($campPrice->id, $idsCampPriceCards);
        });

        $remainIds = $remainCampPrice->map(function ($campPrice) {
            return $campPrice->id;
        } )->toArray();

        $remainCampPriceCards = array_filter($request->campPrices, function ($campPrice) use($remainIds) {
            return in_array($campPrice['id'], $remainIds);
        });

        $remainCampPrice = $remainCampPrice->mapWithKeys(function ($campPrice, $key) {
            return [$campPrice->id => $campPrice];
        });

        if(count($removedCampPriceCards)) {
            foreach ($removedCampPriceCards as $campPrice) {
                CampPrice::destroy($campPrice->id);
            }
        }

        if(count($newCampPriceCards)) {
            foreach ($newCampPriceCards as $newCampPriceCard) {
                CampPrice::create($newCampPriceCard);
            }
        }

        if(count($remainCampPriceCards)) {
            foreach ($remainCampPriceCards as $campPrice) {
                if(isset($campPrice['is_discount'])) {
                    $campPrice['is_discount'] = 1;
                } else {
                    $campPrice['is_discount'] = 0;
                }
                $remainCampPrice[$campPrice['id']]->update($campPrice);
            }
        }

        //Что включено
        $currentCampPriceIncludes = CampPriceInclude::all();

        $newCampPriceIncludes = array_filter($request->campPriceIncludes, function($campPriceInclude){
            return !isset($campPriceInclude['id']);
        });

        $idsCampPriceIncludes = array_map(function ($campPriceInclude){
            return $campPriceInclude['id'];
        }, array_filter($request->campPriceIncludes, function($campPriceInclude){
            return isset($campPriceInclude['id']);
        }));

        $removedCampPriceIncludes = $currentCampPriceIncludes->filter(function($campPriceInclude) use($idsCampPriceIncludes) {
            return !in_array($campPriceInclude->id, $idsCampPriceIncludes);
        });

        $remainIncludes = $currentCampPriceIncludes->filter(function($campPriceInclude) use($idsCampPriceIncludes) {
            return in_array($campPriceInclude->id, $idsCampPriceIncludes);
        });

        $remainIdsIncludes = $remainIncludes->map(function ($campPriceInclude) {
            return $campPriceInclude->id;
        } )->toArray();

        $remainCampPriceIncludes = array_filter($request->campPriceIncludes, function ($campPriceInclude) use($remainIdsIncludes) {
            return in_array($campPriceInclude['id'], $remainIdsIncludes);
        });

        $remainIncludes = $remainIncludes->mapWithKeys(function ($campPriceInclude, $key) {
            return [$campPriceInclude->id => $campPriceInclude];
        });

        if(count($removedCampPriceIncludes)) {
            foreach ($removedCampPriceIncludes as $campPriceInclude) {
                CampPriceInclude::destroy($campPriceInclude->id);
            }
        }

        if(count($newCampPriceIncludes)) {
            foreach ($newCampPriceIncludes as $newCampPriceInclude) {
                CampPriceInclude::create($newCampPriceInclude);
            }
        }

        if(count($remainCampPriceIncludes)) {
            foreach ($remainCampPriceIncludes as $campPriceInclude) {
                if(isset($campPriceInclude['is_discount'])) {
                    $campPriceInclude['is_discount'] = 1;
                } else {
                    $campPriceInclude['is_discount'] = 0;
                }
                $remainIncludes[$campPriceInclude['id']]->update($campPriceInclude);
            }
        }

        //Расписание - Обучение
        $currentCampEducations = CampScheduleEducation::all();

        $newCampEducations = array_filter($request->campEducations, function($campEducation){
            return !isset($campEducation['id']);
        });

        $idsCampEducations = array_map(function ($campEducation){
            return $campEducation['id'];
        }, array_filter($request->campEducations, function($campEducation){
            return isset($campEducation['id']);
        }));

        $removedCampEducations = $currentCampEducations->filter(function($campEducation) use($idsCampEducations) {
            return !in_array($campEducation->id, $idsCampEducations);
        });

        $remainEducations = $currentCampEducations->filter(function($campEducation) use($idsCampEducations) {
            return in_array($campEducation->id, $idsCampEducations);
        });

        $remainIdsEducations = $remainEducations->map(function ($campEducation) {
            return $campEducation->id;
        } )->toArray();

        $remainCampEducations = array_filter($request->campEducations, function ($campEducation) use($remainIdsEducations) {
            return in_array($campEducation['id'], $remainIdsEducations);
        });

        $remainEducations = $remainEducations->mapWithKeys(function ($campEducation, $key) {
            return [$campEducation->id => $campEducation];
        });

        if(count($removedCampEducations)) {
            foreach ($removedCampEducations as $removedCampEducation) {
                CampScheduleEducation::destroy($removedCampEducation->id);
            }
        }

        if(count($newCampEducations)) {
            foreach ($newCampEducations as $newCampEducation) {
                CampScheduleEducation::create($newCampEducation);
            }
        }

        if(count($remainCampEducations)) {
            foreach ($remainCampEducations as $campEducation) {
                $remainEducations[$campEducation['id']]->update($campEducation);
            }
        }

        //Расписание - Еда
        $currentCampMeals = CampScheduleMeal::all();

        $newCampMeals = array_filter($request->campMeals, function($campMeal){
            return !isset($campMeal['id']);
        });

        $idsCampMeals = array_map(function ($campMeal){
            return $campMeal['id'];
        }, array_filter($request->campMeals, function($campMeal){
            return isset($campMeal['id']);
        }));

        $removedCampMeals = $currentCampMeals->filter(function($campMeal) use($idsCampMeals) {
            return !in_array($campMeal->id, $idsCampMeals);
        });

        $remainMeals = $currentCampMeals->filter(function($campMeal) use($idsCampMeals) {
            return in_array($campMeal->id, $idsCampMeals);
        });

        $remainIdsMeals = $remainMeals->map(function ($campMeal) {
            return $campMeal->id;
        } )->toArray();

        $remainCampMeals = array_filter($request->campMeals, function ($campMeal) use($remainIdsMeals) {
            return in_array($campMeal['id'], $remainIdsMeals);
        });

        $remainMeals = $remainMeals->mapWithKeys(function ($campMeal, $key) {
            return [$campMeal->id => $campMeal];
        });

        if(count($removedCampMeals)) {
            foreach ($removedCampMeals as $removedCampMeal) {
                CampScheduleMeal::destroy($removedCampMeal->id);
            }
        }

        if(count($newCampMeals)) {
            foreach ($newCampMeals as $newCampMeal) {
                CampScheduleMeal::create($newCampMeal);
            }
        }

        if(count($remainCampMeals)) {
            foreach ($remainCampMeals as $remainCampMeal) {
                $remainMeals[$remainCampMeal['id']]->update($remainCampMeal);
            }
        }

        //Расписание - Активности
        $currentCampActivities = CampScheduleActivity::all();

        $newCampActivities = array_filter($request->campActivities, function($campActivity){
            return !isset($campActivity['id']);
        });

        $idsCampActivities = array_map(function ($campActivity){
            return $campActivity['id'];
        }, array_filter($request->campActivities, function($campActivity){
            return isset($campActivity['id']);
        }));

        $removedCampActivities = $currentCampActivities->filter(function($campActivity) use($idsCampActivities) {
            return !in_array($campActivity->id, $idsCampActivities);
        });

        $remainActivities = $currentCampActivities->filter(function($campActivity) use($idsCampActivities) {
            return in_array($campActivity->id, $idsCampActivities);
        });

        $remainIdsActivities = $remainActivities->map(function ($campActivity) {
            return $campActivity->id;
        } )->toArray();

        $remainCampActivities = array_filter($request->campActivities, function ($campActivity) use($remainIdsActivities) {
            return in_array($campActivity['id'], $remainIdsActivities);
        });

        $remainActivities = $remainActivities->mapWithKeys(function ($campActivity, $key) {
            return [$campActivity->id => $campActivity];
        });

        if(count($removedCampActivities)) {
            foreach ($removedCampActivities as $removedCampActivity) {
                CampScheduleActivity::destroy($removedCampActivity->id);
            }
        }

        if(count($newCampActivities)) {
            foreach ($newCampActivities as $newCampActivity) {
                CampScheduleActivity::create($newCampActivity);
            }
        }

        if(count($remainCampActivities)) {
            foreach ($remainCampActivities as $remainCampActivity) {
                $remainActivities[$remainCampActivity['id']]->update($remainCampActivity);
            }
        }

        //Блоки о Лагере
        $currentCampFeatures = CampAboutFeature::all();

        $newCampFeatures = array_filter($request->campFeatures, function($campFeature){
            return !isset($campFeature['id']);
        });

        $idsCampFeatures = array_map(function ($campFeature){
            return $campFeature['id'];
        }, array_filter($request->campFeatures, function($campFeature){
            return isset($campFeature['id']);
        }));

        $removedCampFeatures = $currentCampFeatures->filter(function($campFeature) use($idsCampFeatures) {
            return !in_array($campFeature->id, $idsCampFeatures);
        });

        $remainFeature = $currentCampFeatures->filter(function($campFeature) use($idsCampFeatures) {
            return in_array($campFeature->id, $idsCampFeatures);
        });

        $remainIdsFeatures = $remainFeature->map(function ($campFeature) {
            return $campFeature->id;
        } )->toArray();

        $remainCampFeatures = array_filter($request->campFeatures, function ($campFeature) use($remainIdsFeatures) {
            return in_array($campFeature['id'], $remainIdsFeatures);
        });

        $remainFeature = $remainFeature->mapWithKeys(function ($campFeature, $key) {
            return [$campFeature->id => $campFeature];
        });

        if(count($removedCampFeatures)) {
            foreach ($removedCampFeatures as $removedCampFeature) {
                if(File::exists($removedCampFeature->features_image)) {
                    $fileJpg = $removedCampFeature->features_image;
                    $fileName = basename($removedCampFeature->features_image, '.jpg');
                    $fileWebp = 'images/camp/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }
                CampAboutFeature::destroy($removedCampFeature->id);
            }
        }

        if(count($newCampFeatures)) {
            foreach ($newCampFeatures as $newCampFeature) {
                if(array_key_exists('features_image', $newCampFeature)){
                    $image = $newCampFeature['features_image']->store('images/camp');
                    $dir = pathinfo($image, PATHINFO_DIRNAME);
                    $name = pathinfo($image, PATHINFO_FILENAME);
                    $filePath = "{$dir}/{$name}.jpg";
                    Functions::createWebp($filePath);
                    $newCampFeature['features_image'] = $filePath;
                    CampAboutFeature::create($newCampFeature);
                } else {
                    CampAboutFeature::create($newCampFeature);
                }
            }
        }

        if(count($remainCampFeatures)) {
            foreach ($remainCampFeatures as $remainCampFeature) {
            if(array_key_exists('features_image', $remainCampFeature)){

                $image = $remainCampFeature['features_image']->store('images/camp');
                $dir = pathinfo($image, PATHINFO_DIRNAME);
                $name = pathinfo($image, PATHINFO_FILENAME);
                $filePath = "{$dir}/{$name}.jpg";
                Functions::createWebp($filePath);
                $remainCampFeature['features_image'] = $filePath;
                $remainFeature[$remainCampFeature['id']]->update($remainCampFeature);

            } else {
                $remainFeature[$remainCampFeature['id']]->update($remainCampFeature);
            }

                $currentFeatureItems = CampAboutFeatureItem::where('camp_about_feature_id', $remainCampFeature['id'])->get();

                if(isset($remainCampFeature['items'])) {
                    $newFeatureItems = array_filter($remainCampFeature['items'], function($item) {
                        return !isset($item['id']);
                    });

                    if(count($newFeatureItems)) {
                        foreach ($newFeatureItems as $newFeatureItem) {
                            $remainFeature[$remainCampFeature['id']]->items()->create($newFeatureItem);
                        }
                    }

                    $idsItems = array_map(function ($item) {
                        return $item['id'];
                    }, array_filter($remainCampFeature['items'], function($item) {
                        return isset($item['id']);
                    }));

                    $removedItems = $currentFeatureItems->filter(function($item) use($idsItems) {
                        return !in_array($item->id, $idsItems);
                    });

                    $remainItems = $currentFeatureItems->filter(function($item) use($idsItems) {
                        return in_array($item->id, $idsItems);
                    });

                    $remainItemsIds = $remainItems->map(function ($item) {
                        return $item->id;
                    })->toArray();

                    $remainRequestItems = array_filter($remainCampFeature['items'], function($item) use($remainItemsIds) {
                        if(isset($item['id'])) {
                            return in_array($item['id'], $remainItemsIds);
                        }
                        return false;
                    });

                    $remainItems = $remainItems->mapWithKeys(function($item, $key) {
                        return [$item->id => $item];
                    });

                    if(count($remainRequestItems)) {
                        foreach ($remainRequestItems as $remainRequestItem) {
                            $remainItems[$remainRequestItem['id']]->update($remainRequestItem);
                        }
                    }

                    if(count($removedItems)) {
                        foreach ($removedItems as $removedItem) {
                            $removedItem->delete();
                        }
                    }

                }
                else {
                    if(count($currentFeatureItems)) {
                        foreach ($currentFeatureItems as $currentFeatureItem) {
                            $currentFeatureItem->delete();
                        }
                    }
                }

            }
        }

        $data = $request->all();

        //Видеоблок в шапке

        if(isset($data['intro_video_poster'])){
            if(isset($camp->intro_video_poster) and File::exists($camp->intro_video_poster)) {
                File::delete($camp->intro_video_poster);
            };
            $image = $data['intro_video_poster']->store('images/camp');
            $dir = pathinfo($image, PATHINFO_DIRNAME);
            $name = pathinfo($image, PATHINFO_FILENAME);
            $filePath = "{$dir}/{$name}.jpg";
            $data['intro_video_poster'] = $filePath;
        }

        if(isset($data['intro_video_short'])){
            if(isset($camp->intro_video_short) and File::exists($camp->intro_video_short)) {
                File::delete($camp->intro_video_short);
            };
            $shortVideo = $data['intro_video_short']->store('images/camp');
            $dir = pathinfo($shortVideo, PATHINFO_DIRNAME);
            $name = pathinfo($shortVideo, PATHINFO_FILENAME);
            $filePath = "{$dir}/{$name}.mp4";
            $data['intro_video_short'] = $filePath;
        }

        if(isset($data['intro_video_big'])){
            if(isset($camp->intro_video_big) and File::exists($camp->intro_video_big)) {
                File::delete($camp->intro_video_big);
            };
            $shortVideo = $data['intro_video_big']->store('images/camp');
            $dir = pathinfo($shortVideo, PATHINFO_DIRNAME);
            $name = pathinfo($shortVideo, PATHINFO_FILENAME);
            $filePath = "{$dir}/{$name}.mp4";
            $data['intro_video_big'] = $filePath;
        }

        if(isset($data['is_camp_promo'])) {
            $data['is_camp_promo'] = 1;
        } else {
            $data['is_camp_promo'] = 0;
        }

        $camp->update($data);

        return redirect()->route('admin.camp.edit');
    }

    public function locationSliderEdit()
    {
        $sliders = CampLocationSlider::orderBy('order', 'ASC')->get();
        return view('admin.camp-location-slider', ['sliders' => $sliders]);
    }

    public function locationSliderEditUpdate(Request $request)
    {
        $currentLocationSliders = CampLocationSlider::all();

        $newLocationSliders = array_filter($request->slider, function($slider){
            return !isset($slider['id']);
        });

        $idsLocationSliders = array_map(function ($slider){
            return $slider['id'];
        }, array_filter($request->slider, function($slider){
            return isset($slider['id']);
        }));

        $removedLocationSliders = $currentLocationSliders->filter(function($slider) use($idsLocationSliders) {
            return !in_array($slider->id, $idsLocationSliders);
        });

        $remainLocSliders = $currentLocationSliders->filter(function($slider) use($idsLocationSliders) {
            return in_array($slider->id, $idsLocationSliders);
        });

        $remainIds = $remainLocSliders->map(function ($slider) {
            return $slider->id;
        } )->toArray();

        $remainLocationSliders = array_filter($request->slider, function ($slider) use($remainIds) {
            return in_array($slider['id'], $remainIds);
        });

        $remainLocSliders = $remainLocSliders->mapWithKeys(function ($slider, $key) {
            return [$slider->id => $slider];
        });

        if(count($removedLocationSliders)) {
            foreach ($removedLocationSliders as $removedLocationSlider) {
                if(File::exists($removedLocationSlider->image_prev)) {
                    $fileJpg = $removedLocationSlider->image_prev;
                    $fileName = basename($removedLocationSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/location/'.$fileName.'.webp';
                    File::delete($fileJpg);

                    //dd($fileWebp);
                    if(File::exists($fileWebp)) {
                        //dd($fileWebp);
                        File::delete($fileWebp);
                    }
                }
                CampLocationSlider::destroy($removedLocationSlider->id);
            }
        }

        if(count($newLocationSliders)) {
            foreach ($newLocationSliders as $newLocationSlider) {
                if(array_key_exists('image_prev', $newLocationSlider)){
                    $image = $newLocationSlider['image_prev']->store('images/camp/location');
                    $dir = pathinfo($image, PATHINFO_DIRNAME);
                    $name = pathinfo($image, PATHINFO_FILENAME);
                    $filePath = "{$dir}/{$name}.jpg";
                    Functions::createWebp($filePath);
                    $newLocationSlider['image_prev'] = $filePath;
                    CampLocationSlider::create($newLocationSlider);
                } else {
                    CampLocationSlider::create($newLocationSlider);
                }
            }
        }

        if(count($remainLocationSliders)) {
            foreach ($remainLocationSliders as $slider) {
                if (array_key_exists('image_prev', $slider)) {
                    $image = $slider['image_prev']->store('images/camp/location');
                    $dir = pathinfo($image, PATHINFO_DIRNAME);
                    $name = pathinfo($image, PATHINFO_FILENAME);
                    $filePath = "{$dir}/{$name}.jpg";
                    Functions::createWebp($filePath);
                    $slider['image_prev'] = $filePath;
                    $remainLocSliders[$slider['id']]->update($slider);
                } else {
                    $remainLocSliders[$slider['id']]->update($slider);
                }
            }
        }

        return redirect()->route('admin.campLocationSlider');
    }

    public function gallerySlider()
    {
        $firstSlider = CampGallerySlider::where('id', 1)->first();
        $secondSlider = CampGallerySlider::where('id', 2)->first();
        $thirdSlider = CampGallerySlider::where('id', 3)->first();
        $fourthSlider = CampGallerySlider::where('id', 4)->first();
        $fifthSlider = CampGallerySlider::where('id', 5)->first();
        $hiddenSliders = CampGallerySlider::where('id', '>', 5)->orderBy('order')->get();

        return view('admin.camp-gallery-slider', [
            'firstSlider' => $firstSlider,
            'secondSlider' => $secondSlider,
            'thirdSlider' => $thirdSlider,
            'fourthSlider' => $fourthSlider,
            'fifthSlider' => $fifthSlider,
            'hiddenSliders' => $hiddenSliders,
            ]);
    }

    public function gallerySliderUpdate(Request $request)
    {
        $firstSlider = CampGallerySlider::where('id', 1)->first();
        $secondSlider = CampGallerySlider::where('id', 2)->first();
        $thirdSlider = CampGallerySlider::where('id', 3)->first();
        $fourthSlider = CampGallerySlider::where('id', 4)->first();
        $fifthSlider = CampGallerySlider::where('id', 5)->first();


        if(array_key_exists('firstSlider', $_FILES)){
            if(isset($request->firstSlider['image_prev'])){

                if(File::exists($firstSlider->image_prev)) {
                    $fileJpg = $firstSlider->image_prev;
                    $fileName = basename($firstSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imagePrev = $request->firstSlider['image_prev']->store('images/camp/gallery');
                $dirPrev = pathinfo($imagePrev, PATHINFO_DIRNAME);
                $namePrev = pathinfo($imagePrev, PATHINFO_FILENAME);
                $filePathPrev = "{$dirPrev}/{$namePrev}.jpg";
                Functions::createWebp($filePathPrev);
                $firstSlider->image_prev = $filePathPrev;
            }

            if(isset($request->firstSlider['image_big'])){

                if(File::exists($firstSlider->image_big)) {
                    $fileJpg = $firstSlider->image_big;
                    $fileName = basename($firstSlider->image_big, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imageBig = $request->firstSlider['image_big']->store('images/camp/gallery');
                $dirBig = pathinfo($imageBig, PATHINFO_DIRNAME);
                $nameBig = pathinfo($imageBig, PATHINFO_FILENAME);
                $filePathBig = "{$dirBig}/{$nameBig}.jpg";
                Functions::createWebp($filePathBig);
                $firstSlider->image_big = $filePathBig;
            }

            $firstSlider->update();
        }
        if(array_key_exists('secondSlider', $_FILES)){
            if(isset($request->secondSlider['image_prev'])){

                if(File::exists($secondSlider->image_prev)) {
                    $fileJpg = $secondSlider->image_prev;
                    $fileName = basename($secondSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imagePrev = $request->secondSlider['image_prev']->store('images/camp/gallery');
                $dirPrev = pathinfo($imagePrev, PATHINFO_DIRNAME);
                $namePrev = pathinfo($imagePrev, PATHINFO_FILENAME);
                $filePathPrev = "{$dirPrev}/{$namePrev}.jpg";
                Functions::createWebp($filePathPrev);
                $secondSlider->image_prev = $filePathPrev;
            }

            if(isset($request->secondSlider['image_big'])){

                if(File::exists($secondSlider->image_big)) {
                    $fileJpg = $secondSlider->image_big;
                    $fileName = basename($secondSlider->image_big, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imageBig = $request->secondSlider['image_big']->store('images/camp/gallery');
                $dirBig = pathinfo($imageBig, PATHINFO_DIRNAME);
                $nameBig = pathinfo($imageBig, PATHINFO_FILENAME);
                $filePathBig = "{$dirBig}/{$nameBig}.jpg";
                Functions::createWebp($filePathBig);
                $secondSlider->image_big = $filePathBig;
            }

            $secondSlider->update();
        }
        if(array_key_exists('thirdSlider', $_FILES)){
            if(isset($request->thirdSlider['image_prev'])){

                if(File::exists($thirdSlider->image_prev)) {
                    $fileJpg = $thirdSlider->image_prev;
                    $fileName = basename($thirdSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imagePrev = $request->thirdSlider['image_prev']->store('images/camp/gallery');
                $dirPrev = pathinfo($imagePrev, PATHINFO_DIRNAME);
                $namePrev = pathinfo($imagePrev, PATHINFO_FILENAME);
                $filePathPrev = "{$dirPrev}/{$namePrev}.jpg";
                Functions::createWebp($filePathPrev);
                $thirdSlider->image_prev = $filePathPrev;
            }

            if(isset($request->thirdSlider['image_big'])){

                if(File::exists($thirdSlider->image_big)) {
                    $fileJpg = $thirdSlider->image_big;
                    $fileName = basename($thirdSlider->image_big, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imageBig = $request->thirdSlider['image_big']->store('images/camp/gallery');
                $dirBig = pathinfo($imageBig, PATHINFO_DIRNAME);
                $nameBig = pathinfo($imageBig, PATHINFO_FILENAME);
                $filePathBig = "{$dirBig}/{$nameBig}.jpg";
                Functions::createWebp($filePathBig);
                $thirdSlider->image_big = $filePathBig;
            }

            $thirdSlider->update();
        }
        if(array_key_exists('fourthSlider', $_FILES)){
            if(isset($request->fourthSlider['image_prev'])){

                if(File::exists($fourthSlider->image_prev)) {
                    $fileJpg = $fourthSlider->image_prev;
                    $fileName = basename($fourthSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imagePrev = $request->fourthSlider['image_prev']->store('images/camp/gallery');
                $dirPrev = pathinfo($imagePrev, PATHINFO_DIRNAME);
                $namePrev = pathinfo($imagePrev, PATHINFO_FILENAME);
                $filePathPrev = "{$dirPrev}/{$namePrev}.jpg";
                Functions::createWebp($filePathPrev);
                $fourthSlider->image_prev = $filePathPrev;
            }

            if(isset($request->fourthSlider['image_big'])){

                if(File::exists($fourthSlider->image_big)) {
                    $fileJpg = $fourthSlider->image_big;
                    $fileName = basename($fourthSlider->image_big, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imageBig = $request->fourthSlider['image_big']->store('images/camp/gallery');
                $dirBig = pathinfo($imageBig, PATHINFO_DIRNAME);
                $nameBig = pathinfo($imageBig, PATHINFO_FILENAME);
                $filePathBig = "{$dirBig}/{$nameBig}.jpg";
                Functions::createWebp($filePathBig);
                $fourthSlider->image_big = $filePathBig;
            }

            $fourthSlider->update();
        }
        if(array_key_exists('fifthSlider', $_FILES)){
            if(isset($request->fifthSlider['image_prev'])){

                if(File::exists($fifthSlider->image_prev)) {
                    $fileJpg = $fifthSlider->image_prev;
                    $fileName = basename($fifthSlider->image_prev, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imagePrev = $request->fifthSlider['image_prev']->store('images/camp/gallery');
                $dirPrev = pathinfo($imagePrev, PATHINFO_DIRNAME);
                $namePrev = pathinfo($imagePrev, PATHINFO_FILENAME);
                $filePathPrev = "{$dirPrev}/{$namePrev}.jpg";
                Functions::createWebp($filePathPrev);
                $fifthSlider->image_prev = $filePathPrev;
            }

            if(isset($request->fifthSlider['image_big'])){

                if(File::exists($fifthSlider->image_big)) {
                    $fileJpg = $fifthSlider->image_big;
                    $fileName = basename($fifthSlider->image_big, '.jpg');
                    $fileWebp = 'images/camp/gallery/'.$fileName.'.webp';
                    File::delete($fileJpg);
                    if(File::exists($fileWebp)) {
                        File::delete($fileWebp);
                    }
                }

                $imageBig = $request->fifthSlider['image_big']->store('images/camp/gallery');
                $dirBig = pathinfo($imageBig, PATHINFO_DIRNAME);
                $nameBig = pathinfo($imageBig, PATHINFO_FILENAME);
                $filePathBig = "{$dirBig}/{$nameBig}.jpg";
                Functions::createWebp($filePathBig);
                $fifthSlider->image_big = $filePathBig;
            }

            $fifthSlider->update();
        }



        if(isset($request->hiddenSliders) and count($request->hiddenSliders) > 0) {
            $currentHiddenSliders = CampGallerySlider::where('id', '>', 5)->get();

            $newHiddenSliders = array_filter($request->hiddenSliders, function($slider){
                return !isset($slider['id']);
            });

            $idsHiddenSliders = array_map(function ($slider){
                return $slider['id'];
            }, array_filter($request->hiddenSliders, function($slider){
                return isset($slider['id']);
            }));

            $removedHiddenSliders = $currentHiddenSliders->filter(function($slider) use($idsHiddenSliders) {
                return !in_array($slider->id, $idsHiddenSliders);
            });

            $remainHidSliders = $currentHiddenSliders->filter(function($slider) use($idsHiddenSliders) {
                return in_array($slider->id, $idsHiddenSliders);
            });

            $remainIdsHidSliders = $remainHidSliders->map(function ($slider) {
                return $slider->id;
            } )->toArray();

            $remainHiddenSliders = array_filter($request->hiddenSliders, function ($slider) use($remainIdsHidSliders) {
                return in_array($slider['id'], $remainIdsHidSliders);
            });

            $remainHidSliders = $remainHidSliders->mapWithKeys(function ($slider, $key) {
                return [$slider->id => $slider];
            });

            if(count($removedHiddenSliders)) {
                foreach ($removedHiddenSliders as $removedHiddenSlider) {
                    if(File::exists($removedHiddenSlider->image_big)) {
                        $fileHiddenSlider = $removedHiddenSlider->image_big;
                        File::delete($fileHiddenSlider);
                    }
                    CampGallerySlider::destroy($removedHiddenSlider->id);
                }
            }

            if(count($newHiddenSliders)) {
                foreach ($newHiddenSliders as $newHiddenSlider) {
                    if(array_key_exists('image_big', $newHiddenSlider)){
                        $imageHiddenSlider = $newHiddenSlider['image_big']->store('images/camp/gallery');
                        $dirHiddenSlider = pathinfo($imageHiddenSlider, PATHINFO_DIRNAME);
                        $nameHiddenSlider = pathinfo($imageHiddenSlider, PATHINFO_FILENAME);
                        $filePathHiddenSlider = "{$dirHiddenSlider}/{$nameHiddenSlider}.jpg";
                        $newHiddenSlider['image_big'] = $filePathHiddenSlider;
                        CampGallerySlider::create($newHiddenSlider);
                    } else {
                        CampGallerySlider::create($newHiddenSlider);
                    }
                }
            }

            if(count($remainHiddenSliders)) {
                foreach ($remainHiddenSliders as $slider) {
                    if (array_key_exists('image_big', $slider)) {
                        $image = $slider['image_big']->store('images/camp/gallery');
                        $dir = pathinfo($image, PATHINFO_DIRNAME);
                        $name = pathinfo($image, PATHINFO_FILENAME);
                        $filePath = "{$dir}/{$name}.jpg";
                        $slider['image_big'] = $filePath;
                        $remainHidSliders[$slider['id']]->update($slider);
                    } else {
                        $remainHidSliders[$slider['id']]->update($slider);
                    }
                }
            }
        }



        return redirect()->route('admin.campGallerySlider');
    }


}

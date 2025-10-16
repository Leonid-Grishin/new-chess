@extends('layouts.admin')
@section('title', 'Админка - Лагерь')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <p><span class="text-info">Синим цветом</span> примеры как нужно написать или важные пометки</p>
            <p class="text-danger">Лучше менять и добавлять эллементы поочередно. Что-то поменял, сохранил, добавил чуть чуть и снова сохранил. Чтобы не получилось так что час добавлял а потом сброислось и заново нужно работать</p>
            <div class="mb-2">
                <h1 class="h1 text-center">Страница "Лагерь"</h1>
            </div>
        </div><!-- /.container-fluid -->



        <form enctype="multipart/form-data" method="post" action="{{ route('admin.camp.update') }}">
            @csrf

            <div class="card-body">

                <div class="form-group mt-5 mb-5" >
                    <label class="camp__promo_label d-flex " style="height: 100%">
                        <input type="checkbox" class="form-control camp__is_camp_promo__input" name="is_camp_promo" @if($camp->is_camp_promo) checked @endif value="1" style="width: 100px">
                        <span>Сделать анонс на следующий год? <br> <span class="text-info">Галочка - да / Появится звездочка с годом</span></span>
                    </label>
                </div>

                <div class="form-group mb-5">
                    <label class="d-flex flex-nowrap">
                        <input type="text" class="w-auto form-control" name="camp_promo_year" placeholder="2026" value="{{ $camp->camp_promo_year }}">
                        <span class="ml-3">Год в блоке промо -<span class="text-info ml-2">Обновление на 2026 год Скоро</span></span>
                    </label>

                </div>

                <div class="form-group">
                    <label for="inputH1">Год в заголовке "Шахматный лагерь <span class="text-info">2024</span>"</label>
                    <input type="text" class="form-control @error('h1') is-invalid @enderror" id="inputH1" name="h1" placeholder="Год" value="{{ $camp->h1 }}">
                    @error('h1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <div class="form-group">
                        <label for="introFeature1">1-ая карточка в блоке интро</label>
                        <input type="text" class="w-auto form-control @error('intro_feature_1') is-invalid @enderror" id="introFeature1" name="intro_feature_1" placeholder="Карточка 1" value="{{ $camp->intro_feature_1 }}">
                        @error('intro_feature_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="introFeature2">2-ая карточка в блоке интро</label>
                        <input type="text" class="w-auto form-control @error('intro_feature_2') is-invalid @enderror" id="introFeature2" name="intro_feature_2" placeholder="Карточка 2" value="{{ $camp->intro_feature_2 }}">
                        @error('intro_feature_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="introFeature3">3-ая карточка в блоке интро</label>
                        <input type="text" class="w-auto form-control @error('intro_feature_3') is-invalid @enderror" id="introFeature3" name="intro_feature_3" placeholder="Карточка 3" value="{{ $camp->intro_feature_3 }}">
                        @error('intro_feature_3')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <div class="form-group p-3">
                        <div class="mb-2"><b>Изображение для превью видео в шапке, 1080х792 jpg</b></div>
                        <img class="mb-2" src="/{{ $camp->intro_video_poster }}" alt="Изображение" width="110" id="uploadedImage">
                        <div class="custom-file">
                            <input type="file" class=" custom-file-input @error('intro_video_poster') is-invalid @enderror" id="inputImage" name="intro_video_poster">
                            <label class="custom-file-label d-block" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                            @error('intro_video_poster')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group p-3">
                        <div class="mb-2"><b>Короткое видео в шапке, 1080х792 mp4</b></div>
                        <video class="mt-2" src="/{{ $camp->intro_video_short }}" id="uploadedVideo" controls width="340"></video>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('intro_video_short') is-invalid @enderror" id="inputVideo" name="intro_video_short">
                            <label class="custom-file-label" for="inputVideo" data-browse="Выбрать">Выберите видео</label>
                            @error('intro_video_short')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group p-3">
                        <div class="mb-2"><b>Полное видео в шапке, mp4</b></div>
                        <video class="mt-2" src="/{{ $camp->intro_video_big }}" id="uploadedVideoBig" controls height="340"></video>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('intro_video_big') is-invalid @enderror" id="inputVideoBig" name="intro_video_big">
                            <label class="custom-file-label" for="inputVideoBig" data-browse="Выбрать">Выберите видео</label>
                            @error('intro_video_big')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">О Лагере</h2>

                <div class="form-group mt-5">
                    <label for="aboutH2">Заголовок в текстовом блоке о лагере <span class="text-info">Что такое шахматный лагерь</span></label>
                    <input type="text" class="form-control @error('about_h2') is-invalid @enderror" id="aboutH2" name="about_h2" placeholder="Заголовок" value="{{ $camp->about_h2 }}">
                    @error('about_h2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">О Лагере - Блоки текста</h2>
                <button class="camp-add-features bg-success" type="button">Добавить блок</button>
                <span class="text-info ml-2">Добавится внизу списка</span>

                <div class="camp-features-container-wrapper mt-5">
                    @for($i = 0; $i < count($features); $i++)
                        <div class="mt-5 camp-features-item">
                            <div class="camp-features-item-wrapper">
                                <div class="mt-5 d-flex ">

                                    <input class="camp-features__count__input" type="hidden" name="{{ "campFeatures[".$i."][count]" }}" value="{{ $i }}">

                                    <input class="camp-features__id__input" type="hidden" name="{{ "campFeatures[".$i."][id]" }}" value="{{$features[$i]->id}}">

                                    <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                        <label class="camp-features__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                            <span style="width: min-content">Порядок сортировки</span>
                                            <input type="text" class="form-control camp-features__order__input" name="{{ "campFeatures[".$i."][order]" }}" value="{{ $features[$i]->order }}">
                                        </label>
                                    </div>

                                    <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 400px">
                                        <label class="camp-features__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                            <span>Название блока<br><span class="text-info">Обучение и игры</span></span>
                                            <input type="text" class="form-control camp-features__title__input"  name="{{ "campFeatures[".$i."][title]" }}" value="{{ $features[$i]->title }}">
                                        </label>
                                    </div>

                                    <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                        <label class="camp-features__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                            <span>Большой текст для пункта<br><span class="text-info">КАЖДЫЙ абзац нужно обернуть в теги. &lt;p&gt;Пример абзаца&lt;/p&gt;</span></span>
                                            <textarea type="text" class="form-control camp-features__description__input" rows="10"  name="{{ "campFeatures[".$i."][description]" }}">{!! $features[$i]->description !!}</textarea>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-2"><b>Для первого блока нужен размер изображения 740px на 480px jpg, для остальных изображений размер 739px на 350px jpg</b></div>
                                        <div class="custom-file">
                                            <label class="custom-file-label" data-browse="Выбрать">
                                                <span>Выберите изображение</span>
                                                <input type="file" class="custom-file-input camp-features__image__input" name="{{ "campFeatures[".$i."][features_image]" }}" value="{{ $features[$i]->features_image }}">
                                            </label>
                                        </div>
                                        <img class="mt-3 camp-features__image" src="/@if( $features[$i]->features_image ){{$features[$i]->features_image}}@else {{ asset('images/admin/news-no-image.jpg') }} @endif" alt="Загруженное изображение" width="240">
                                    </div>
                                </div>

                                @if(count($features[$i]->items) > 0)
                                    <div class="mt-5 camp-feature-items-container">
                                        <div class="visually-hidden camp-feature-item-number" data-campfeaturenumber="{{ $i }}"></div>
                                        <button class="camp-add-feature-items bg-success" type="button">Добавить плашку на фото</button>
                                        <span class="text-info ml-2">Добавится внизу списка</span>

                                        @for($j = 0; $j < count($features[$i]->items); $j++)
                                            <div class="mt-5 d-flex camp-feature-items-wrapper">

                                                <input class="camp-feature-item__id__input" type="hidden" name="<?php echo e("campFeatures[".$i."][items][".$j."][id]"); ?>" value="{{$features[$i]->items[$j]->id}}">

                                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: min-content; margin: 0 10px;">
                                                    <label class="сamp-feature-item__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                                        <span style="width: min-content">Порядок сортировки</span>
                                                        <input type="text" class="form-control camp-feature-item__order__input" name="<?php echo e("campFeatures[".$i."][items][".$j."][order]"); ?>" value="{{ $features[$i]->items[$j]->order }}">
                                                    </label>
                                                </div>

                                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 400px">
                                                    <label class="сamp-feature-item__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                                        <span>Название плашки на фотографии - <span class="text-info">игры</span></span>
                                                        <input type="text" class="form-control camp-feature-item__title__input"  name="<?php echo e("campFeatures[".$i."][items][".$j."][title]"); ?>" value="{{ $features[$i]->items[$j]->title }}">
                                                    </label>
                                                </div>

                                                <div class="d-flex justify-content-center ml-3" style="margin-top: 40px">
                                                    <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px; width: 100%">Удалить плашку</button>
                                                </div>

                                            </div>
                                        @endfor
                                    </div>
                                @endif


                            <div class="d-flex justify-content-center ml-3" style="margin-top: 40px">
                                <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px; width: 100%">Удалить весь блок выше этой кнопки</button>
                            </div>

                        </div>
                        <hr style="height: 20px; background-color: #ffc1071a;">
                        </div>
                    @endfor
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">О Лагере - Даты</h2>
                <div class="d-flex justify-content-between mt-5">
                    <div class="form-group">
                        <label for="date1">Дата 1-ой смены, <span class="text-info">17.07</span></label>
                        <input type="text" class="w-auto form-control @error('date_1') is-invalid @enderror" id="date1" name="date_1" placeholder="Дата 1" value="{{ $camp->date_1 }}">
                        @error('date_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date2">Дата 2-ой смены, формат <span class="text-info">17.07</span></label>
                        <input type="text" class="w-auto form-control @error('date_2') is-invalid @enderror" id="date2" name="date_2" placeholder="Дата 2" value="{{ $camp->date_2 }}">
                        @error('date_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dateDeparture">Дата окончания, формат <span class="text-info">17.07</span></label>
                        <input type="text" class="w-auto form-control @error('date_departure') is-invalid @enderror" id="dateDeparture" name="date_departure" placeholder="Дата окончания" value="{{ $camp->date_departure }}">
                        @error('date_departure')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dateDuration">Продолжительность, формат <span class="text-info">7 дней</span></label>
                        <input type="text" class="w-auto form-control @error('date_duration') is-invalid @enderror" id="dateDuration" name="date_duration" placeholder="Продолжительность" value="{{ $camp->date_duration }}">
                        @error('date_duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Расписание</h2>


                <div class="form-group mt-5">
                    <label for="scheduleH2">Заголовок в блоке расписание со временем <span class="text-info">Что будет происходить в лагере</span></label>
                    <input type="text" class="form-control @error('schedule_h2') is-invalid @enderror" id="scheduleH2" name="schedule_h2" placeholder="Заголовок" value="{{ $camp->schedule_h2 }}">
                    @error('schedule_h2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Расписание - Обучение</h2>
                <button class="camp-add-education bg-success" type="button">Добавить пункт в расписание</button>
                <span class="text-info ml-2">Добавится внизу списка</span>
                <div class="camp-education-container mt-5">

                    @for($i = 0; $i < count($educations); $i++)
                        <div class="mt-4 d-flex camp-education-item">
                            <input class="camp-education__id__input" type="hidden" name="{{ "campEducations[".$i."][id]" }}" value="{{$educations[$i]->id}}">

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                <label class="camp-education__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                    <span style="width: max-content">Порядок плашки - <span class="text-info">1</span></span>
                                    <input type="text" class="form-control camp-education__order__input" name="{{ "campEducations[".$i."][order]" }}" value="{{ $educations[$i]->order }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-education__time__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span style="width: max-content">Время с - до <span class="text-info">10:00 - 10:30</span></span>
                                    <input type="text" class="form-control camp-education__time__input"  name="{{ "campEducations[".$i."][time]" }}" value="{{ $educations[$i]->time }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-education__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Название пункта<br><span class="text-info">Решение простых задач</span></span>
                                    <input type="text" class="form-control camp-education__title__input"  name="{{ "campEducations[".$i."][title]" }}" value="{{ $educations[$i]->title }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-education__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Описание пункта<br><span class="text-info">2 группы: начинающие(+) и играющие</span></span>
                                    <input type="text" class="form-control camp-education__description__input"  name="{{ "campEducations[".$i."][description]" }}" value="{{ $educations[$i]->description }}">
                                </label>
                            </div>

                            <div class="d-flex justify-content-center" style="margin-top: 40px">
                                <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
                            </div>

                        </div>
                    @endfor
                </div>








                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Расписание - Еда</h2>
                <button class="camp-add-meals bg-success" type="button">Добавить пункт в расписание</button>
                <span class="text-info ml-2">Добавится внизу списка</span>
                <div class="camp-meals-container mt-5">

                    @for($i = 0; $i < count($meals); $i++)
                        <div class="mt-4 d-flex camp-meals-item">
                            <input class="camp-meals__id__input" type="hidden" name="{{ "campMeals[".$i."][id]" }}" value="{{$meals[$i]->id}}">

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                <label class="camp-meals__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                    <span style="width: max-content">Порядок плашки - <span class="text-info">1</span></span>
                                    <input type="text" class="form-control camp-meals__order__input" name="{{ "campMeals[".$i."][order]" }}" value="{{ $meals[$i]->order }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-meals__time__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span style="width: max-content">Время с - до <span class="text-info">10:00 - 10:30</span></span>
                                    <input type="text" class="form-control camp-meals__time__input"  name="{{ "campMeals[".$i."][time]" }}" value="{{ $meals[$i]->time }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-meals__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Название пункта<br><span class="text-info">Завтрак</span></span>
                                    <input type="text" class="form-control camp-meals__title__input"  name="{{ "campMeals[".$i."][title]" }}" value="{{ $meals[$i]->title }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-meals__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Описание пункта<br><span class="text-info">Каша, бутерброд, чай, хлопья, яйца</span></span>
                                    <input type="text" class="form-control camp-meals__description__input"  name="{{ "campMeals[".$i."][description]" }}" value="{{ $meals[$i]->description }}">
                                </label>
                            </div>

                            <div class="d-flex justify-content-center" style="margin-top: 40px">
                                <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
                            </div>

                        </div>
                    @endfor
                </div>









                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Расписание - Активности</h2>
                <button class="camp-add-activity bg-success" type="button">Добавить пункт в расписание</button>
                <span class="text-info ml-2">Добавится внизу списка</span>
                <div class="camp-activity-container mt-5">

                    @for($i = 0; $i < count($activities); $i++)
                        <div class="mt-4 d-flex camp-activity-item">
                            <input class="camp-activity__id__input" type="hidden" name="{{ "campActivities[".$i."][id]" }}" value="{{$activities[$i]->id}}">

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                <label class="camp-activity__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                    <span style="width: max-content">Порядок плашки - <span class="text-info">1</span></span>
                                    <input type="text" class="form-control camp-activity__order__input" name="{{ "campActivities[".$i."][order]" }}" value="{{ $activities[$i]->order }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-activity__time__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span style="width: max-content">Время с - до <span class="text-info">10:00 - 10:30</span></span>
                                    <input type="text" class="form-control camp-activity__time__input"  name="{{ "campActivities[".$i."][time]" }}" value="{{ $activities[$i]->time }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-activity__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Название пункта<br><span class="text-info">Подъем, зарядка</span></span>
                                    <input type="text" class="form-control camp-activity__title__input"  name="{{ "campActivities[".$i."][title]" }}" value="{{ $activities[$i]->title }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-activity__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Описание пункта<br><span class="text-info">В хорошую погоду - купание</span></span>
                                    <input type="text" class="form-control camp-activity__description__input"  name="{{ "campActivities[".$i."][description]" }}" value="{{ $activities[$i]->description }}">
                                </label>
                            </div>

                            <div class="d-flex justify-content-center" style="margin-top: 40px">
                                <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
                            </div>

                        </div>
                    @endfor
                </div>







                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Тренера</h2>


                <div class="form-group mt-5">
                    <label for="teachersH2">Заголовок в блоке тренеров <span class="text-info">Кто ведет лагерь</span></label>
                    <input type="text" class="form-control @error('teachers_h2') is-invalid @enderror" id="teachersH2" name="teachers_h2" placeholder="Заголовок" value="{{ $camp->teachers_h2 }}">
                    @error('teachers_h2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="teachersDescription">Описание под заголовком в блоке о тренерах. Если нужен перенос текста на новую строку - вставить &lt;br&gt;</label>
                    <textarea rows="5" cols="33" type="text" class="form-control @error('teachers_description') is-invalid @enderror" id="teachersDescription" name="teachers_description" placeholder="Описание" >{!! $camp->teachers_description !!}</textarea>
                    @error('teachers_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Локация</h2>

                <div class="form-group mt-5">
                    <label for="locationH2">Заголовок в блоке Локация <span class="text-info">Локация</span></label>
                    <input type="text" class="form-control @error('location_h2') is-invalid @enderror" id="locationH2" name="location_h2" placeholder="Заголовок" value="{{ $camp->location_h2 }}">
                    @error('location_h2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationDescription">Подзаголовок 1-ого блока в локации <span class="text-info">Месторасположение</span></label>
                    <input type="text" class="form-control @error('location_description') is-invalid @enderror" id="locationDescription" name="location_description" placeholder="Подзаголовок" value="{{ $camp->location_description }}">
                    @error('location_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationTitle">Название базы отдыха <span class="text-info">База отдыха Лесная полянка</span></label>
                    <input type="text" class="form-control @error('location_title') is-invalid @enderror" id="locationTitle" name="location_title" placeholder="База отдыха" value="{{ $camp->location_title }}">
                    @error('location_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationAddress">Адрес базы отдыха <span class="text-info">Ленинградская область, п. Вахруши, лагерь Василёнок, д.7-10</span></label>
                    <input type="text" class="form-control @error('location_address') is-invalid @enderror" id="locationAddress" name="location_address" placeholder="Адрес" value="{{ $camp->location_address }}">
                    @error('location_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationTitle2">Подзаголовок 2-ого блока в локации <span class="text-info">Основной корпус</span></label>
                    <input type="text" class="form-control @error('location_title_2') is-invalid @enderror" id="locationTitle2" name="location_title_2" placeholder="Подзаголовок 2" value="{{ $camp->location_title_2 }}">
                    @error('location_title_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationDescription2">Описание 2-ого блока в локации</label>
                    <textarea type="text" class="form-control @error('location_description_2') is-invalid @enderror" id="locationDescription2" name="location_description_2" placeholder="Описание 2">{{ $camp->location_description_2 }}</textarea>
                    @error('location_description_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationTitle3">Подзаголовок 3-ого блока в локации <span class="text-info">На территории</span></label>
                    <input type="text" class="form-control @error('location_title_3') is-invalid @enderror" id="locationTitle3" name="location_title_3" placeholder="Подзаголовок 3" value="{{ $camp->location_title_3 }}">
                    @error('location_title_3')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-5">
                    <label for="locationDescription3">Описание 3-ого блока в локации</label>
                    <textarea type="text" class="form-control @error('location_description_3') is-invalid @enderror" id="locationDescription3" name="location_description_3" placeholder="Описание 3">{{ $camp->location_description_3 }}</textarea>
                    @error('location_description_3')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Цены - Карточки</h2>
                <button class="camp-add-price-card-button" type="button">Добавить ценник</button>
                <span class="text-info ml-2">Добавится внизу списка</span>
                <div class="camp-price-card-container">
                    @for($i = 0; $i < count($prices); $i++)
                        <div class="camp-price-card-list">
                            <div class="mt-5 d-flex">
                                <h3 class="bg-info camp-price__h3" style="display: inline-block; padding: 0 20px;">Ценник № {{ $i + 1 }}</h3>
                                <button class="bg-danger button-delete__second-level" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
                            </div>

                            <div class="d-flex">
                                <input class="camp-price__id__input" type="hidden" name="{{ "campPrices[".$i."][id]" }}" value="{{$prices[$i]->id}}">

                                <div class="form-group mt-2 mb-0" style="width: fit-content; margin-right: 10px;">
                                    <label class="camp-price__is-discount__label d-flex flex-column justify-content-between" style="height: 100%">
                                        <span>Скидочный ценник? <br> <span class="text-info">Галочка - да</span></span>
                                        <input type="checkbox" class="form-control camp-price__is-discount__input"
                                               name="{{ "campPrices[".$i."][is_discount]" }}" @if($prices[$i]->is_discount) checked @endif value="1">
                                    </label>
                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                    <label class="camp-price__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                        <span>Порядок ценника - <span class="text-info">1</span></span>
                                        <input type="text" class="form-control camp-price__order__input" name="{{ "campPrices[".$i."][order]" }}" value="{{ $prices[$i]->order }}">
                                    </label>
                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                    <label class="camp-price__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                        <span>Заголовок ценника <br> <span class="text-info">Участие в одной смене</span></span>
                                        <textarea type="text" class="form-control camp-price__title__input" name="{{ "campPrices[".$i."][title]" }}">{{ $prices[$i]->title }}</textarea>
                                    </label>

                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                                    <label class="camp-price__amount__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                        <span>Цена 1, для добавления символа рубля добавить <span class="text-info"> {{ '&#8381;' }}</span></span>
                                        <input type="text" class="form-control camp-price__amount__input" name="{{ "campPrices[".$i."][amount]" }}" value="{{ $prices[$i]->amount }}">
                                    </label>
                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                                    <label class="camp-price__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                        <span>Описание цены 1 <br><span class="text-info">7 дней</span></span>
                                        <textarea type="text" class="form-control camp-price__description__input"  name="{{ "campPrices[".$i."][description]" }}" >{{ $prices[$i]->description }}</textarea>
                                    </label>
                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                                    <label class="camp-price__second_amount__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                        <span>Цена 2, для добавления символа рубля добавить <span class="text-info"> {{ '&#8381;' }}</span></span>
                                        <input type="text" class="form-control camp-price__second_amount__input" name="{{ "campPrices[".$i."][second_amount]" }}" placeholder="" value="{{ $prices[$i]->second_amount }}">
                                    </label>

                                </div>

                                <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                                    <label class="camp-price__second_description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                        <span>Описание цены 2 <br><span class="text-info">7 дней</span></span>
                                        <textarea type="text" class="form-control camp-price__second_description__input" name="{{ "campPrices[".$i."][second_description]" }}" placeholder="" >{{ $prices[$i]->second_description }}</textarea>
                                    </label>

                                </div>
                            </div>
                        </div>

                    @endfor
                </div>

                <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Цены - Что включено</h2>
                <button class="camp-add-price-include-button" type="button">Добавить плашку</button>
                <span class="text-info ml-2">Добавится внизу списка</span>
                <div class="camp-price-include-container mt-5">
                    @for($i = 0; $i < count($priceIncludes); $i++)
                        <div class="mt-4 d-flex camp-price-include-item">
                            <input class="camp-price-include__id__input" type="hidden" name="{{ "campPriceIncludes[".$i."][id]" }}" value="{{$priceIncludes[$i]->id}}">

                            <div class="form-group mt-2 mb-0" style="width: fit-content; margin-right: 10px;">
                                <label class="camp-price-include__is-discount__label d-flex flex-column justify-content-between" style="height: 100%">
                                    <span>Розовая плашка для скидки <br> <span class="text-info">Галочка - да</span></span>
                                    <input type="checkbox" class="form-control camp-price-include__is-discount__input"
                                           name="{{ "campPriceIncludes[".$i."][is_discount]" }}" @if($priceIncludes[$i]->is_discount) checked @endif value="1">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                                <label class="camp-price-include__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                                    <span>Порядок плашки - <span class="text-info">1</span></span>
                                    <input type="text" class="form-control camp-price-include__order__input" name="{{ "campPriceIncludes[".$i."][order]" }}" value="{{ $priceIncludes[$i]->order }}">
                                </label>
                            </div>

                            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                                <label class="camp-price-include__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                                    <span>Описание на плашке <br><span class="text-info">Проживание в комнатах от 2 до 6 человек</span></span>
                                    <textarea type="text" class="form-control camp-price-include__description__input"  name="{{ "campPriceIncludes[".$i."][description]" }}" >{{ $priceIncludes[$i]->description }}</textarea>
                                </label>
                            </div>

                            <div class="d-flex justify-content-center" style="margin-top: 40px">
                                <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
                            </div>

                        </div>
                    @endfor

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Обновить</button>
            </div>
        </form>
    </section>

    <x-admin-add-price-card-template />
    <x-admin-add-price-include-template />
    <x-admin-add-schedule-education-template />
    <x-admin-add-schedule-meals-template />
    <x-admin-add-schedule-activity-template />
    <x-admin-add-camp-feature-template />
    <x-admin-add-camp-feature-item-template />
@endsection

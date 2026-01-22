@extends('layouts.chess')

@section('content')
    <main class="page__main page__main--camp">
        <section class="camp-intro">
            <div class="camp-intro__content" @if($camp->is_camp_promo) style="padding-top: 120px" @endif>
                <h1 class="camp-intro__title title title--first"><span>Шахматный</span><br> лагерь {{ $camp->h1 }}</h1>
                <p class="camp-intro__subtitle">Выездной шахматный лагерь вместе с клубом А5 в Ленинградской области</p>
                <button class="camp-intro__button button button--primary request-button" type="button" data-name="Лагерь > главный экран">Узнать подробности</button>
                <p class="camp-intro__text">Интенсивы по шахматам, веселые старты, игры на свежем воздухе, активный отдых и настольные игры</p>
                <ul class="camp-intro__features">
                    @if( $camp->intro_feature_1 )<li>{{ $camp->intro_feature_1 }}</li>@endif
                    @if( $camp->intro_feature_2 )<li>{{ $camp->intro_feature_2 }}</li>@endif
                    @if( $camp->intro_feature_3 )<li>{{ $camp->intro_feature_3 }}</li>@endif
                </ul>
                @if($camp->is_camp_promo)
                    <div class="camp-intro__star">
                        <span>Обвновление<br>на {{ $camp->camp_promo_year }} год<br>Скоро</span>
                    </div>
                @endif
            </div>

            <div class="camp-intro__video-wrapper">
                <video class="camp-intro__video-videofile lazy" preload="none" muted="" loop="" playsinline="" poster="/{{ $camp->intro_video_poster }}">
                    <source data-src="/{{ $camp->intro_video_short }}" type="video/mp4"></video>
                <a class="camp-intro__video-link button button--glass" data-fancybox="video-gallery" href="/{{ $camp->intro_video_big }}">Смотреть видео</a>
            </div>
        </section>
        @if(count($features) > 0)
            <section class="camp-about">
                <ul class="camp-about__list">
                    <li class="camp-about__item camp-about__item--education">
                        <h2 class="camp-about__title title title--second">{{ $camp->about_h2 }}</h2>
                        <h3 class="camp-about__third-title title title--third">{{ $features[0]->title }}</h3>
                        {!! $features[0]->description !!}
                    </li>
                    <li class="camp-about__item camp-about__item--education-image">
                        <picture>
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($features[0]->features_image) }}" type="image/webp" width="740" height="480">
                            <img class="camp-about__image" src="{{ $features[0]->features_image }}" alt="развлечения в шахматном лагере." width="740" height="480">
                        </picture>
                        @if(count($features[0]->items) > 0)
                            <ul>
                                @foreach($features[0]->items as $item)
                                    <li>{{ $item->title }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @for($i = 1; $i < count($features); $i++ )
                        <li class="camp-about__item camp-about__item--safety">
                            <h3 class="camp-about__third-title title title--third">{{ $features[$i]->title }}</h3>
                            {!! $features[$i]->description !!}
                        </li>
                        <li class="camp-about__item camp-about__item--safety-image">
                            <picture>
                                <source srcset="{{ \App\Src\Functions::jpgToWebp($features[$i]->features_image) }}" type="image/webp" width="739" height="350">
                                <img class="camp-about__image" src="{{ $features[$i]->features_image }}" alt="развлечения в шахматном лагере." width="739" height="350">
                            </picture>
                            @if(count($features[$i]->items) > 0)
                                <ul>
                                    @foreach($features[$i]->items as $item)
                                        <li>{{ $item->title }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endfor


                </ul>
            </section>
        @endif
        <section class="camp-dates">
            <ul class="camp-dates__list">
                <li class="camp-dates__date camp-dates__date--arrival">
                    <span>{{ $camp->date_1 }}</span>
                    <p>Заезд<br>1 смены</p>
                </li>

                <li class="camp-dates__dashed">
                    <div class="camp-dates__dashed-container"></div>
                </li>

                <li class="camp-dates__date camp-dates__date--between">
                    <span>{{ $camp->date_duration }}</span>
                    <p>Фото и видео отчеты</p>
                </li>

                @if($camp->date_2)
                    <li class="camp-dates__dashed">
                        <div class="camp-dates__dashed-container"></div>
                    </li>

                    <li class="camp-dates__date camp-dates__date--arrival">
                        <span>{{ $camp->date_2 }}</span>
                        <p>Заезд<br>2 смены</p>
                    </li>

                    <li class="camp-dates__dashed">
                        <div class="camp-dates__dashed-container"></div>
                    </li>

                    <li class="camp-dates__date camp-dates__date--between">
                        <span>{{ $camp->date_duration }}</span>
                        <p>Фото и видео отчеты</p>
                    </li>
                @endif

                <li class="camp-dates__dashed">
                    <div class="camp-dates__dashed-container"></div>
                </li>

                <li class="camp-dates__date camp-dates__date--departure">
                    <span>{{ $camp->date_departure }}</span>
                    <p>Выезд</p>
                </li>
            </ul>

        </section>
        <section class="camp-growth">
            <div class="camp-growth__wrapper">
                <h2 class="camp-growth__title title title--second">Какое развитие даёт шахматный лагерь</h2>
                <div class="camp-growth__description">
                    <p>Шахматный лагерь предоставляет детям уникальную возможность развивать критическое мышление и аналитические навыки. Игры на шахматной доске способствуют улучшению памяти и концентрации</p>
                    <p>Общение с ровесниками в лагере развивает коммуникативные навыки и командный дух. Лагерь помогает детям не только лучше овладеть игрой, но и становятся основой для формирования самостоятельной личности.</p>
                </div>
                <ol class="camp-growth__list">
                    <li class="camp-growth__item">
                        <p class="camp-growth__item-number title title--first">01</p>
                        <span>Более 3 часов каждый день ребята занимаются шахматами</span>
                        <picture>
                            <source srcset="images/camp/camp-growth-1.webp" type="image/webp" width="175" height="175">
                            <img class="camp-growth__image" src="images/camp/camp-growth-1.jpg" alt="занятия каждый день." width="175" height="175">
                        </picture>
                        <h3 class="camp-growth__third-title title title--third">Навык планирования</h3>
                        <p>При длительных занятиях ребята учатся разрабатывать долгосрочные стратегии и тактические комбинации</p>
                    </li>
                    <li class="camp-growth__item">
                        <p class="camp-growth__item-number title title--first">02</p>
                        <h3 class="camp-growth__third-title title title--third">Много активности</h3>
                        <p>Большинство активных игр происходит на свежем воздухе. Также выходим на длительные пешие “походы” по 3-4 км.</p>
                        <p>В солнечные теплые дни, с разрешения родителей, детям разрешается купание в озере.</p>
                        <p>В свободное время ребята играют между собой.</p>
                    </li>
                    <li class="camp-growth__item">
                        <p class="camp-growth__item-number title title--first">03</p>
                        <span>Более 8 часов каждый день ребята общаются и играют вместе</span>
                        <picture>
                            <source srcset="images/camp/camp-growth-2.webp" type="image/webp" width="200" height="175">
                            <img class="camp-growth__image" src="images/camp/camp-growth-2.jpg" alt="командные игры." width="200" height="175">
                        </picture>
                        <h3 class="camp-growth__third-title title title--third">Коммуникация</h3>
                        <p>Продолжительное нахождение друг с другом позволяет детям подружиться, укрепляет навык общения и взаимодействия </p>
                    </li>
                    <li class="camp-growth__item">
                        <p class="camp-growth__item-number title title--first">04</p>
                        <h3 class="camp-growth__third-title title title--third">Самостоятельность и критическое мышление</h3>
                        <p>Ежедневно детям приходится самостоятельно решать много вопросов как по шахматам, там и в плане самодисциплины.</p>
                        <p>День в лагере подвержен распорядка дня и детям нужно его соблюдать.</p>
                    </li>
                </ol>
            </div>
        </section>
        <section class="camp-schedule">
            <h2 class="camp-schedule__title title title--second">{{ $camp->schedule_h2 }}</h2>
            <ul class="camp-schedule__activities-list">
                @if(count($educations))
                    <li class="camp-schedule__activities-item">
                        <div class="camp-schedule__activities-title-wrapper">
                            <picture>
                                <source srcset="images/camp/activities-education.webp" type="image/webp" width="70" height="70">
                                <img class="camp-schedule__activities-image" src="images/camp/activities-education.png" alt="обучение." width="740" height="480">
                            </picture>
                            <h3 class="camp-schedule__activities-title">Обучение</h3>
                        </div>

                        <ul class="camp-schedule__day-list">
                            @foreach($educations as $education)
                                <li class="camp-schedule__day-item">
                                    <div class="camp-schedule__day-time">{{ $education->time }}</div>
                                    <div class="camp-schedule__day-activity-title">{{ $education->title }}</div>
                                    <div class="camp-schedule__day-activity-description">{{ $education->description }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(count($meals))
                    <li class="camp-schedule__activities-item">
                        <div class="camp-schedule__activities-title-wrapper">
                            <picture>
                                <source srcset="images/camp/activities-meals.webp" type="image/webp" width="70" height="70">
                                <img class="camp-schedule__activities-image" src="images/camp/activities-meals.png" alt="активности." width="740" height="480">
                            </picture>
                            <h3 class="camp-schedule__activities-title">Питание</h3>
                        </div>

                        <ul class="camp-schedule__day-list">
                            @foreach($meals as $meals)
                                <li class="camp-schedule__day-item">
                                    <div class="camp-schedule__day-time">{{ $meals->time }}</div>
                                    <div class="camp-schedule__day-activity-title">{{ $meals->title }}</div>
                                    <div class="camp-schedule__day-activity-description">{{ $meals->description }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(count($activities))
                        <li class="camp-schedule__activities-item">
                            <div class="camp-schedule__activities-title-wrapper">
                                <picture>
                                    <source srcset="images/camp/activities-games.webp" type="image/webp" width="70" height="70">
                                    <img class="camp-schedule__activities-image" src="images/camp/activities-games.png" alt="активности." width="740" height="480">
                                </picture>
                                <h3 class="camp-schedule__activities-title">Активности</h3>
                            </div>
                            <ul class="camp-schedule__day-list">
                                @foreach($activities as $activity)
                                    <li class="camp-schedule__day-item">
                                        <div class="camp-schedule__day-time">{{ $activity->time }}</div>
                                        <div class="camp-schedule__day-activity-title">{{ $activity->title }}</div>
                                        <div class="camp-schedule__day-activity-description">{{ $activity->description }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                @endif


            </ul>
        </section>
        <picture>
            <source srcset="images/camp/camp-2.webp" type="image/webp" width="1920" height="650">
            <img class="camp-image" src="images/camp/camp-2.png" alt="активности." width="1920" height="650">
        </picture>
        <section class="camp-teachers">
            <h2 class="camp-teachers__title title title--second">{{ $camp->teachers_h2 }}</h2>
            <p class="camp-teachers__description">{!! $camp->teachers_description !!}</p>

            <ul class="camp-teachers__list">
                @foreach($teachers as $teacher)

                    <li class="camp-teachers__item">
                        <div class="camp-teachers__item-container">
                            <div class="camp-teachers__name-container">
                                <span class="camp-teachers__item-name"><b>{{ $teacher->name }}</b></span>
                                <span class="camp-teachers__item-category">{{ $teacher->rank }}</span>
                            </div>

                            @if(isset($teacher->achievements))
                                <ul class="camp-teachers__item-features-list">
                                    @foreach($teacher->achievements as $achievement)
                                        <li class="camp-teachers__item-features-item">{{ $achievement->title }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <a class="camp-teachers__button button button--secondary" href="https://t.me/{{ $teacher->tg }}" target="_blank">Задать вопрос в Telegram
                                <svg class="camp-teachers__button-icon" width="24" height="24">
                                    <use href="{{ asset('images/icons/sprite/sprite.svg#telegram-icon') }}"></use>
                                </svg>
                                <span class="visually-hidden">Telegram.</span></a>
                        </div>
                        <picture class="camp-teachers__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($teacher->camp_image) }}" type="image/webp" width="740" height="400">
                            <img class="camp-teachers__image" src="{{ $teacher->camp_image }}" alt="{{ $teacher->name }}." width="740" height="400">
                        </picture>
                    </li>
                @endforeach
            </ul>
        </section>
        @if(count($locationSliders) > 0)
            <section class="camp-location">
                <h2 class="camp-location__title title title--second">{{ $camp->location_h2 }}</h2>
                <ul class="camp-location__features-list">
                    <li class="camp-location__features-item">
                        <span class="camp-location__features-item-title">{{ $camp->location_description }}</span>
                        <p class="camp-location__features-item-description"><b>{{ $camp->location_title }} </b>{!! $camp->location_address !!}</p>
                    </li>
                    @if($camp->location_title_2)
                        <li class="camp-location__features-item">
                            <span class="camp-location__features-item-title">{{ $camp->location_title_2 }}</span>
                            <p class="camp-location__features-item-description">{{ $camp->location_description_2 }}</p>
                        </li>
                    @endif

                    @if($camp->location_title_3)
                        <li class="camp-location__features-item">
                            <span class="camp-location__features-item-title">{{ $camp->location_title_3 }}</span>
                            <p class="camp-location__features-item-description">{{ $camp->location_description_3 }}</p>
                        </li>
                    @endif
                </ul>
                <ul class="camp-location__slider">
                    @foreach($locationSliders as $slider)
                        <li class="camp-location__slider-item">
                            <picture class="camp-location__picture">
                                <source srcset="images/camp/location/{{ basename($slider->image_prev, ".jpg")  }}.webp" type="image/webp" width="1131" height="690">
                                <img class="camp-location__image" src="{{ $slider->image_prev }}" alt="фото лагеря." width="1131" height="690">
                            </picture>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
        <section class="camp-price">
            <h2 class="camp-price__title title title--second">Цена, что включено</h2>
            <div class="camp-price__wrapper">
                <ul class="camp-price__list">
                    @for($i = 0; $i < count($prices); $i++)
                        @if(!$prices[$i]->is_discount)
                            <li class="camp-price__item">
                                <span class="camp-price__item-title">{{ $prices[$i]->title }}</span>
                                <span class="camp-price__item-cost">{!! $prices[$i]->amount !!} </span>
                                <span class="camp-price__item-duration">{{ $prices[$i]->description }}</span>
                            </li>

                        @else
                            <li class="camp-price__item">
                                <span class="camp-price__item-title">{{ $prices[$i]->title }}</span>
                                <ul class="camp-price__item-discount-list">
                                    <li class="camp-price__item-discount-item">
                                        <span class="camp-price__item-discount-amount">{{ $prices[$i]->amount }}</span>
                                        <p>{{ $prices[$i]->description }}</p>
                                    </li>
                                    <li class="camp-price__item-discount-item">
                                        <span class="camp-price__item-discount-amount">{{ $prices[$i]->second_amount }}</span>
                                        <p>{{ $prices[$i]->second_description }}</p>
                                    </li>
                                </ul>
                            </li>
                        @endif


                    @endfor
                </ul>
                <ul class="camp-price__include-list">
                    @foreach($priceIncludes as $priceInclude)
                        <li class="camp-price__include-item @if($priceInclude->is_discount) camp-price__include-item--discount @endif">{{ $priceInclude->description }}</li>
                    @endforeach
                </ul>
            </div>

        </section>
        <section class="camp-photos">
            <h2 class="camp-photos__title title title--second">Как это было, начиная с 2024 года</h2>
            <ul class="camp-photos__list">
                <li class="camp-photos__item camp-photos__item--first">
                    <a href="{{ $firstSlider->image_big }}" data-fancybox="camp-gallery">
                        <picture class="camp-photos__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($firstSlider->image_prev) }}" type="image/webp" width="780" height="520">
                            <img class="camp-photos__image" src="{{ $firstSlider->image_prev }}" alt="шахматный лагерь." width="780" height="520">
                        </picture>
                    </a>
                </li>

                <li class="camp-photos__item camp-photos__item--second">
                    <a href="{{ $secondSlider->image_big }}" data-fancybox="camp-gallery">
                        <picture class="camp-photos__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($secondSlider->image_prev) }}" type="image/webp" width="350" height="250">
                            <img class="camp-photos__image" src="{{ $secondSlider->image_prev }}" alt="шахматный лагерь." width="350" height="250">
                        </picture>
                    </a>
                </li>

                <li class="camp-photos__item camp-photos__item--second">
                    <a href="{{ $thirdSlider->image_big }}" data-fancybox="camp-gallery">
                        <picture class="camp-photos__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($thirdSlider->image_prev) }}" type="image/webp" width="350" height="250">
                            <img class="camp-photos__image" src="{{ $thirdSlider->image_prev }}" alt="шахматный лагерь." width="350" height="250">
                        </picture>
                    </a>
                </li>

                <li class="camp-photos__item camp-photos__item--second">
                    <a href="{{ $fourthSlider->image_big }}" data-fancybox="camp-gallery">
                        <picture class="camp-photos__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($fourthSlider->image_prev) }}" type="image/webp" width="350" height="250">
                            <img class="camp-photos__image" src="{{ $fourthSlider->image_prev }}" alt="шахматный лагерь." width="350" height="250">
                        </picture>
                    </a>
                </li>

                <li class="camp-photos__item camp-photos__item--second @if(count($hiddenSliders) > 0) camp-photos__item--dark @endif ">
                    <a href="{{ $fifthSlider->image_big }}" data-fancybox="camp-gallery">
                        <picture class="camp-photos__picture">
                            <source srcset="{{ \App\Src\Functions::jpgToWebp($fifthSlider->image_prev) }}" type="image/webp" width="350" height="250">
                            <img class="camp-photos__image" src="{{ $fifthSlider->image_prev }}" alt="шахматный лагерь." width="350" height="250">
                        </picture>
                        @if(count($hiddenSliders) > 0)
                            <span>+ {{ count($hiddenSliders) }}</span>
                        @endif

                    </a>
                </li>

                @if(count($hiddenSliders) > 0)
                    @foreach($hiddenSliders as $hiddenSlider)
                        <li class="camp-photos__item camp-photos__item--others">
                            <a href="{{ $hiddenSlider->image_big }}" data-fancybox="camp-gallery"></a>
                        </li>
                    @endforeach
                @endif



            </ul>
        </section>
        <x-request class="index-request--camp"/>
    </main>
@endsection

@section('modal')
    <x-modal-request/>
    <x-modal-subscribe/>
@endsection



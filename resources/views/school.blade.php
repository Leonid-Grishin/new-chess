@extends('layouts.chess')

{{--@section('styles', asset('css/school.min.css'))--}}

@push('styles')
    {{--@vite('resources/sass/page-styles/school.scss')--}}
    <link rel="preload" as="style" href="https://a5chess.ru/build/assets/school-B_u3gPla.css" />
    <link rel="stylesheet" href="https://a5chess.ru/build/assets/school-B_u3gPla.css" />
@endpush

@section('content')
<main class="page__main page__main--school">
    <section class="school-intro">
        <div class="school-intro__wrapper">
            <h1 class="school-intro__title title title--first">Школа шахмат&#160;<span class="school-intro__title-wrapper">А5</span></h1>
            <p class="school-intro__description">Офлайн групповые и индивидуальные занятия для&#160;детей</p>
            <button class="school-intro__button button button--primary" data-name="Школа > главный экран">Записаться на <span>пробное </span>занятие</button>
            <button class="school-intro__secondary-button button button--secondary button--secondary-intro" type="button" data-name="Школа > первый экран">Скачать задачник</button>
        </div>
        <ul class="school-intro__features-list">
            <li class="school-intro__features-item school-intro__features-item--red">Поддержка на&#160;соревнованиях</li>
            <li class="school-intro__features-item school-intro__features-item--yellow">Большое сообщество детей&#160;и&#160;родителей</li>
            <li class="school-intro__features-item school-intro__features-item--green">Отслеживание прогресса учеников</li>
            <li class="school-intro__features-item school-intro__features-item--blue">Авторская методика обучения</li>
        </ul>
        <picture>
            <source srcset="images/school/school-intro-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="1920" height="875">
            <source srcset="images/school/school-intro-desktop.jpg" media="(min-width: 1200px)" width="1920" height="875">
            <source srcset="images/school/school-intro-tablet.webp" type="image/webp" width="1200" height="574">
            <img class="school-intro__image" src="images/school/school-intro-tablet.jpg" alt="детская школа шахмат." width="1200" height="574">
        </picture>
    </section>
    <section class="school-offline">
        <h2 class="school-offline__title second-title">Почему важно заниматься офлайн</h2>
        <dl class="school-offline__mission determination">
            <dt class="determination__title">Цель <span class="determination__container">А5</span></dt>
            <dd class="determination__description">Сделать игру в шахматы интересной и доступной для нового поколения современных детей</dd>
        </dl>
        <picture class="school-offline__image-wrapper">
            <source srcset="images/school/school-offline-big.webp" media="(min-width: 1700px)" type="image/webp" width="1520" height="592">
            <source srcset="images/school/school-offline-big.jpg" media="(min-width: 1700px)" width="1520" height="592">
            <source srcset="images/school/school-offline-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="1170" height="592">
            <source srcset="images/school/school-offline-desktop.jpg" media="(min-width: 1200px)" width="1170" height="592">
            <source srcset="images/school/school-offline-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="313">
            <source srcset="images/school/school-offline-tablet.jpg" media="(min-width: 640px)" width="620" height="313">
            <source srcset="images/school/school-offline-mobile.webp" type="image/webp" width="300" height="150">
            <img class="school-offline__image" src="images/school/school-offline-mobile.jpg" alt="занятия шахматами" width="300" height="150">
        </picture>
        <p>Наиболее эффективными являются офлайн занятия. Общение с другими детьми и преподавателем помогает изучать шахматную науку эффективнее.</p>
        <p>Дети учатся взаимодействовать друг с другом, играть с шахматными часами, записывать партии.<span class="school-offline__text-wrapper"> Любые сложные моменты обучения переносятся на жизненные ситуации, чтобы ученикам было доступнее та или иная мысль. Наши занятия не бывают скучными, ведь залог хорошего занятия - довольный ребенок и результат за доской</span></p>
    </section>
    <section class="school-principles">
        <h2 class="school-principles__title second-title">Принципы работы А5</h2>
        <ul class="school-principles__list">
            <li class="school-principles__item school-principles__item--age">
                <h3 class="school-principles__item-title">Возраст и категории учеников</h3>
                <p class="school-principles__item-description">Занятия проводятся для детей от 4 лет</p>
            </li>
            <li class="school-principles__item school-principles__item--level">
                <h3 class="school-principles__item-title">Группы формируются по уровню игры</h3>
                <p class="school-principles__item-description">Формирование рейтинговых групп: от начинающих до играющих на турнирах</p>
            </li>
            <li class="school-principles__item school-principles__item--format">
                <h3 class="school-principles__item-title">Формат занятий</h3>
                <p class="school-principles__item-description">Вы можете выбрать удобный формат занятий</p>
            </li>
        </ul>
        <!--    <picture>
              <source srcset="images/school/chess-principles-big.webp" media="(min-width: 1700px)" type="image/webp" width="850" height="480">
              <source srcset="images/school/chess-principles-big.png" media="(min-width: 1700px)" width="850" height="480">
              <source srcset="images/school/chess-principles-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="415" height="480">
              <img class="school-principles__image" src="images/school/chess-principles-desktop.png" media="(min-width: 1200px)" alt="школа шахмат в СПб." width="415" height="480">
            </picture>-->
    </section>
    <section class="education-level">
        <div class="education-level__wrapper">
            <h2 class="education-level__title second-title">Мы предлагаем следующие этапы обучения</h2>
            <p class="education-level__description">Мы выделили 6 основных этапов обучения в шахматах так, чтобы это было понятно ученикам и их родителям. Длительность обучения каждого этапа обучения зависит индивидуально от каждого ученика</p>
            <div class="education-level__slider-number slider-number"><span class="slider-number__wrapper">1</span>/6</div>
            <ul class="education-level__list">
                <li class="education-level__item education-level__item--base">
                    <h3 class="education-level__item-title">Изучение основ шахмат</h3>
                    <p class="education-level__item-description">В игоровой манере расскажем об основах шахматной игры</p>
                </li>
                <li class="education-level__item education-level__item--opening">
                    <h3 class="education-level__item-title">Основы дебюта и их разыгрывание</h3>
                    <p class="education-level__item-description">Изучение принципов развития фигур в дебютах + постановка дебюта для игры</p>
                </li>
                <li class="education-level__item education-level__item--tactics">
                    <h3 class="education-level__item-title">Тактические приемы</h3>
                    <p class="education-level__item-description">Основы миттельшпиля, план игры в разных типах позиций. Переход в эндшпиль</p>
                </li>
                <li class="education-level__item education-level__item--endgame">
                    <h3 class="education-level__item-title">Базовые принципы эндшпиля</h3>
                    <p class="education-level__item-description">Принципы игры в пешечных, ладейных, ферзевых и легкофигурных окончаниях</p>
                </li>
                <li class="education-level__item education-level__item--practice">
                    <h3 class="education-level__item-title">Много практики на занятиях</h3>
                    <p class="education-level__item-description">Важная часть обучения. Отработка технических приемов, запись партий</p>
                </li>
                <li class="education-level__item education-level__item--task">
                    <h3 class="education-level__item-title">Решениие разного уровня задач</h3>
                    <p class="education-level__item-description">Закрепление пройденного материала, повышение уровня игры</p>
                </li>
            </ul>
{{--            <button class="education-level__button button button--secondary" data-name="Школа > Этапы обучения">Получить программу <span>обучения на почту</span></button>--}}
        </div>
    </section>
    <section class="school-groups">
        <h2 class="school-groups__title second-title">Группы учащихся</h2>
        <p class="school-groups__description">Каждый ученик сначала приходит на пробное занятие, а затем попадает в одну из групп в зависимости от уровня своей игры. Таким образом повышая уровень игры можно переходить из одной группы в другую</p>
        <ul class="school-groups__list">
            <li class="school-groups__item">
                <div class="school-groups__image-wrapper">
                    <picture>
                        <source srcset="images/school/group-pawn-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="330">
                        <source srcset="images/school/group-pawn-big.jpg" media="(min-width: 1700px)" width="740" height="330">
                        <source srcset="images/school/group-pawn-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="330">
                        <source srcset="images/school/group-pawn-desktop.jpg" media="(min-width: 1200px)" width="570" height="330">
                        <source srcset="images/school/group-pawn-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="285">
                        <source srcset="images/school/group-pawn-tablet.jpg" media="(min-width: 640px)" width="620" height="285">
                        <source srcset="images/school/group-pawn-mobile.webp" type="image/webp" width="300" height="180">
                        <img class="school-groups__image" src="images/school/group-pawn-mobile.jpg" alt="группа начинающих детей." width="300" height="180">
                    </picture>
                    <span class="school-groups__hint">Новички</span>
                </div>
                <div class="school-groups__item-container">
                    <h3 class="school-groups__item-title">Новички</h3>
                    <ul class="school-groups__sublist">
                        <li class="school-groups__subitem">В группу принимаются дети от 4 лет</li>
                        <li class="school-groups__subitem">Занятия проходят в игровой форме для лучшего запоминания</li>
                        <li class="school-groups__subitem">На зянятиях дети изучают какие есть фигуры и как они ходят</li>
                    </ul>
                    {{--<button class="school-groups__button button button--primary" data-name="Школа > Группа пешка" type="button">Записаться в группу</button>--}}
                    <a href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" rel="nofollow" class="school-groups__button button button--primary" target="_blank">Записаться в группу</a>
                </div>
            </li>
            <li class="school-groups__item">
                <div class="school-groups__image-wrapper">
                    <picture>
                        <source srcset="images/school/group-bishop-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="330">
                        <source srcset="images/school/group-bishop-big.jpg" media="(min-width: 1700px)" width="740" height="330">
                        <source srcset="images/school/group-bishop-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="330">
                        <source srcset="images/school/group-bishop-desktop.jpg" media="(min-width: 1200px)" width="570" height="330">
                        <source srcset="images/school/group-bishop-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="285">
                        <source srcset="images/school/group-bishop-tablet.jpg" media="(min-width: 640px)" width="620" height="285">
                        <source srcset="images/school/group-bishop-mobile.webp" type="image/webp" width="300" height="180">
                        <img class="school-groups__image" src="images/school/group-bishop-mobile.jpg" alt="группа начинающих плюс детей." width="300" height="180">
                    </picture>
                    <span class="school-groups__hint">Начинающие</span>
                </div>
                <div class="school-groups__item-container">
                    <h3 class="school-groups__item-title">Начинающие</h3>
                    <ul class="school-groups__sublist">
                        <li class="school-groups__subitem">В классах дети изучают основы шахмат</li>
                        <li class="school-groups__subitem">Занятия по 60 минут, учимся вырабатывать усидчивость</li>
                        <li class="school-groups__subitem">На зянятиях ученики пробуют играть свои первые партии</li>
                    </ul>
                    {{--<button class="school-groups__button button button--primary" data-name="Школа > Группа слон" type="button">Записаться в группу</button>--}}
                    <a href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" rel="nofollow" class="school-groups__button button button--primary" target="_blank">Записаться в группу</a>
                </div>
            </li>
            <li class="school-groups__item">
                <div class="school-groups__image-wrapper">
                    <picture>
                        <source srcset="images/school/group-1200-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="330">
                        <source srcset="images/school/group-1200-big.jpg" media="(min-width: 1700px)" width="740" height="330">
                        <source srcset="images/school/group-1200-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="330">
                        <source srcset="images/school/group-1200-desktop.jpg" media="(min-width: 1200px)" width="570" height="330">
                        <source srcset="images/school/group-1200-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="285">
                        <source srcset="images/school/group-1200-tablet.jpg" media="(min-width: 640px)" width="620" height="285">
                        <source srcset="images/school/group-1200-mobile.webp" type="image/webp" width="300" height="180">
                        <img class="school-groups__image" src="images/school/group-1200-mobile.jpg" alt="группа до 1200." width="300" height="180">
                    </picture>
                    <span class="school-groups__hint">Рейтинг&#160;ФШР до 1200</span>
                </div>
                <div class="school-groups__item-container">
                    <h3 class="school-groups__item-title">Начинающие + | Рейтинг&#160;ФШР до&#160;1200</h3>
                    <ul class="school-groups__sublist">
                        <li class="school-groups__subitem">Изучение дебютов, позиционной игры, тактических приемов</li>
                        <li class="school-groups__subitem">Занятия длятся 75 минут: 40 минут теория, 35 минут практика</li>
                        <li class="school-groups__subitem">Группы до 8 человек</li>
                    </ul>
                    {{--<button class="school-groups__button button button--primary" data-name="Школа > Группа до 1200" type="button">Записаться в группу</button>--}}
                    <a href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" rel="nofollow" class="school-groups__button button button--primary" target="_blank">Записаться в группу</a>
                </div>
            </li>
            <li class="school-groups__item">
                <div class="school-groups__image-wrapper">
                    <picture>
                        <source srcset="images/school/group-1200-more-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="330">
                        <source srcset="images/school/group-1200-more-big.jpg" media="(min-width: 1700px)" width="740" height="330">
                        <source srcset="images/school/group-1200-more-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="330">
                        <source srcset="images/school/group-1200-more-desktop.jpg" media="(min-width: 1200px)" width="570" height="330">
                        <source srcset="images/school/group-1200-more-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="285">
                        <source srcset="images/school/group-1200-more-tablet.jpg" media="(min-width: 640px)" width="620" height="285">
                        <source srcset="images/school/group-1200-more-mobile.webp" type="image/webp" width="300" height="180">
                        <img class="school-groups__image" src="images/school/group-1200-more-mobile.jpg" alt="группа от 1200." width="300" height="180">
                    </picture>
                    <span class="school-groups__hint">Рейтинг ФШР от 1200</span>
                </div>
                <div class="school-groups__item-container">
                    <h3 class="school-groups__item-title">Играющие | Рейтинг ФШР от&#160;1200</h3>
                    <ul class="school-groups__sublist">
                        <li class="school-groups__subitem">Углубленное изучение всех аспектов игры</li>
                        <li class="school-groups__subitem">Занятия длятся 90 минут: 60 минут теория, 30 минут практика</li>
                        <li class="school-groups__subitem">Группы до 8 человек</li>
                    </ul>
                    {{--<button class="school-groups__button button button--primary" data-name="Школа > Группа от 1200" type="button">Записаться в группу</button>--}}
                    <a href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" rel="nofollow" class="school-groups__button button button--primary" target="_blank">Записаться в группу</a>
                </div>
            </li>
        </ul>
    </section>
    <section class="trial-class">
        <div class="trial-class__wrapper">
            <h2 class="trial-class__title second-title">Первый шаг к&#160;цели - бесплатный пробный урок</h2>
            <p class="trial-class__description">Познакомимся с тренером, определим уровень игры, ответим на все вопросы</p>
            <button class="trial-class__button button button--primary" data-name="Школа > пробный урок" type="button">Записаться на занятие</button>
        </div>
    </section>
    <x-main-video/>
    <x-rating type=""/>
    <section class="school-promo">
        <h2 class="school-promo__title">Акции школы шахмат А5</h2>
        <ul class="school-promo__list">
            <li class="school-promo__item">
                <div class="school-promo__image-wrapper">
                    <picture>
                        <source srcset="images/school/promo-first-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="325">
                        <source srcset="images/school/promo-first-big.png" media="(min-width: 1700px)" width="740" height="325">
                        <source srcset="images/school/promo-first-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="325">
                        <source srcset="images/school/promo-first-desktop.png" media="(min-width: 1200px)" width="570" height="325">
                        <source srcset="images/school/promo-first-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="286">
                        <source srcset="images/school/promo-first-tablet.png" media="(min-width: 640px)" width="620" height="286">
                        <source srcset="images/school/promo-first.webp" type="image/webp" width="300" height="167">
                        <img class="school-promo__item-image" src="images/school/promo-first.png" alt="скидка на абонимент." width="300" height="167">
                    </picture>
                </div>
                <div class="school-promo__item-wrapper">
                    <h3 class="school-promo__item-title">Скидка 10% на абонемент в день пробного занятия</h3>
                    <p class="school-promo__item-description">Купи абонемент в день пробного занятия и получи скидку&#160;10%</p>
                    <button class="school-promo__button button button--primary" data-name="Школа > акции > скидка после пробного">Записаться на <span>пробное </span>занятие</button>
                </div>
            </li>
            <li class="school-promo__item">
                <div class="school-promo__image-wrapper">
                    <picture>
                        <source srcset="images/school/promo-friends-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="280">
                        <source srcset="images/school/promo-friends-big.png" media="(min-width: 1700px)" width="740" height="280">
                        <source srcset="images/school/promo-friends-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="280">
                        <source srcset="images/school/promo-friends-desktop.png" media="(min-width: 1200px)" width="570" height="280">
                        <source srcset="images/school/promo-friends-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="240">
                        <source srcset="images/school/promo-friends-tablet.png" media="(min-width: 640px)" width="620" height="240">
                        <source srcset="images/school/promo-friends.webp" type="image/webp" width="300" height="140">
                        <img class="school-promo__item-image" src="images/school/promo-friends.png" alt="с друзьями выгоднее." width="300" height="140">
                    </picture>
                </div>
                <div class="school-promo__item-wrapper">
                    <h3 class="school-promo__item-title">С друзьями веселее и&#160;выгоднее</h3>
                    <p class="school-promo__item-description">Приходите заниматься вместе с друзьями и получите скидку 10% на следующий абонимент для вас и ваших друзей</p>
                    <button class="school-promo__button button button--primary" data-name="Школа > акции > записать друга">Записать друга<span> на занятие</span></button>
                </div>
            </li>
        </ul>
    </section>
    <x-lessons-price/>
    <x-teachers/>
    @if(count($reviews) > 0)
        <section class="index-reviews">
            <h2 class="index-reviews__title second-title" id="top-reviews" >Отзывы о шахматном клубе</h2>
            <ul class="index-reviews__list">
                @foreach ($reviews as $review)
                    <li class="index-reviews__item">
                        <div class="index-reviews__video-wrapper">
                            <video class="index-reviews__video" width="740" height="430" poster="{{ $review->poster }}"
                                   preload="none">
                                <source src="{{ $review->video }}" type="video/mp4">
                            </video>
                            <button class="index-reviews__video-button video-button" type="button"><span class="visually-hidden">Смотреть отзыв</span></button>
                        </div>
                        <blockquote class="index-reviews__blockquote">{{ $review->description }}<span class="index-reviews__blockquote-ellipse"></span></blockquote>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
    <section class="gallery">
        <h2 class="gallery__title second-title">Галерея фотографий А5</h2>
        <ul class="gallery__list">
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-1.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-1-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-2.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-2-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-3.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-3-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-4.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-4-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-5.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-5-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-6.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-6-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-7.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-7-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
            <li class="gallery__item">
                <a data-fancybox="gallery" href="images/school/gallery/gallery-8.jpg">
                    <img class="gallery__image" src="images/school/gallery/gallery-8-prev.jpg" alt="детский тренер по шахматам." width="480" height="320">
                </a>
            </li>
        </ul>
    </section>
    <section class="seo-text">
        <h2 class="seo-text__title second-title">Шахматная школа</h2>
        <h3 class="seo-text__subtitle">В чем польза шахмат для детей?</h3>
        <p>Шахматы положительно влияют на умственные способности детей, а обучение в игровой форме позволяет эффективно развивать математическое мышление, восприятие пространства и навыки планирования. Ребенок учится ставить и достигать цели, анализировать ситуации с разных сторон. </p>
        <p>Известно, что у шахматистов задействуется оба полушария. Левое отвечает за логику, помогает выстроить цепочку последовательных действий и просчитать подходящие ходы. Правое полушарие отвечает за зрительное восприятие, распознает на шахматной доске знакомые комбинации на основе прошлого опыта. </p>
        <h3 class="seo-text__subtitle">Обучение в школе шахмат</h3>
        <p>С какого возраста можно начинать учиться играть в шахматы? Современные педагоги и тренеры считают, что знакомиться с базовыми правилами и расстановкой шахматных фигур можно уже с 4-5 лет. Методика обучения для самых юных шахматистов предполагает индивидуальное изучение основ классических шахмат, решение задач и последующую работу с тренером в шахматной школе. С 6 лет можно переходить к игре в быстрые шахматы (рапид). Альтернативным методом является обучение шахматам онлайн. </p>
        <p>В шахматной школе А5 дети получают теоретические и практические навыки игры и уже в течение первого года обучения принимают участие в своих первых турнирах. Обучение шахматам для начинающих строится на авторской методике с использованием разработанных материалов. В школе дети не только учатся играть, но и заводят друзей, расширяют круг общения и часто продолжают общение вне шахматной доски.</p>
        <h3 class="seo-text__subtitle">Роль тренера</h3>
        <p>Основополагающим фактором при выборе спортивной секции для ребенка является тренерский состав. Ведь именно хороший тренер может пробудить интерес к занятиям, привести к результату, мотивировать, воспитать спортивный дух, и стать не просто наставником, а быть другом для учеников. </p>
        <p>Павел Макаров – тренер и основатель Шахматной школы А5. Имеет рейтинг ФИДЕ 2111, является кандидатом в мастера спорта по шахматам, чемпионом и членом шахматной Федерации республики Карелия, имеет лицензию судьи FIDE. </p>
        <p>Обучение шахматам в Санкт-Петербурге начинается со школы А5, добро пожаловать!</p>
    </section>
    <x-request class="index-request--school"/>
</main>
@endsection

@section('modal')
    <x-modal-request/>
    <x-modal-subscribe/>
@endsection

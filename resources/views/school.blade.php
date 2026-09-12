@extends('layouts.chess')

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
    @if($schoolGoal)
        <section class="school-offline">
            <h2 class="school-offline__title second-title">{{ $schoolGoal->title }}</h2>
            <dl class="school-offline__mission determination">
                <dt class="determination__title">Цель <span class="determination__container">А5</span></dt>
                <dd class="determination__description">{{ $schoolGoal->description }}</dd>
            </dl>
            <picture class="school-offline__image-wrapper">
                <source srcset="images/school/{{$schoolGoal->image}}.webp" type="image/webp" width="1520" height="592">
                <img class="school-offline__image" src="images/school/{{$schoolGoal->image}}.jpg" alt="{{$schoolGoal->alt}}" width="1520" height="592">
            </picture>
            {!! $schoolGoal->text !!}
        </section>
    @endif

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
    @if($studentGroups->isNotEmpty())
        <section class="school-groups">
            <h2 class="school-groups__title second-title">Группы учащихся</h2>
            <p class="school-groups__description">Каждый ученик сначала приходит на пробное занятие, а затем попадает в одну из групп в зависимости от уровня своей игры. Таким образом повышая уровень игры можно переходить из одной группы в другую</p>
            <ul class="school-groups__list">
                @foreach($studentGroups as $studentGroup)
                    <li class="school-groups__item">
                        <div class="school-groups__image-wrapper">
                            <picture>
                                <source srcset="images/school/{{$studentGroup->image}}.webp" type="image/webp" width="300" height="180">
                                <img class="school-groups__image" src="images/school/{{$studentGroup->image}}.jpg" alt="{{$studentGroup->image_alt}}" width="300" height="180">
                            </picture>
                            <span class="school-groups__hint">{{$studentGroup->image_alt}}</span>
                        </div>
                        <div class="school-groups__item-container">
                            <h3 class="school-groups__item-title">{{$studentGroup->title}}</h3>
                            <ul class="school-groups__sublist">
                                @foreach($studentGroup->items as $item)
                                    <li class="school-groups__subitem">{{ $item->text }}</li>
                                @endforeach

                            </ul>
                            <a href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" rel="nofollow" class="school-groups__button button button--primary" target="_blank">Записаться в группу</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
    <section class="trial-class">
        <div class="trial-class__wrapper">
            <h2 class="trial-class__title second-title">Первый шаг к&#160;цели - бесплатный пробный урок</h2>
            <p class="trial-class__description">Познакомимся с тренером, определим уровень игры, ответим на все вопросы</p>
            <button class="trial-class__button button button--primary" data-name="Школа > пробный урок" type="button">Записаться на занятие</button>
        </div>
    </section>
    <x-main-video/>
    <x-rating type=""/>
    @if($promos->isNotEmpty())
        <section class="school-promo">
            <h2 class="school-promo__title">Акции школы шахмат А5</h2>
            <ul class="school-promo__list">
                @foreach($promos as $promo)
                    <li class="school-promo__item">
                        <div class="school-promo__image-wrapper">
                            <picture>
                                <source srcset="{{ asset('images/promos/' . $promo->image . '.webp') }}" type="image/webp" width="740" height="325">
                                <img class="school-promo__item-image" src="{{ asset('images/promos/' . $promo->image . '.png') }}" alt="{{ $promo->image_alt }}" width="740" height="325">
                            </picture>
                        </div>
                        <div class="school-promo__item-wrapper">
                            <h3 class="school-promo__item-title">{{ $promo->title }}</h3>
                            <p class="school-promo__item-description">{{ $promo->description }}</p>
                            <button class="school-promo__button button button--primary" data-name="Школа > акции > скидка после пробного">Записаться на <span>пробное </span>занятие</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
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
    @if($schoolSliders->isNotEmpty())
        <section class="gallery">
            <h2 class="gallery__title second-title">Галерея фотографий А5</h2>
            <ul class="gallery__list">
                @foreach($schoolSliders as $slider)
                    <li class="gallery__item">
                        <a data-fancybox="gallery" href="images/school/gallery/{{$slider->image_big}}.jpg">
                            <picture>
                                <source srcset="images/school/gallery/{{$slider->image}}.webp" type="image/webp" width="1200" height="574">
                                <img class="gallery__image" src="images/school/gallery/{{$slider->image}}.jpg" alt="{{$slider->image_alt}}" width="1200" height="574">
                            </picture>
                        </a>
                    </li>
                @endforeach

            </ul>
        </section>
    @endif

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

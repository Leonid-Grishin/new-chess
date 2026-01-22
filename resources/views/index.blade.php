@extends('layouts.chess')

@section('content')
<main class="page__main">
    <section class="index-intro">
        <div class="index-intro__wrapper">
            <h1 class="index-intro__first-title title title--first">Шахматный клуб&#160;<span class="index-intro__clubname-wrapper">А5</span></h1>
            <p class="index-intro__description">Делаем игру интересной и&nbsp;доступной для нового поколения современных
                детей</p>
            <button class="index-intro__primary-button button button--primary button--primary-intro" type="button" data-name="Главная > первый экран">Записаться на <span>пробное </span>занятие</button>
            <button class="index-intro__secondary-button button button--secondary button--secondary-intro" type="button" data-name="Главная > первый экран">Скачать задачник</button>
{{--            <a class="index-intro__secondary-button secondary-button secondary-button--intro" href="https://paraplancrm.ru/s/dfe59c70-6624-cbac-dd27-007f4196e10c" target="_blank" data-name="Главная > первый экран">Скачать задачник</a>--}}
            <div class="index-intro__ellipse-first ellipse ellipse--first"></div>
            <div class="index-intro__ellipse-second ellipse ellipse--second"></div>
        </div>
    </section>
    <section class="index-about">
        <div class="index-about__container">
            <h2 class="index-about__second-title second-title" id="about-school">Что такое шахматный клуб А5?</h2>
            <div class="index-about__wrapper">
                <ul class="index-about__slider">
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children.webp" media="(min-width: 1700px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children.jpg" media="(min-width: 1700px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children-desktop.jpg" media="(min-width: 1200px)" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children-mobile.jpg" width="300" height="340"
                                 alt="шахматный клуб в Санкт-Петербурге.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children2.webp" media="(min-width: 1700px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children2.jpg" media="(min-width: 1700px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children2-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children2-desktop.jpg" media="(min-width: 1200px)" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children2-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children2-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children2-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children2-mobile.jpg" width="300" height="340"
                                 alt="Шахматы, метро Пионерская.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children3.webp" media="(min-width: 1700px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children3.jpg" media="(min-width: 1700px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children3-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children3-desktop.jpg" media="(min-width: 1200px)" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children3-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children3-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children3-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children3-mobile.jpg" width="300" height="340"
                                 alt="Павел с детьми.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children4.webp" media="(min-width: 1700px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children4.jpg" media="(min-width: 1700px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children4-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children4-desktop.jpg" media="(min-width: 1200px)" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children4-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children4-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children4-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children4-mobile.jpg" width="300" height="340"
                                 alt="клуб шахмат.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children5.webp" media="(min-width: 1200px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children5.jpg" media="(min-width: 1200px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children5-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="770" height="430">
                            <source srcset="images/index-about-slider/pavel-children5-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children5-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children5-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children5-mobile.jpg" width="300" height="340"
                                 alt="довольные ученики.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children6.webp" media="(min-width: 1200px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children6.jpg" media="(min-width: 1200px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children6-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children6-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children6-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children6-mobile.jpg" width="300" height="340"
                                 alt="шахматы в СПб.">
                        </picture>
                    </li>
                    <li class="index-about__slider-item">
                        <picture>
                            <source srcset="images/index-about-slider/pavel-children7.webp" media="(min-width: 1200px)" type="image/webp" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children7.jpg" media="(min-width: 1200px)" width="780" height="430">
                            <source srcset="images/index-about-slider/pavel-children7-tablet.webp" media="(min-width: 640px)" type="image/webp" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children7-tablet.jpg" media="(min-width: 640px)" width="620" height="340">
                            <source srcset="images/index-about-slider/pavel-children7-mobile.webp" type="image/webp" width="300" height="340">
                            <img class="index-about__slider-image" src="images/index-about-slider/pavel-children7-mobile.jpg" width="300" height="340"
                                 alt="шахматные курсы.">
                        </picture>
                    </li>
                </ul>
                <div class="index-about__description">
                    <p><span>Шахматный клуб А5</span> – детский образовательный проект, где учатся и&nbsp;играют в шахматы с удовольствием.</p>
                    <p>Под руководством тренера ребята участвуют и попадают в&nbsp;призы на различных турнирах. Для определения уровня игры и&nbsp;подбора соответствующей группы проводятся пробные занятия. Разработанная методика мотивации позволяет оценить результативность ребенка.</p>
                </div>
            </div>
        </div>
        <div class="index-about__blockquote-container">
            <figure class="index-about__blockquote-wrapper blockquote">
                <blockquote class="blockquote__text">Для меня важно не только научить играть, но и&nbsp;привить интерес к&nbsp;шахматам. <br>Если&nbsp;ребенку нравится игра, то&nbsp;результаты не&nbsp;заставят себя ждать. Некоторые&nbsp;ученики&nbsp;через 3&nbsp;месяца
                    выходят на свой первый турнир!<span class="blockquote__ellipse"></span></blockquote>
                <figcaption  class="blockquote__author">Павел Макаров</figcaption>
            </figure>
        </div>
    </section>
    <x-main-video/>
    <x-lessons-price/>
    <section class="online-lessons">
        <h2 class="online-lessons__second-title second-title">Доступно онлайн обучение</h2>
        <ul class="online-lessons__list">
            <li class="online-lessons__item">Занятия проходят в программе Skype или Zoom</li>
            <li class="online-lessons__item">У каждого ученика своя студия на <a class="online-lessons__platform-link" href="https://lichess.org" target="_blank">lichess.org</a>, где ребенок может посмотреть нужную информацию в любой момент времени</li>
            <li class="online-lessons__item">Тематические упражнения, теоретическая часть</li>
            <li class="online-lessons__item">Обзор и разбор ошибок сыгранных партий в&nbsp;онлайне</li>
            <li class="online-lessons__item">Возможность совмещать индивидуальные онлайн занятия с офлайн</li>
        </ul>
        <button class="online-lessons__primary-button button button--primary" type="button" data-name="Главная > онлайн">Записаться на <span>онлайн</span> занятие</button>
    </section>
    <section class="index-camp">
        <h2 class="index-camp__title title title--second">Шахматный лагерь</h2>
        <ul class="index-camp__pictures-list">
            <li class="index-camp__picture-item">
                <picture class="index-camp__picture">
                    <source srcset="images/index-camp-1.webp" type="image/webp">
                    <img class="index-camp__image" src="images/index-camp-1.jpg" alt="сообщество молодых шахматистов." width="940" height="540">
                </picture>
            </li>
            <li class="index-camp__picture-item">
                <picture class="index-camp__picture">
                    <source srcset="images/index-camp-2.webp" type="image/webp">
                    <img class="index-camp__image" src="images/index-camp-2.jpg" alt="летние каникулы в лагере." width="940" height="540">
                </picture>
            </li>
        </ul>

        <ul class="index-camp__features-list">
            <li class="index-camp__features-item">
                <span class="index-camp__features-item-number title title--second">01</span>
                <span class="index-camp__features-item-text">Более 3 часов ежедневных занятий шахматами</span>
            </li>
            <li class="index-camp__features-item">
                <span class="index-camp__features-item-number title title--second">02</span>
                <span class="index-camp__features-item-text">Формирование навыка самодисциплины</span>
            </li>

            <li class="index-camp__features-item">
                <span class="index-camp__features-item-number title title--second">03</span>
                <span class="index-camp__features-item-text">Более 8 часов ежедневной коммуникации</span>
            </li>

            <li class="index-camp__features-item">
                <span class="index-camp__features-item-number title title--second">04</span>
                <span class="index-camp__features-item-text">Активные игры на свежем воздухе, пешие “походы”</span>
            </li>
        </ul>

        <div class="index-camp__text-wrapper">
            <p class="index-camp__text-title title title--third">А еще можно совместить 2 смены сразу!</p>
            <p class="index-camp__text-description">Интенсивы по шахматам, веселые старты, игры на свежем воздухе, активный отдых и настольные игры</p>
            <div class="index-camp__link-wrapper">
                <a class="index-camp__link button button--secondary" href="{{ route('camp') }}">Узнать подробнее</a>
            </div>

        </div>
    </section>
{{--    <section class="index-subscription">
        <div class="index-subscription__wrapper">
            <h2 class="visually-hidden">Подписка</h2>
            <span class="index-subscription__title second-title">Хотите узнать программу обучения?</span>
            <p class="index-subscription__description">Получите программу обучения. Это поможет заранее понять, что ваш ребенок будет проходить на занятиях.</p>
            <form class="index-subscription__subscription-form subscription-form request-form--subscribe" method="post" data-name="Главная > Узнать программу обучения" action="{{ route('api.subscriber') }}">

                @csrf

                <div class="subscription-form__input-wrapper subscription-form__input-wrapper--name">
                    <label class="subscription-form__label subscription-form__label--name" for="name">Ваше имя</label>
                    <input class="subscription-form__input subscription-form__input--name" type="text" name="name" id="name" placeholder="Введите ваше имя" value="" required>
                </div>
                <div class="subscription-form__input-wrapper subscription-form__input-wrapper--email">
                    <label class="subscription-form__label subscription-form__label--email" for="email">Ваш E-mail</label>
                    <input class="subscription-form__input subscription-form__input--email" type="email" name="email" id="email" placeholder="Введите ваш e-mail" value="" required>
                </div>
                <div class="subscription-form__input-wrapper subscription-form__input-wrapper--telephone">
                    <label class="subscription-form__label subscription-form__label--telephone" for="telephone">Ваш телефон</label>
                    <input class="subscription-form__input subscription-form__input--telephone" type="text" name="telephone" id="telephone" placeholder="Введите ваш телефон" value="" required>
                </div>
                <ul class="subscription-form__policy">
                    <li class="subscription-form__policy-item">
                        <label class="subscription-form__policy-control">
                            <input class="visually-hidden subscription-form__policy-control-input" type="checkbox" name="privacy" value="1" checked required>
                            <span class="subscription-form__policy-control-checkbox"></span>
                            <span class="subscription-form__policy-control-label">Заполняя форму я даю согласие на обработку персональных данных</span>
                        </label>
                    </li>
                    <li class="subscription-form__policy-item">
                        <label class="subscription-form__policy-control">
                            <input class="visually-hidden subscription-form__policy-control-input" type="checkbox" name="agreement" value="1" checked required>
                            <span class="subscription-form__policy-control-checkbox"></span>
                            <span class="subscription-form__policy-control-label">Согласен(а) на получение рассылки от&nbsp;шахматного клуба А5</span>
                        </label>
                    </li>
                </ul>
                <button class="subscription-form__button button button--secondary" type="submit" data-name="Главная > Форма подписки">Получить программу <span>обучения</span>
                </button>
                <label>
                    <input class="subscription-form__hidden-input visually-hidden" name="place" value="">
                </label>
            </form>
        </div>
    </section>--}}
    <x-book />
    <x-teachers/>
    <x-rating type="block-rating--index"/>
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
    @if(count($news) > 0)
        <section class="index-news">
            <h2 class="index-news__title second-title" id="school-news">Новости шахматного клуба</h2>
            <p class="index-news__description">Собираем всё самое интересное, что происходит с клубом: публикуем итоги
                соревнований, рассказываем о результатах выступлений команды и делимся историями о школе.</p>
            <ul class="index-news__list">
                @foreach ($news as $new)
                    <li class="index-news__item">
                        <a class="index-news__link index-news__link--{{ \App\Src\Functions::getSocialClass($new->link) }}" href="{{ $new->link }} " target="_blank">
                            <h3 class="index-news__item-title">{{ $new->title }}</h3>
{{--                            <time class="index-news__item-date" datetime="{{ $new->date }} 10:00"> {{ \App\Src\Functions::formatDateSocial($new->date) }}</time>--}}
                            <picture class="index-news__item-picture">
                                <source srcset="{{ \App\Src\Functions::jpgToWebp($new->image) }}" type="image/webp">
                                <img class="index-news__item-image" src="{{ $new->image }}" alt=" {{ $new->title }}." width="480" height="360">
                            </picture>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
    <section class="index-location">
        <h2 class="index-location__title second-title" id="contacts-where" >Адрес школы шахмат</h2>
        <h3 class="index-location__item-title">БЦ Level Up</h3>
        <address class="index-location__address">Проспект Испытателей, дом 30 корпус 2, 3 этаж
            <svg class="index-location__svg-pin" width="24" height="24">
                <use href="images/icons/sprite/sprite.svg#address-pin"></use>
            </svg>
        </address>
        <p class="index-location__telephone">телефон: <a class="index-location__telephone-link" href="tel:+79022027148">+7 (902) 202-71-48</a></p>
        <ul class="index-location__list">
            <li class="index-location__item">
{{--                <h3 class="index-location__item-title">БЦ Level Up</h3>
                <address class="index-location__address">Проспект Испытателей, дом 30 корпус 2, 3 этаж
                    <svg class="index-location__svg-pin" width="24" height="24">
                        <use href="images/icons/sprite/sprite.svg#address-pin"></use>
                    </svg>
                </address>
                <p class="index-location__telephone">телефон: <a class="index-location__telephone-link" href="tel:+79022027148">+7 (902) 202-71-48</a></p>--}}
                <picture>
                    <source srcset="images/location/levelup-desktop-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="500">
                    <source srcset="images/location/levelup-desktop-big.jpg" media="(min-width: 1700px)" width="740" height="500">
                    <source srcset="images/location/levelup-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="380">
                    <source srcset="images/location/levelup-desktop.jpg" media="(min-width: 1200px)" width="570" height="380">
                    <source srcset="images/location/levelup-tablet.webp" type="image/webp" width="620" height="410">
                    <img class="index-location__image" src="images/location/levelup-tablet.jpg" width="620" height="410"
                         alt="школа Гран.">
                </picture>
            </li>
            <li class="index-location__item">
{{--                <h3 class="index-location__item-title">ДРЦ Дар речи</h3>
                <address class="index-location__address">Переулок Лыжный, д.8 к1
                    <svg class="index-location__svg-pin" width="24" height="24">
                        <use href="images/icons/sprite/sprite.svg#address-pin"></use>
                    </svg>
                </address>
                <p class="index-location__telephone">телефон: <a class="index-location__telephone-link" href="tel:+79022027148">+7 (902) 202-71-48</a></p>--}}
                <picture>
                    <source srcset="images/location/arifmosha-desktop-big.webp" media="(min-width: 1700px)" type="image/webp" width="740" height="500">
                    <source srcset="images/location/arifmosha-desktop-big.jpg" media="(min-width: 1700px)" width="740" height="500">
                    <source srcset="images/location/arifmosha-desktop.webp" media="(min-width: 1200px)" type="image/webp" width="570" height="380">
                    <source srcset="images/location/arifmosha-desktop.jpg" media="(min-width: 1200px)" width="570" height="380">
                    <source srcset="images/location/arifmosha-tablet.webp" type="image/webp" width="620" height="410">
                    <img class="index-location__image" src="images/location/arifmosha-tablet.jpg" width="620" height="410"
                         alt="Арифмоша.">
                </picture>
            </li>
        </ul>
        <dl class="index-location__features-list">
            <div class="index-location__features-item">
                <dt class="index-location__features-title">Парковка</dt>
                <dd class="index-location__features-description">Наличие парковочных мест для автомобилей рядом со школами</dd>
            </div>
            <div class="index-location__features-item">
                <dt class="index-location__features-title">Приветливый персонал</dt>
                <dd class="index-location__features-description">Сотрудники школ помогут найти служебный кабинет</dd>
            </div>
            <div class="index-location__features-item">
                <dt class="index-location__features-title">Светлые помещения</dt>
                <dd class="index-location__features-description">Учебные классы соотвествуют требованиям</dd>
            </div>
            <div class="index-location__features-item">
                <dt class="index-location__features-title">Зона ожидания</dt>
                <dd class="index-location__features-description">В школах есть зона ожидания для родителей и детей</dd>
            </div>
        </dl>
    </section>
    <x-request />
</main>
@endsection

@section('modal')
    <x-modal-request/>
    <x-modal-subscribe/>
@endsection



<!DOCTYPE html>
<html class="page" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('styles')

    {{--<link href="@yield('styles')" rel="stylesheet">--}}
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" type="text/css" >
    <link  href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">

    <!--Иконки-->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('images/favicon/favicon-svg.svg') }}" type="image/svg+xml">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href=" {{ asset('manifest.webmanifest') }} ">

    <link rel="canonical" href="https://a5chess.ru{{ Route::currentRouteName() == 'index' ? '' : '/'.Route::currentRouteName() }}"/>

    <!--Шрифты-->
    <link rel="preload" href="{{ asset('fonts/gotham-pro/gotham-pro-bold-700.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/gotham-pro/gotham-pro-medium-500.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-bold-700.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-semi-bold-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-medium-500.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-regular-400.woff2') }}" as="font" type="font/woff2" crossorigin>

    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">

    <meta property="og:title" content="{{ $meta['title'] }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:url" content="https://a5chess.ru">
    <meta property="og:image" content="https://a5chess.ru/{{ $meta['og-image'] }}">
    <meta property="og:image:width" content="780">
    <meta property="og:image:height" content="430">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="A5 Chess Club">
    <meta property="og:type" content="website">

</head>
<body class="page__body">
<header class="main-header {{  (\Illuminate\Support\Facades\Route::currentRouteName() !== 'index' && \Illuminate\Support\Facades\Route::currentRouteName() !== null) ? 'main-header--light' : '' }}">
    <div class="main-header__container">
        <nav class="main-header__navigation navigation">
            <a class="navigation__telephone-button telephone-button" href="tel:+79022027148">
                <svg class="telephone-button__image" width="24" height="24">
                    <use href="{{ asset('images/icons/sprite/sprite.svg#telephone') }}"></use>
                </svg>
                <span class="visually-hidden">Позвонить.</span>
            </a>
            <a class="navigation__logo logo" href="{{ route('index') }}">
                <svg class="logo__image {{  (\Illuminate\Support\Facades\Route::currentRouteName() !== 'index' && \Illuminate\Support\Facades\Route::currentRouteName() !== null) ? 'logo__image--dark' : '' }}" width="97" height="47">
                    <use href=" {{ asset('images/icons/sprite/sprite.svg#logo') }}"></use>
                </svg>
            </a>
            <ul class="navigation__menu">
                <li class="navigation__menu-item {{  (\Illuminate\Support\Facades\Route::currentRouteName() === 'index' || \Illuminate\Support\Facades\Route::currentRouteName() === null) ? 'navigation__menu-item--current' : '' }}">
                    <a class="navigation__menu-link" href="{{ route('index') }}"><span>Клуб</span></a>
                </li>
                <li class="navigation__menu-item {{  (\Illuminate\Support\Facades\Route::currentRouteName() === 'school') ? 'navigation__menu-item--current' : '' }}">
                    <a class="navigation__menu-link" href="{{ route('school') }}"><span>Школа</span></a>
                </li>
                <li class="navigation__menu-item">
                    <a class="navigation__menu-link" href="{{ route('index') }}#coach "><span>Тренера</span></a>
                </li>
                <li class="navigation__menu-item">
                    <a class="navigation__menu-link" href="{{ route('index') }}#students-rating "><span>Рейтинг</span></a>
                </li>
                <li class="navigation__menu-item">
                    <a class="navigation__menu-link" href="{{ route('index') }}#top-reviews "><span>Отзывы</span></a>
                </li>
                <li class="navigation__menu-item {{  (\Illuminate\Support\Facades\Route::currentRouteName() === 'camp') ? 'navigation__menu-item--current' : '' }}">
                    <a class="navigation__menu-link" href="{{ route('camp') }}"><span>Летний лагерь</span></a>
                </li>
                <li class="navigation__menu-item">
                    <a class="navigation__menu-link" href="{{ route('index') }}#contacts-where"><span>Контакты</span></a>
                </li>
            </ul>
            <dl class="navigation__addresses">
                <dt class="navigation__address-name">БЦ "Level Up"</dt>
                <dd class="navigation__address-wrapper">
                    <address class="navigation__address">Проспект Испытателей, <br>д. 30 корпус 2, 3 этаж
                        <svg class="navigation__address-svg-pin" width="24" height="24">
                            <use href=" {{ asset('images/icons/sprite/sprite.svg#address-pin') }}"></use>
                        </svg>
                    </address>
                </dd>
            </dl>
            <ul class="navigation__contacts">
                <li class="navigation__contacts-item navigation__contacts-item--telephone">
                    <a class="navigation__telephone telephone" href="tel:+79022027148">+7 (902) 202-71-48</a>
                </li>
                <li class="navigation__contacts-item navigation__contacts-item--addresses">
                    <button class="navigation__address-button address-button" type="button">
                        <span class="visually-hidden">адреса школы.</span>
                        <img class="address-button__svg-pin" width="24" height="24" src="{{ asset('images/icons/address-pin.svg') }}" alt="адреса школы">
{{--                        <svg class="address-button__svg-pin" width="24" height="24">
                            <use href=" {{ asset('images/icons/sprite/sprite.svg#address-pin') }} "></use>
                        </svg>--}}
                        <span class="address-button__text">пр. Испытателей 30, к.2</span>
                        <svg class="address-button__svg-arrow" width="24" height="25">
                            <use href="{{ asset('images/icons/sprite/sprite.svg#arrow-down') }} "></use>
                        </svg>
                    </button>
                </li>
            </ul>
            <button class="navigation__hamburger-menu hamburger-menu" id="hamburger-menu" type="button">
                <span class="visually-hidden">Вызов меню.</span>
                <span class="hamburger-menu__line hamburger-menu__line--first"></span>
                <span class="hamburger-menu__line hamburger-menu__line--second"></span>
                <span class="hamburger-menu__line hamburger-menu__line--third"></span>
                <span class="hamburger-menu__line hamburger-menu__line--fourth"></span>
            </button>
        </nav>
        <div class="main-header__ellipse ellipse ellipse--middle"></div>
    </div>
</header>
    @yield('content')
<div class="policy-popup" style="display: none">
    <button class="policy-popup__button-close" type="button">Принять</button>
    <a class="download" href="https://a5chess.ru/pdf/personal-data.pdf" target="_blank">Узнать подробнее</a>
    <p>Этот сайт использует файлы cookie и метаданные. Продолжая просматривать его, вы соглашаетесь на использование нами файлов cookie и метаданных в соответствии с Политикой конфиденциальности.</p>
</div>
<footer class="footer">
    <div class="footer__wrapper">
        <div class="footer__social">
            <ul class="footer__social-list">
                <li class="footer__social-item">
                    <a href="https://vk.com/a5chess" class="footer__social-link" target="_blank">
                        <svg class="footer__social-icon" width="24" height="24">
                            <use href="{{ asset('images/icons/sprite/sprite.svg#vk-icon') }}"></use>
                        </svg>
                        <span class="visually-hidden">Vkontakte.</span>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="https://t.me/a5chess" class="footer__social-link" target="_blank">
                        <svg class="footer__social-icon" width="24" height="24">
                            <use href="{{ asset('images/icons/sprite/sprite.svg#telegram-icon') }}"></use>
                        </svg>
                        <span class="visually-hidden">Telegram.</span>
                    </a>
                </li>
                <li class="footer__social-item">
                    <a href="https://www.youtube.com/channel/UCIynB-_wplU5zbWVVtXyyXw" class="footer__social-link" target="_blank">
                        <svg class="footer__social-icon" width="24" height="24">
                            <use href="{{ asset('images/icons/sprite/sprite.svg#youtube-icon') }}"></use>
                        </svg>
                        <span class="visually-hidden">Youtube.</span>
                    </a>
                </li>
            </ul>
        </div>
        <a class="footer__logo logo" href="{{ route('index') }}">
            <svg class="logo__image" width="103" height="54">
                <use href="{{asset('images/icons/sprite/sprite.svg#logo')}}"></use>
            </svg>
        </a>
        <ul class="footer__menu-list">
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('index') }}">Клуб</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('school') }}">Школа</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="#coach">Тренера</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('index') }}#students-rating">Рейтинг</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('index') }}#top-reviews">Отзывы</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('camp') }}">Летний лагерь</a>
            </li>
            <li class="footer__menu-item">
                <a class="footer__menu-link" href="{{ route('index') }}#contacts-where">Контакты</a>
            </li>
        </ul>
        <div class="footer__navigation-address">
            <p class="footer__navigation-address-title">Адрес школы в СПб:</p>
            <ul class="footer__navigation-address-list">
                <li class="footer__navigation-address-item">
                    <address class="footer__address">БЦ ”Level Up”: Проспект Испытателей, 30 к2, 3 этаж</address>
                </li>
{{--                <li class="footer__navigation-address-item">
                    <address class="footer__address">Детский центр “Дар Речи”: Переулок Лыжный, д.8 к1</address>
                </li>--}}
            </ul>
        </div>
        <a class="footer__telephone" href="tel:+79022027148">+7 (902) 202-71-48</a>
        <ul class="footer__user-navigation">
            <li class="footer__user-navigation-item">
                <a class="footer__user-navigation-link" href="{{ asset('pdf/offer.pdf') }}" target="_blank">Договор – офферта</a>
            </li>
            <li class="footer__user-navigation-item">
                <a class="footer__user-navigation-link" href="{{ asset('pdf/private-policy.pdf') }}" target="_blank">Политика конфиденциальности</a>
            </li>
            <li class="footer__user-navigation-item">
                <a class="footer__user-navigation-link" href="{{ asset('pdf/personal-data.pdf') }}" target="_blank">Политика персональных данных</a>
            </li>
        </ul>
    </div>
    <div class="footer__copyright">2022 - @php echo(date('Y')) @endphp &#169; Шахматный клуб А5. Все права защищены. <a class="footer__studio-link" href="https://rouks.ru">Сайт разработан в студии «Rouks»</a></div>
</footer>
    @yield('modal')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
@vite('resources/js/main.js')
<x-counters />

<!-- schema.org Begin -->
<script type='application/ld+json'>
  {
    "@context": "http://www.schema.org",
    "@type": "Organization",
    "name": "Шахматный клуб А5",
    "url": "https://a5chess.ru",
    "logo": "https://a5chess.ru/images/logo.svg",
    "image": "https://a5chess.ru/images/logo.svg",
    "description": "Шахматный клуб “А5” – детский образовательный проект, где дети учатся и играют в шахматы с удовольствием. Мы ведем онлайн занятия и обучения в классах для любого уровня подготовки.",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Санкт-Петербург, ул. Гаккелевская, д.19",
      "addressLocality": "Санкт-Петербург",
      "addressRegion": "Санкт-Петербург",
      "postalCode": "197227",
      "addressCountry": "Россия"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+7 (902) 202-71-48",
      "contactType": "general"
    }
  }
</script>
<!-- schema.org End -->
</body>
</html>

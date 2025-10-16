<!DOCTYPE html>
<html class="page" lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!--Иконки-->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('images/favicon/favicon-svg.svg') }}" type="image/svg+xml">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href=" {{ asset('manifest.webmanifest') }} ">
    <!--Шрифты-->
    <link rel="preload" href="{{ asset('fonts/gotham-pro/gotham-pro-bold-700.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/gotham-pro/gotham-pro-medium-500.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-bold-700.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-semi-bold-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-medium-500.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/montserrat/montserrat-regular-400.woff2') }}" as="font" type="font/woff2" crossorigin>

    <title>@yield('title')</title>
</head>
<body>
    {{--<header></header>--}}

    @yield('content')

    {{--<footer></footer>--}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

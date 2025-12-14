@extends('layouts.chess')

@push('styles')
    {{--@vite('resources/sass/page-styles/404.scss')--}}
    <link rel="preload" as="style" href="https://a5chess.ru/build/assets/404-DWt-ArC2.css" />
    <link rel="stylesheet" href="https://a5chess.ru/build/assets/404-DWt-ArC2.css" />
@endpush
@section('title', 'Ошибка, такой страницы не существует')

@section('content')
<main class="page__main">
    <div class="error-404">
        <h1 class="visually-hidden">Ошибка 404</h1>
        <section class="error-404__section">
            <h2 class="visually-hidden">Такой страницы не существует</h2>
            <p class="error-404__title">Упс....пат!</p>
            <p class="error-404__description">Такой страницы не существует</p>
        </section>
    </div>
</main>
@endsection

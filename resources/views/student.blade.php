@extends('layouts.chess')

@section('title', $student->name)

@section('styles', asset('css/main.min.css'))

@section('content')
    <p>Студент {{ $student->name }} рейтинг {{ $student->rating_rapid }}</p>
@endsection

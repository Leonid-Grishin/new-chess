@extends('layouts.admin')
@section('title', 'Просмотр профиля ученика')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.students') }}">Все Ученики</a></li>
        <li class="breadcrumb-item active" aria-current="page">Просмотр профиля ученика</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Профиль ученика: {{ $student->name }}</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row align-items-center">
                <img class="col-md-1" src="{{ asset($student->photo) }}" alt="">
                <p class="col-md-3">{{ $student->name }} <br> Дата рождения: {{ $student->birth_date }} <br> ФШР-ID: {{ $student->fshr_id }}</p>
                <p class="col-md-8">{{ $student->description }}</p>
            </div>
            <div class="row mt-5 text-center">
                @if($student->rating_classic)
                    <p class="col-md-4">Рейтинг по Классике: {{ $student->rating_classic }}
                        @if($student->rating_classic_change_class === 'up')
                            (Вырос на {{ $student->rating_classic_change }} пунктов)
                        @elseif($student->rating_classic_change_class === 'down')
                            (Уменьшился на {{ $student->rating_classic_change }} пунктов)
                        @else
                            (Не изменился)
                        @endif
                    </p>
                @else
                    <p class="col-md-4">Рейтинга по Классике пока нет</p>
                @endif
                @if($student->rating_rapid)
                    <p class="col-md-4">Рейтинг по Рапиду: {{ $student->rating_rapid }}
                        @if($student->rating_rapid_change_class === 'up')
                            (Вырос на {{ $student->rating_rapid_change }} пунктов)
                        @elseif($student->rating_rapid_change_class === 'down')
                            (Уменьшился {{ $student->rating_rapid_change }} пунктов)
                        @else
                            (Не изменился)
                        @endif
                    </p>
                @else
                    <p class="col-md-4">Рейтинга по Рапиду пока нет</p>
                @endif
                @if($student->rating_blitz)
                    <p class="col-md-4">Рейтинг по Блицу: {{ $student->rating_blitz }}
                        @if($student->rating_blitz_change_class === 'up')
                            (Вырос на {{ $student->rating_blitz_change }} пунктов)
                        @elseif($student->rating_blitz_change_class === 'down')
                            (Уменьшился на {{ $student->rating_blitz_change }} пунктов)
                        @else
                            (Не изменился)
                        @endif
                    </p>
                @else
                    <p class="col-md-4">Рейтинга по Блицу пока нет</p>
                @endif
                <p class="col-md-4">Родитель: {{ $student->parent ?: 'Не указано' }}</p>
                <p class="col-md-4">Телефон: {{ $student->telephone ?: 'Не указан' }}</p>
                <p class="col-md-4">Почта: {{ $student->email ?: 'Не указан' }}</p>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


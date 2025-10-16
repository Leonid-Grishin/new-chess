@extends('layouts.admin')
@section('title', 'Просмотр новости')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">Все Новости</a></li>
        <li class="breadcrumb-item active" aria-current="page">Просмотр новости</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">{{ $new->title }}</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <img class="col-md-4 mx-auto" src="{{ asset($new->image) }}" alt="">
            </div>
            <p class="col-md-4 mt-3 mx-auto text-center">Дата: {{ $new->date }}</p>
            <a class="d-block col-md-4 mx-auto text-center" href="{{ $new->link }}">{{ $new->link }}</a>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


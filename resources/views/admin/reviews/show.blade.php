@extends('layouts.admin')
@section('title', 'Просмотр отзыва')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.reviews') }}">Все Отзывы</a></li>
        <li class="breadcrumb-item active" aria-current="page">Просмотр отзыва</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Отзыв от {{ $review->created_at }}</h1>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <video class="col-md-4 mx-auto" width="740" poster="{{ asset($review->poster) }}"
                       preload="none" controls>
                    <source src="{{ asset($review->video) }}" type="video/mp4">
                </video>
            </div>
            <p class="col-md-4 h2 mt-3 mx-auto">{{ $review->name }}</p>
            <p class="col-md-4 mx-auto">"{{ $review->description }}"</p>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


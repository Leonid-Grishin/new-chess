@extends('layouts.admin')
@section('title', 'Редактирование отзыва')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.reviews') }}">Все Отзывы</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование Отзыва</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Редактирование отзыва</h1>
            </div>
        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.reviews.update', ['review' => $review->id]) }}">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <div class="mb-2"><b>Изображение для видео, 740х430, jpg</b></div>
                    <img class="mb-2 mr-3" src="{{ asset($review->poster) }}" alt="Обложка" width="200" id="uploadedImage">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('poster') is-invalid @enderror" id="inputImage" name="poster">
                        <label class="custom-file-label" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                        @error('poster')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-2"><b>Видео, mp4</b></div>
                    <video class="mr-3" src="{{ asset($review->video) }}" controls  width="340" id="uploadedVideo"></video>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('video') is-invalid @enderror" id="inputVideo" name="video">
                        <label class="custom-file-label" for="inputVideo" data-browse="Выбрать">Выберите видео</label>
                        @error('video')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName">Имя</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" placeholder="Добавьте имя" value="{{ $review->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Описание</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description" placeholder="Добавьте краткую суть отзыва" rows="3">{{ $review->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Сохранить</button>
            </div>
        </form>
    </section>
@endsection

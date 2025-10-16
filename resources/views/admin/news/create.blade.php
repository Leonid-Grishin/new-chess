@extends('layouts.admin')
@section('title', 'Добавление новости')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">Все Новости</a></li>
        <li class="breadcrumb-item active" aria-current="page">Добавление Новости</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Добавление новости</h1>
            </div>
        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.news.store') }}">

            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="inputDate">Дата</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDate" name="date" value="{{ old('date') }}">
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputTitle">Заголовок</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputTitle" placeholder="Заголовок" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputLink">Ссылка</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="inputLink" name="link" placeholder="Ссылка" value="{{ old('link') }}">
                    @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="mb-2"><b>Изображение, 480х360 jpg</b></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputImage" name="image">
                        <label class="custom-file-label" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img class="mt-3" id="uploadedImage" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Сохранить</button>
            </div>
        </form>
    </section>
@endsection

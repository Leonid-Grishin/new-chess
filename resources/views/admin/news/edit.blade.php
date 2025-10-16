@extends('layouts.admin')
@section('title', "Редактирование новости")

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">Все Новости</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование новости</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Редактирование новости: "{{ $new->title }}"</h1>
            </div>
        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.news.update', ['news' => $new->id]) }}">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="inputDate">Дата</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDate" name="date" value="{{ $new->date }}">
                    @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputTitle">Заголовок</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputTitle" placeholder="Заголовок" value="{{ $new->title }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputLink">Ссылка</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="inputLink" name="link" placeholder="Ссылка" value="{{ $new->link }}">
                    @error('link')
                    <div class="invalid-feedback">{{ $new->link }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <img id="uploadedImage" class="mt-4 mb-3 mr-3" src="{{ asset($new->image) }}" alt="{{ $new->title }}" width="240">
                    <div>Изображение, 480х360 jpg</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputImage" name="image">
                        <label class="custom-file-label" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Сохранить</button>
            </div>
        </form>
    </section>
@endsection

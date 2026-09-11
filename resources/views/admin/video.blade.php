@extends('layouts.admin')

@section('title', 'Админка - Видео')

@section('content')
    <section class="content-header">

        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">
                    Редактирование видео
                </h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-3">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mx-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="bg-warning mt-4 text-center p-3">
            Видео-блок
        </h2>

        <form method="POST"
              action="{{ route('admin.video.update') }}"
              enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <div class="card-body">
                <div class="row">

                    {{-- Poster --}}
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="videoPoster">
                                <b>Новое изображение-превью</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="poster"
                                   id="videoPoster"
                                   accept="image/jpeg,image/png,image/webp">

                            <small class="form-text text-muted">
                                Форматы: JPG, 1280px * 538px.
                                Максимальный размер — 5 МБ.
                            </small>

                            @if($currentPoster)
                                <div class="mt-4">
                                    <b>Текущее изображение:</b>

                                    <img src="{{ $currentPoster }}"
                                         alt="Текущий poster видео"
                                         class="d-block mt-2 border"
                                         style="
                                            width: 320px;
                                            max-width: 100%;
                                            max-height: 220px;
                                            object-fit: cover;
                                         ">
                                </div>
                            @else
                                <p class="text-muted mt-3">
                                    Изображение-превью ещё не загружено.
                                </p>
                            @endif

                            <div class="mt-4">
                                <b>Предпросмотр нового изображения:</b>

                                <img id="videoPosterPreview"
                                     src=""
                                     alt="Предпросмотр poster"
                                     class="mt-2 d-none border"
                                     style="
                                        width: 320px;
                                        max-width: 100%;
                                        max-height: 220px;
                                        object-fit: cover;
                                     ">
                            </div>

                        </div>
                    </div>

                    {{-- Основное видео --}}
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="videoFile">
                                <b>Новое основное видео</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="video"
                                   id="videoFile"
                                   accept="video/mp4,video/webm,video/ogg">

                            <small class="form-text text-muted">
                                Форматы: MP4.
                            </small>

                            @if($currentVideo)
                                <div class="mt-4">
                                    <b>Текущее основное видео:</b>

                                    <video controls
                                           preload="metadata"
                                           class="d-block mt-2 border"
                                           style="
                                                width: 500px;
                                                max-width: 100%;
                                           ">
                                        <source src="{{ $currentVideo }}">

                                        Ваш браузер не поддерживает
                                        воспроизведение видео.
                                    </video>

                                    <small class="text-muted">
                                        Файл:
                                        {{ basename(parse_url($currentVideo, PHP_URL_PATH)) }}
                                    </small>
                                </div>
                            @else
                                <p class="text-muted mt-3">
                                    Основное видео ещё не загружено.
                                </p>
                            @endif

                            <div class="mt-4">
                                <b>Предпросмотр нового видео:</b>

                                <video id="videoFilePreview"
                                       controls
                                       preload="metadata"
                                       class="mt-2 d-none border"
                                       style="
                                            width: 500px;
                                            max-width: 100%;
                                       ">
                                </video>
                            </div>

                        </div>
                    </div>

                    {{-- Видео-превью --}}
                    <div class="col-md-6 mt-4">
                        <div class="form-group">

                            <label for="videoPrevFile">
                                <b>Новое видео-превью</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="video_prev"
                                   id="videoPrevFile"
                                   accept="video/mp4,video/webm,video/ogg">

                            <small class="form-text text-muted">
                                Используется как preview-видео.
                                Форматы: MP4, 1520px * 640px.
                            </small>

                            @if($currentVideoPreview)
                                <div class="mt-4">
                                    <b>Текущее видео-превью:</b>

                                    <video controls
                                           muted
                                           preload="metadata"
                                           class="d-block mt-2 border"
                                           style="
                                                width: 500px;
                                                max-width: 100%;
                                           ">
                                        <source src="{{ $currentVideoPreview }}">

                                        Ваш браузер не поддерживает
                                        воспроизведение видео.
                                    </video>

                                    <small class="text-muted">
                                        Файл:
                                        {{ basename(parse_url($currentVideoPreview, PHP_URL_PATH)) }}
                                    </small>
                                </div>
                            @else
                                <p class="text-muted mt-3">
                                    Видео-превью ещё не загружено.
                                </p>
                            @endif

                            <div class="mt-4">
                                <b>Предпросмотр нового видео-превью:</b>

                                <video id="videoPrevFilePreview"
                                       controls
                                       muted
                                       preload="metadata"
                                       class="mt-2 d-none border"
                                       style="
                                            width: 500px;
                                            max-width: 100%;
                                       ">
                                </video>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit"
                        class="btn btn-success">
                    Сохранить изменения
                </button>
            </div>

        </form>

    </section>
@endsection

@push('scripts')
    <script>
      const posterInput = document.getElementById('videoPoster');
      const posterPreview = document.getElementById('videoPosterPreview');

      if (posterInput) {
        posterInput.addEventListener('change', function () {
          const file = this.files[0];

          if (file) {
            posterPreview.src = URL.createObjectURL(file);
            posterPreview.classList.remove('d-none');
          }
        });
      }

      const videoInput = document.getElementById('videoFile');
      const videoPreview = document.getElementById('videoFilePreview');

      if (videoInput) {
        videoInput.addEventListener('change', function () {
          const file = this.files[0];

          if (file) {
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.classList.remove('d-none');
            videoPreview.load();
          }
        });
      }

      const videoPrevInput = document.getElementById('videoPrevFile');
      const videoPrevPreview =
        document.getElementById('videoPrevFilePreview');

      if (videoPrevInput) {
        videoPrevInput.addEventListener('change', function () {
          const file = this.files[0];

          if (file) {
            videoPrevPreview.src = URL.createObjectURL(file);
            videoPrevPreview.classList.remove('d-none');
            videoPrevPreview.load();
          }
        });
      }
    </script>
@endpush

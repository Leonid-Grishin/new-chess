@extends('layouts.admin')

@section('title', 'Админка - Клуб')

@section('content')
    <section class="content-header">

        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Страница «Клуб»</h1>
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

        {{-- ============================================================
             Добавление слайда
        ============================================================= --}}
        <h2 class="bg-warning mt-5 text-center p-3">
            Слайдер — Добавить фото
        </h2>

        <form method="POST"
              action="{{ route('admin.club.slider.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row mt-3">

                    <div class="form-group col-md-4">
                        <label for="newSlideImage">
                            <b>Изображение</b>
                        </label>

                        <div class="custom-file">
                            <input type="file"
                                   class="custom-file-input"
                                   name="image"
                                   id="newSlideImage"
                                   accept="image/jpeg,image/png,image/webp">

                            <label class="custom-file-label"
                                   for="newSlideImage"
                                   data-browse="Выбрать">
                                Выберите изображение
                            </label>
                        </div>

                        <small class="form-text text-muted">
                            Рекомендуемый размер: 780 × 430 px.
                        </small>

                        <img id="newSlidePreview"
                             class="mt-3 d-none border"
                             src=""
                             alt="Предпросмотр нового слайда"
                             width="240">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="slideAlt">
                            <b>Alt-текст</b>
                        </label>

                        <input type="text"
                               class="form-control"
                               name="alt"
                               id="slideAlt"
                               placeholder="Описание фото для SEO">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="slideSort">
                            <b>Сортировка</b>
                        </label>

                        <input type="number"
                               class="form-control"
                               name="sort"
                               id="slideSort"
                               value="0">
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    Добавить слайд
                </button>
            </div>
        </form>


        {{-- ============================================================
             Текущие слайды
        ============================================================= --}}
        <h2 class="bg-warning mt-5 text-center p-3">
            Слайдер — Текущие фото ({{ $slides->count() }})
        </h2>

        @if($slides->isEmpty())
            <p class="text-center text-muted mt-3">
                Слайдов пока нет.
            </p>
        @else
            @foreach($slides as $slide)

                <div class="row mt-4 align-items-start">

                    <div class="form-group col-md-4">
                        <div class="mb-2">
                            <b>Фото</b>
                        </div>

                        <img src="{{ asset('images/club/slider/' . $slide->filename . '.jpg') }}"
                             alt="{{ $slide->alt }}"
                             width="240"
                             class="d-block border">

                        <small class="text-muted">
                            {{ $slide->filename }}
                        </small>
                    </div>

                    <div class="col-md-5">
                        <form method="POST"
                              action="{{ route('admin.club.slider.update', $slide->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="alt_{{ $slide->id }}">
                                    <b>Alt-текст</b>
                                </label>

                                <input type="text"
                                       class="form-control"
                                       name="alt"
                                       id="alt_{{ $slide->id }}"
                                       value="{{ $slide->alt }}">
                            </div>

                            <div class="form-group">
                                <label for="sort_{{ $slide->id }}">
                                    <b>Сортировка</b>
                                </label>

                                <input type="number"
                                       class="form-control"
                                       name="sort"
                                       id="sort_{{ $slide->id }}"
                                       value="{{ $slide->sort }}">
                            </div>

                            <div class="custom-control custom-switch mb-3">
                                <input type="hidden"
                                       name="is_active"
                                       value="0">

                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="active_{{ $slide->id }}"
                                       name="is_active"
                                       value="1"
                                        {{ $slide->is_active ? 'checked' : '' }}>

                                <label class="custom-control-label"
                                       for="active_{{ $slide->id }}">
                                    Активен
                                </label>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary btn-sm">
                                Сохранить
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('admin.club.slider.destroy', $slide->id) }}"
                              class="mt-3"
                              onsubmit="return confirm('Удалить слайд?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Удалить слайд
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-4">

            @endforeach
        @endif


        {{-- ============================================================
             Поиск фактически сохранённых файлов
        ============================================================= --}}
        @php
            $currentPoster = null;

            foreach (['jpg', 'jpeg', 'png', 'webp'] as $extension) {
                $posterFile = public_path('video/poster.' . $extension);

                if (file_exists($posterFile)) {
                    $currentPoster = asset('video/poster.' . $extension);
                    break;
                }
            }

            $currentVideo = null;

            foreach (['mp4', 'webm', 'ogg'] as $extension) {
                $videoFile = public_path('video/video.' . $extension);

                if (file_exists($videoFile)) {
                    $currentVideo = asset('video/video.' . $extension);
                    break;
                }
            }

            $currentVideoPreview = null;

            foreach (['mp4', 'webm', 'ogg'] as $extension) {
                $videoPreviewFile = public_path('video/video-prev.' . $extension);

                if (file_exists($videoPreviewFile)) {
                    $currentVideoPreview = asset(
                        'video/video-prev.' . $extension
                    );

                    break;
                }
            }
        @endphp


        {{-- ============================================================
             Видео-блок
        ============================================================= --}}
        <h2 class="bg-warning mt-5 text-center p-3">
            Видео-блок
        </h2>

        <form method="POST"
              action="{{ route('admin.club.video.update') }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card-body">
                <div class="row">

                    {{-- =================================================
                         Poster
                    ================================================== --}}
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="clubVideoPoster">
                                <b>Новое изображение-превью</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="poster"
                                   id="clubVideoPoster"
                                   accept="image/jpeg,image/png,image/webp">

                            <small class="form-text text-muted">
                                Форматы: JPG, PNG, WEBP.
                                Максимальный размер — 5 МБ.
                            </small>

                            @if($currentPoster)
                                <div class="mt-4">
                                    <b>Фактически размещённое изображение:</b>

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
                                <b>Предпросмотр выбранного файла:</b>

                                <img id="clubVideoPosterPreview"
                                     src=""
                                     alt="Предпросмотр выбранного poster"
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


                    {{-- =================================================
                         Основное видео
                    ================================================== --}}
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="clubVideoFile">
                                <b>Новое основное видео</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="video"
                                   id="clubVideoFile"
                                   accept="video/mp4,video/webm,video/ogg">

                            <small class="form-text text-muted">
                                Форматы: MP4, WEBM, OGG.
                                Ограничение Laravel по размеру не задано.
                            </small>

                            @if($currentVideo)
                                <div class="mt-4">
                                    <b>Фактически размещённое основное видео:</b>

                                    <video controls
                                           preload="metadata"
                                           class="d-block mt-2 border"
                                           style="
                                           width: 500px;
                                           max-width: 100%;
                                       ">
                                        <source src="{{ $currentVideo }}">
                                        Ваш браузер не поддерживает воспроизведение видео.
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
                                <b>Предпросмотр выбранного файла:</b>

                                <video id="clubVideoPreview"
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


                    {{-- =================================================
                         Видео-превью
                    ================================================== --}}
                    <div class="col-md-6 mt-4">
                        <div class="form-group">

                            <label for="clubVideoPrevFile">
                                <b>Новое видео-превью</b>
                            </label>

                            <input type="file"
                                   class="form-control-file"
                                   name="video_prev"
                                   id="clubVideoPrevFile"
                                   accept="video/mp4,video/webm,video/ogg">

                            <small class="form-text text-muted">
                                Используется как preview-видео.
                                Форматы: MP4, WEBM, OGG.
                                Ограничение Laravel по размеру не задано.
                            </small>

                            @if($currentVideoPreview)
                                <div class="mt-4">
                                    <b>Фактически размещённое видео-превью:</b>

                                    <video controls
                                           muted
                                           preload="metadata"
                                           class="d-block mt-2 border"
                                           style="
                                           width: 500px;
                                           max-width: 100%;
                                       ">
                                        <source src="{{ $currentVideoPreview }}">
                                        Ваш браузер не поддерживает воспроизведение видео.
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
                                <b>Предпросмотр выбранного файла:</b>

                                <video id="clubVideoPrevPreview"
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
                    Сохранить видео-блок
                </button>
            </div>
        </form>

    </section>
@endsection


@push('scripts')
    <script>
      /*
      |--------------------------------------------------------------------------
      | Предпросмотр нового слайда
      |--------------------------------------------------------------------------
      */

      const slideImageInput = document.getElementById('newSlideImage');

      if (slideImageInput) {
        slideImageInput.addEventListener('change', function () {
          const preview = document.getElementById('newSlidePreview');
          const file = this.files[0];

          if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
          }
        });
      }


      /*
      |--------------------------------------------------------------------------
      | Предпросмотр нового poster
      |--------------------------------------------------------------------------
      */

      const posterInput = document.getElementById('clubVideoPoster');

      if (posterInput) {
        posterInput.addEventListener('change', function () {
          const preview = document.getElementById(
            'clubVideoPosterPreview'
          );

          const file = this.files[0];

          if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
          }
        });
      }


      /*
      |--------------------------------------------------------------------------
      | Предпросмотр нового основного видео
      |--------------------------------------------------------------------------
      */

      const videoInput = document.getElementById('clubVideoFile');

      if (videoInput) {
        videoInput.addEventListener('change', function () {
          const preview = document.getElementById('clubVideoPreview');
          const file = this.files[0];

          if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            preview.load();
          }
        });
      }


      /*
      |--------------------------------------------------------------------------
      | Предпросмотр нового video-prev
      |--------------------------------------------------------------------------
      */

      const videoPrevInput = document.getElementById('clubVideoPrevFile');

      if (videoPrevInput) {
        videoPrevInput.addEventListener('change', function () {
          const preview = document.getElementById(
            'clubVideoPrevPreview'
          );

          const file = this.files[0];

          if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            preview.load();
          }
        });
      }
    </script>
@endpush

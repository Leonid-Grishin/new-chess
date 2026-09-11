@extends('layouts.admin')

@section('title', 'Админка - Клуб')

@section('content')
    <section class="content-header">

        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">
                    Страница «Клуб»
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
                <button type="submit"
                        class="btn btn-success">
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

    </section>
@endsection

@push('scripts')
    <script>
      const slideImageInput =
        document.getElementById('newSlideImage');

      if (slideImageInput) {
        slideImageInput.addEventListener('change', function () {
          const preview =
            document.getElementById('newSlidePreview');

          const file = this.files[0];

          if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
          }
        });
      }
    </script>
@endpush

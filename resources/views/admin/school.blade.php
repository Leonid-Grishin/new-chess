@extends('layouts.admin')

@section('title', 'Админка - Школа')

@section('content')

    <section class="content-header">

        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">
                    Страница «Школа»
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
             Промо-блоки
        ============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Промо-блоки
        </h2>

        {{-- Добавление нового промо-блока --}}

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">
                    Добавить промо-блок
                </h3>
            </div>

            <form method="POST"
                  action="{{ route('admin.school.promo.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="new_promo_image">
                                <b>Изображение</b>
                            </label>

                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input"
                                       id="new_promo_image"
                                       name="image"
                                       accept="image/jpeg,image/png,image/webp">

                                <label class="custom-file-label"
                                       for="new_promo_image"
                                       data-browse="Выбрать">
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Рекомендуемый формат: PNG, 740px * 325 (если нужно чтобы торчало за рамки) или 740px * 280px в рамках.
                            </small>

                            <img id="new_promo_preview"
                                 src=""
                                 alt="Предпросмотр"
                                 width="240"
                                 class="d-none mt-3 border">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="new_promo_image_alt">
                                <b>Alt изображения</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="new_promo_image_alt"
                                   name="image_alt"
                                   value="{{ old('image_alt') }}"
                                   placeholder="Описание изображения">
                        </div>

                        <div class="form-group col-md-8">
                            <label for="new_promo_title">
                                <b>Заголовок</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="new_promo_title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Заголовок промо-блока"
                                   required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="new_promo_sort_order">
                                <b>Сортировка</b>
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="new_promo_sort_order"
                                   name="sort_order"
                                   value="{{ old('sort_order', 0) }}"
                                   min="0">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="new_promo_description">
                                <b>Описание</b>
                            </label>

                            <textarea class="form-control"
                                      id="new_promo_description"
                                      name="description"
                                      rows="4"
                                      placeholder="Описание промо-блока">{{ old('description') }}</textarea>
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit"
                            class="btn btn-success">
                        Добавить промо-блок
                    </button>
                </div>

            </form>
        </div>


        {{-- Редактирование существующих промо-блоков --}}

        <h3 class="mt-5 mb-3">
            Существующие промо-блоки
            ({{ $promos->count() }})
        </h3>

        @if($promos->isEmpty())

            <p class="text-center text-muted mt-3">
                Промо-блоков пока нет.
            </p>

        @else

            @foreach($promos as $promo)

                <div class="card mt-4">

                    <div class="card-header">
                        <h3 class="mb-0">
                            Промо-блок №{{ $loop->iteration }}
                        </h3>
                    </div>

                    <form method="POST"
                          action="{{ route('admin.school.promo.update', $promo->id) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="promo_image_{{ $promo->id }}">
                                        <b>Изображение</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($promo->image)

                                            <img
                                                    id="promo_image_preview_{{ $promo->id }}"
                                                    src="{{ asset('images/promos/' . $promo->image . '.png') }}"
                                                    alt="{{ $promo->image_alt }}"
                                                    width="240"
                                                    class="d-block border"
                                            >

                                        @else

                                            <img
                                                    id="promo_image_preview_{{ $promo->id }}"
                                                    src=""
                                                    alt="Предпросмотр"
                                                    width="240"
                                                    class="d-none border"
                                            >

                                        @endif

                                    </div>

                                    <input type="file"
                                           class="form-control-file"
                                           id="promo_image_{{ $promo->id }}"
                                           name="image"
                                           accept="image/jpeg,image/png,image/webp">

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="promo_image_alt_{{ $promo->id }}">
                                        <b>Alt изображения</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="promo_image_alt_{{ $promo->id }}"
                                           name="image_alt"
                                           value="{{ old('image_alt', $promo->image_alt) }}"
                                           placeholder="Описание изображения">
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="promo_title_{{ $promo->id }}">
                                        <b>Заголовок</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="promo_title_{{ $promo->id }}"
                                           name="title"
                                           value="{{ old('title', $promo->title) }}"
                                           required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="promo_sort_order_{{ $promo->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input type="number"
                                           class="form-control"
                                           id="promo_sort_order_{{ $promo->id }}"
                                           name="sort_order"
                                           value="{{ old('sort_order', $promo->sort_order) }}"
                                           min="0">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="promo_description_{{ $promo->id }}">
                                        <b>Описание</b>
                                    </label>

                                    <textarea class="form-control"
                                              id="promo_description_{{ $promo->id }}"
                                              name="description"
                                              rows="4">{{ old('description', $promo->description) }}</textarea>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between">

                            <button type="submit"
                                    class="btn btn-primary">
                                Сохранить промо-блок
                            </button>

                        </div>

                    </form>

                    <div class="card-footer border-top">

                        <form method="POST"
                              action="{{ route('admin.school.promo.destroy', $promo->id) }}"
                              onsubmit="return confirm('Удалить этот промо-блок?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Удалить промо-блок
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        @endif

        {{-- ============================================================
     Слайдер школы
============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Слайдер школы
        </h2>

        {{-- Добавление нового слайда --}}

        <div class="card mt-4">

            <div class="card-header">
                <h3 class="mb-0">
                    Добавить слайд
                </h3>
            </div>

            <form method="POST"
                  action="{{ route('admin.school.slider.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="row">

                        {{-- Маленькое изображение --}}

                        <div class="form-group col-md-6">

                            <label for="new_school_slider_image">
                                <b>Маленькое изображение, jpg размер 480px * 320px</b>
                            </label>

                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input"
                                       id="new_school_slider_image"
                                       name="image"
                                       accept="image/jpeg,image/png,image/webp"
                                       required>

                                <label class="custom-file-label"
                                       for="new_school_slider_image"
                                       data-browse="Выбрать">
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Изображение для обычного размера слайдера.
                            </small>

                            <img id="new_school_slider_image_preview"
                                 src=""
                                 alt="Предпросмотр изображения"
                                 width="300"
                                 class="d-none mt-3 border">
                        </div>

                        {{-- Большое изображение --}}

                        <div class="form-group col-md-6">

                            <label for="new_school_slider_image_big">
                                <b>Большое изображение, jpg размер 1080px * 720px</b>
                            </label>

                            <div class="custom-file">
                                <input type="file"
                                       class="custom-file-input"
                                       id="new_school_slider_image_big"
                                       name="image_big"
                                       accept="image/jpeg,image/png,image/webp"
                                       required>

                                <label class="custom-file-label"
                                       for="new_school_slider_image_big"
                                       data-browse="Выбрать">
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Изображение для большого экрана.
                            </small>

                            <img id="new_school_slider_image_big_preview"
                                 src=""
                                 alt="Предпросмотр большого изображения"
                                 width="300"
                                 class="d-none mt-3 border">
                        </div>

                        {{-- Alt --}}

                        <div class="form-group col-md-8">

                            <label for="new_school_slider_image_alt">
                                <b>Alt изображений</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="new_school_slider_image_alt"
                                   name="image_alt"
                                   value="{{ old('image_alt') }}"
                                   placeholder="Описание изображений">
                        </div>

                        {{-- Сортировка --}}

                        <div class="form-group col-md-4">

                            <label for="new_school_slider_sort_order">
                                <b>Сортировка</b>
                            </label>

                            <input type="number"
                                   class="form-control"
                                   id="new_school_slider_sort_order"
                                   name="sort_order"
                                   value="{{ old('sort_order', 0) }}"
                                   min="0">
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

        </div>


        {{-- Существующие слайды --}}

        <h3 class="mt-5 mb-3">
            Существующие слайды
            ({{ $schoolSliders->count() }})
        </h3>

        @if($schoolSliders->isEmpty())

            <p class="text-center text-muted mt-3">
                Слайдов пока нет.
            </p>

        @else

            @foreach($schoolSliders as $schoolSlider)

                <div class="card mt-4">

                    <div class="card-header">
                        <h3 class="mb-0">
                            Слайд №{{ $loop->iteration }}
                        </h3>
                    </div>

                    <form method="POST"
                          action="{{ route(
                      'admin.school.slider.update',
                      $schoolSlider->id
                  ) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="card-body">

                            <div class="row">

                                {{-- Маленькое изображение --}}

                                <div class="form-group col-md-6">

                                    <label for="school_slider_image_{{ $schoolSlider->id }}">
                                        <b>Маленькое изображение, jpg размер 480px * 320px</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($schoolSlider->image)

                                            <img
                                                    id="school_slider_image_preview_{{ $schoolSlider->id }}"
                                                    src="{{ asset(
                                            'images/school/gallery/' .
                                            $schoolSlider->image .
                                            '.jpg'
                                        ) }}"
                                                    alt="{{ $schoolSlider->image_alt }}"
                                                    width="300"
                                                    class="d-block border"
                                            >

                                        @else

                                            <img
                                                    id="school_slider_image_preview_{{ $schoolSlider->id }}"
                                                    src=""
                                                    alt="Предпросмотр"
                                                    width="300"
                                                    class="d-none border"
                                            >

                                        @endif

                                    </div>

                                    <input type="file"
                                           class="form-control-file"
                                           id="school_slider_image_{{ $schoolSlider->id }}"
                                           name="image"
                                           accept="image/jpeg,image/png,image/webp">

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                {{-- Большое изображение --}}

                                <div class="form-group col-md-6">

                                    <label for="school_slider_image_big_{{ $schoolSlider->id }}">
                                        <b>Большое изображение, jpg размер 1080px * 720px</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($schoolSlider->image_big)

                                            <img
                                                    id="school_slider_image_big_preview_{{ $schoolSlider->id }}"
                                                    src="{{ asset(
                                            'images/school/gallery/' .
                                            $schoolSlider->image_big .
                                            '.jpg'
                                        ) }}"
                                                    alt="{{ $schoolSlider->image_alt }}"
                                                    width="300"
                                                    class="d-block border"
                                            >

                                        @else

                                            <img
                                                    id="school_slider_image_big_preview_{{ $schoolSlider->id }}"
                                                    src=""
                                                    alt="Предпросмотр"
                                                    width="300"
                                                    class="d-none border"
                                            >

                                        @endif

                                    </div>

                                    <input type="file"
                                           class="form-control-file"
                                           id="school_slider_image_big_{{ $schoolSlider->id }}"
                                           name="image_big"
                                           accept="image/jpeg,image/png,image/webp">

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                {{-- Alt --}}

                                <div class="form-group col-md-8">

                                    <label for="school_slider_image_alt_{{ $schoolSlider->id }}">
                                        <b>Alt изображений</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="school_slider_image_alt_{{ $schoolSlider->id }}"
                                           name="image_alt"
                                           value="{{ old(
                                       'image_alt',
                                       $schoolSlider->image_alt
                                   ) }}"
                                           placeholder="Описание изображений">

                                </div>

                                {{-- Сортировка --}}

                                <div class="form-group col-md-4">

                                    <label for="school_slider_sort_order_{{ $schoolSlider->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input type="number"
                                           class="form-control"
                                           id="school_slider_sort_order_{{ $schoolSlider->id }}"
                                           name="sort_order"
                                           value="{{ old(
                                       'sort_order',
                                       $schoolSlider->sort_order
                                   ) }}"
                                           min="0">

                                </div>

                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit"
                                    class="btn btn-primary">
                                Сохранить слайд
                            </button>

                        </div>

                    </form>

                    <div class="card-footer border-top">

                        <form method="POST"
                              action="{{ route(
                          'admin.school.slider.destroy',
                          $schoolSlider->id
                      ) }}"
                              onsubmit="return confirm('Удалить этот слайд?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                Удалить слайд
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        @endif
    </section>

@endsection

@push('scripts')

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const newPromoInput =
          document.getElementById('new_promo_image');

        const newPromoPreview =
          document.getElementById('new_promo_preview');

        if (newPromoInput && newPromoPreview) {
          newPromoInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
              return;
            }

            if (newPromoPreview.dataset.objectUrl) {
              URL.revokeObjectURL(
                newPromoPreview.dataset.objectUrl
              );
            }

            const objectUrl =
              URL.createObjectURL(file);

            newPromoPreview.src = objectUrl;
            newPromoPreview.dataset.objectUrl = objectUrl;
            newPromoPreview.classList.remove('d-none');
          });
        }

        document
          .querySelectorAll('input[type="file"][name="image"]')
          .forEach(function (input) {
            input.addEventListener('change', function () {
              const promoId =
                this.id.replace('promo_image_', '');

              const preview =
                document.getElementById(
                  'promo_image_preview_' + promoId
                );

              if (!preview || !this.files[0]) {
                return;
              }

              if (preview.dataset.objectUrl) {
                URL.revokeObjectURL(
                  preview.dataset.objectUrl
                );
              }

              const objectUrl =
                URL.createObjectURL(this.files[0]);

              preview.src = objectUrl;
              preview.dataset.objectUrl = objectUrl;
              preview.classList.remove('d-none');
            });
          });
      });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        function setPreview(input, preview) {
          if (!input || !preview) {
            return;
          }

          input.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
              return;
            }

            if (preview.dataset.objectUrl) {
              URL.revokeObjectURL(
                preview.dataset.objectUrl
              );
            }

            const objectUrl = URL.createObjectURL(file);

            preview.src = objectUrl;
            preview.dataset.objectUrl = objectUrl;
            preview.classList.remove('d-none');
          });
        }

        // Предпросмотр нового слайда
        setPreview(
          document.getElementById(
            'new_school_slider_image'
          ),
          document.getElementById(
            'new_school_slider_image_preview'
          )
        );

        setPreview(
          document.getElementById(
            'new_school_slider_image_big'
          ),
          document.getElementById(
            'new_school_slider_image_big_preview'
          )
        );

        // Предпросмотр существующих слайдов
        document
          .querySelectorAll(
            'input[id^="school_slider_image_"]'
          )
          .forEach(function (input) {
            const sliderId = input.id
              .replace('school_slider_image_', '');

            const preview = document.getElementById(
              'school_slider_image_preview_' + sliderId
            );

            setPreview(input, preview);
          });

        document
          .querySelectorAll(
            'input[id^="school_slider_image_big_"]'
          )
          .forEach(function (input) {
            const sliderId = input.id
              .replace('school_slider_image_big_', '');

            const preview = document.getElementById(
              'school_slider_image_big_preview_' + sliderId
            );

            setPreview(input, preview);
          });
      });
    </script>

@endpush

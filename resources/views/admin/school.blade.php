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

@endpush

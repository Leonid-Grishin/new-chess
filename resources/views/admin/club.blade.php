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
                            Рекомендуемый размер: jpg, 780 × 430 px.
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


        {{-- ============================================================
     Адреса и контакты
============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Адреса и контакты
        </h2>

        @if($addresses->isEmpty())

            <p class="text-center text-muted mt-3">
                Адресов пока нет.
            </p>

        @else

            @foreach($addresses as $address)

                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">
                            Адрес №{{ $loop->iteration }}
                        </h3>
                    </div>

                    <form method="POST"
                          action="{{ route('admin.club.address.update', $address->id) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="title_{{ $address->id }}">
                                        <b>Заголовок</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="title_{{ $address->id }}"
                                           name="title"
                                           value="{{ old('title', $address->title) }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name_{{ $address->id }}">
                                        <b>Название</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="name_{{ $address->id }}"
                                           name="name"
                                           value="{{ old('name', $address->name) }}">
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="address_{{ $address->id }}">
                                        <b>Адрес</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="address_{{ $address->id }}"
                                           name="address"
                                           value="{{ old('address', $address->address) }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="address_link_{{ $address->id }}">
                                        <b>Ссылка на карту</b>
                                    </label>

                                    <input type="url"
                                           class="form-control"
                                           id="address_link_{{ $address->id }}"
                                           name="address_link"
                                           value="{{ old('address_link', $address->address_link) }}"
                                           placeholder="https://yandex.ru/maps/...">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone_{{ $address->id }}">
                                        <b>Телефон</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="phone_{{ $address->id }}"
                                           name="phone"
                                           value="{{ old('phone', $address->phone) }}"
                                           placeholder="+7 (900) 000-00-00">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone_link_{{ $address->id }}">
                                        <b>Ссылка телефона</b>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="phone_link_{{ $address->id }}"
                                           name="phone_link"
                                           value="{{ old('phone_link', $address->phone_link) }}"
                                           placeholder="tel:+79000000000">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="sort_order_{{ $address->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input type="number"
                                           class="form-control"
                                           id="sort_order_{{ $address->id }}"
                                           name="sort_order"
                                           value="{{ old('sort_order', $address->sort_order) }}"
                                           min="0">
                                </div>

                            </div>

                            <hr>

                            <hr>

                            <h4 class="mb-3">
                                Изображения
                            </h4>

                            <div class="row">

                                {{-- Первое изображение --}}
                                <div class="form-group col-md-6">
                                    <label for="image_1_{{ $address->id }}">
                                        <b>Первое изображение, jpg  740px * 500px</b>
                                    </label>

                                    <div class="mb-2">
                                        <img
                                                id="image_1_preview_{{ $address->id }}"
                                                @if($address->image_1)
                                                    src="{{ asset('images/location/' . $address->image_1 . '.jpg') }}"
                                                @endif
                                                alt="{{ $address->image_1_alt }}"
                                                width="240"
                                                class="d-block border {{ $address->image_1 ? '' : 'd-none' }}"
                                        >
                                    </div>

                                    <input type="file"
                                           class="form-control-file"
                                           id="image_1_{{ $address->id }}"
                                           name="image_1"
                                           accept="image/jpeg,image/png,image/webp">

                                    <label for="image_1_alt_{{ $address->id }}"
                                           class="mt-2">
                                        Alt первого изображения
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="image_1_alt_{{ $address->id }}"
                                           name="image_1_alt"
                                           value="{{ old('image_1_alt', $address->image_1_alt) }}">
                                </div>


                                {{-- Второе изображение --}}
                                <div class="form-group col-md-6">
                                    <label for="image_2_{{ $address->id }}">
                                        <b>Второе изображение, jpg  740px * 500px</b>
                                    </label>

                                    <div class="mb-2">
                                        <img
                                                id="image_2_preview_{{ $address->id }}"
                                                @if($address->image_2)
                                                    src="{{ asset('images/location/' . $address->image_2 . '.jpg') }}"
                                                @endif
                                                alt="{{ $address->image_2_alt }}"
                                                width="240"
                                                class="d-block border {{ $address->image_2 ? '' : 'd-none' }}"
                                        >
                                    </div>

                                    <input type="file"
                                           class="form-control-file"
                                           id="image_2_{{ $address->id }}"
                                           name="image_2"
                                           accept="image/jpeg,image/png,image/webp">

                                    <label for="image_2_alt_{{ $address->id }}"
                                           class="mt-2">
                                        Alt второго изображения
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="image_2_alt_{{ $address->id }}"
                                           name="image_2_alt"
                                           value="{{ old('image_2_alt', $address->image_2_alt) }}">
                                </div>

                            </div>

                            <hr>

                            <h4 class="mb-3">
                                Преимущества
                            </h4>

                            @forelse($address->features as $feature)

                                <div class="border rounded p-3 mb-3">

                                    <input type="hidden"
                                           name="features[{{ $feature->id }}][id]"
                                           value="{{ $feature->id }}">

                                    <div class="row">

                                        <div class="form-group col-md-3">
                                            <label for="feature_title_{{ $feature->id }}">
                                                <b>Заголовок</b>
                                            </label>

                                            <input type="text"
                                                   class="form-control"
                                                   id="feature_title_{{ $feature->id }}"
                                                   name="features[{{ $feature->id }}][title]"
                                                   value="{{ old('features.' . $feature->id . '.title', $feature->title) }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="feature_description_{{ $feature->id }}">
                                                <b>Описание</b>
                                            </label>

                                            <textarea class="form-control"
                                                      id="feature_description_{{ $feature->id }}"
                                                      name="features[{{ $feature->id }}][description]"
                                                      rows="2">{{ old('features.' . $feature->id . '.description', $feature->description) }}</textarea>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="feature_sort_{{ $feature->id }}">
                                                <b>Сортировка</b>
                                            </label>

                                            <input type="number"
                                                   class="form-control"
                                                   id="feature_sort_{{ $feature->id }}"
                                                   name="features[{{ $feature->id }}][sort_order]"
                                                   value="{{ old('features.' . $feature->id . '.sort_order', $feature->sort_order) }}"
                                                   min="0">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class="d-block">
                                                <b>Активен</b>
                                            </label>

                                            <input type="hidden"
                                                   name="features[{{ $feature->id }}][is_active]"
                                                   value="0">

                                            <input type="checkbox"
                                                   name="features[{{ $feature->id }}][is_active]"
                                                   value="1"
                                                    {{ $feature->is_active ? 'checked' : '' }}>
                                        </div>

                                    </div>

                                </div>

                            @empty

                                <p class="text-muted">
                                    Преимуществ пока нет.
                                </p>

                            @endforelse

                        </div>

                        <div class="card-footer">
                            <button type="submit"
                                    class="btn btn-primary">
                                Сохранить адрес
                            </button>
                        </div>

                    </form>

                </div>

            @endforeach

        @endif

        {{-- ============================================================
     Онлайн-обучение
============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Блок «Доступно онлайн обучение»
        </h2>

        <div class="card mt-4 mb-5">

            <form method="POST"
                  action="{{ route('admin.club.online-block.update') }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="card-body">

                    <div class="row">

                        {{-- Заголовок --}}
                        <div class="form-group col-md-6">
                            <label for="online_block_title">
                                <b>Заголовок блока</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="online_block_title"
                                   name="title"
                                   value="{{ old('title', $onlineBlock?->title) }}"
                                   placeholder="Доступно онлайн обучение"
                                   required>
                        </div>

                        {{-- Alt изображения --}}
                        <div class="form-group col-md-6">
                            <label for="online_block_image_alt">
                                <b>Alt-текст изображения</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="online_block_image_alt"
                                   name="image_alt"
                                   value="{{ old('image_alt', $onlineBlock?->image_alt) }}"
                                   placeholder="Описание изображения для SEO">
                        </div>

                    </div>

                    <hr>

                    {{-- Изображение --}}
                    <div class="form-group">

                        <label for="online_block_image">
                            <b>Изображение блока</b>
                        </label>

                        @if($onlineBlock?->image)

                            <div class="mb-3">
                                <img
                                        id="onlineBlockImagePreview"
                                        src="{{ asset('images/online/' . $onlineBlock->image . '.jpg') }}"
                                        alt="{{ $onlineBlock->image_alt }}"
                                        width="400"
                                        class="d-block border"
                                >
                            </div>

                        @else

                            <img
                                    id="onlineBlockImagePreview"
                                    src=""
                                    alt="Предпросмотр изображения"
                                    width="400"
                                    class="d-none border mb-3"
                            >

                        @endif

                        <input type="file"
                               class="form-control-file"
                               id="online_block_image"
                               name="image"
                               accept="image/jpeg,image/png,image/webp">

                        <small class="form-text text-muted">
                            Рекомендуемый размер: jpg, 1000 × 540 px.
                        </small>

                    </div>

                    <hr>

                    {{-- Пункты блока --}}
                    <h4 class="mb-3">
                        Преимущества
                    </h4>

                    @if($onlineBlock?->items?->isNotEmpty())

                        @foreach($onlineBlock->items as $item)

                            <div class="border rounded p-3 mb-3">

                                <input type="hidden"
                                       name="items[{{ $item->id }}][id]"
                                       value="{{ $item->id }}">

                                <div class="row align-items-end">

                                    <div class="form-group col-md-8 mb-0">
                                        <label for="online_item_text_{{ $item->id }}">
                                            <b>Текст пункта</b>
                                        </label>

                                        <textarea
                                                class="form-control"
                                                id="online_item_text_{{ $item->id }}"
                                                name="items[{{ $item->id }}][text]"
                                                rows="3"
                                                required>{{ old('items.' . $item->id . '.text', $item->text) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-2 mb-0">
                                        <label for="online_item_sort_{{ $item->id }}">
                                            <b>Сортировка</b>
                                        </label>

                                        <input type="number"
                                               class="form-control"
                                               id="online_item_sort_{{ $item->id }}"
                                               name="items[{{ $item->id }}][sort_order]"
                                               value="{{ old('items.' . $item->id . '.sort_order', $item->sort_order) }}"
                                               min="0">
                                    </div>

                                    <div class="form-group col-md-2 mb-0">

                                        <input type="hidden"
                                               name="items[{{ $item->id }}][is_active]"
                                               value="0">

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox"
                                                   class="custom-control-input"
                                                   id="online_item_active_{{ $item->id }}"
                                                   name="items[{{ $item->id }}][is_active]"
                                                   value="1"
                                                    {{ $item->is_active ? 'checked' : '' }}>

                                            <label class="custom-control-label"
                                                   for="online_item_active_{{ $item->id }}">
                                                Активен
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <p class="text-muted">
                            Пунктов пока нет.
                        </p>

                    @endif

                </div>

                <div class="card-footer">
                    <button type="submit"
                            class="btn btn-primary">
                        Сохранить блок
                    </button>
                </div>

            </form>

        </div>

        {{-- ============================================================
     Шахматный лагерь
============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Блок «Шахматный лагерь»
        </h2>

        <div class="card mt-4 mb-5">

            <form method="POST"
                  action="{{ route('admin.club.camp-block.update') }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="card-body">

                    <div class="row">

                        {{-- Заголовок --}}
                        <div class="form-group col-md-6">
                            <label for="camp_block_title">
                                <b>Заголовок</b>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="camp_block_title"
                                   name="title"
                                   value="{{ old('title', $campBlock?->title) }}"
                                   placeholder="Шахматный лагерь"
                                   required>
                        </div>

                        {{-- Описание --}}
                        <div class="form-group col-md-6">
                            <label for="camp_block_description">
                                <b>Описание</b>
                            </label>

                            <textarea class="form-control"
                                      id="camp_block_description"
                                      name="description"
                                      rows="3"
                                      placeholder="Описание блока">{{ old('description', $campBlock?->description) }}</textarea>
                        </div>

                    </div>

                    <hr>

                    <h4 class="mb-3">
                        Изображения
                    </h4>

                    <div class="row">

                        {{-- Первое изображение --}}
                        <div class="form-group col-md-6">

                            <label for="camp_image_1">
                                <b>Первое изображение, jpg 940px * 540px</b>
                            </label>

                            @if($campBlock?->image_1)

                                <div class="mb-3">
                                    <img
                                            id="campImage1Preview"
                                            src="{{ asset('images/club/camp/' . $campBlock->image_1 . '.jpg') }}"
                                            alt="{{ $campBlock->image_1_alt }}"
                                            width="400"
                                            class="d-block border"
                                    >
                                </div>

                            @else

                                <img
                                        id="campImage1Preview"
                                        src=""
                                        alt="Предпросмотр первого изображения"
                                        width="400"
                                        class="d-none border mb-3"
                                >

                            @endif

                            <input type="file"
                                   class="form-control-file"
                                   id="camp_image_1"
                                   name="image_1"
                                   accept="image/jpeg,image/png,image/webp">

                            <label for="camp_image_1_alt"
                                   class="mt-3">
                                Alt первого изображения
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="camp_image_1_alt"
                                   name="image_1_alt"
                                   value="{{ old('image_1_alt', $campBlock?->image_1_alt) }}">
                        </div>

                        {{-- Второе изображение --}}
                        <div class="form-group col-md-6">

                            <label for="camp_image_2">
                                <b>Второе изображение, jpg 940px * 540px</b>
                            </label>

                            @if($campBlock?->image_2)

                                <div class="mb-3">
                                    <img
                                            id="campImage2Preview"
                                            src="{{ asset('images/club/camp/' . $campBlock->image_2 . '.jpg') }}"
                                            alt="{{ $campBlock->image_2_alt }}"
                                            width="400"
                                            class="d-block border"
                                    >
                                </div>

                            @else

                                <img
                                        id="campImage2Preview"
                                        src=""
                                        alt="Предпросмотр второго изображения"
                                        width="400"
                                        class="d-none border mb-3"
                                >

                            @endif

                            <input type="file"
                                   class="form-control-file"
                                   id="camp_image_2"
                                   name="image_2"
                                   accept="image/jpeg,image/png,image/webp">

                            <label for="camp_image_2_alt"
                                   class="mt-3">
                                Alt второго изображения
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="camp_image_2_alt"
                                   name="image_2_alt"
                                   value="{{ old('image_2_alt', $campBlock?->image_2_alt) }}">
                        </div>

                    </div>

                    <hr>

                    <h4 class="mb-3">
                        Пункты блока
                    </h4>

                    @if($campBlock?->items?->isNotEmpty())

                        @foreach($campBlock->items as $item)

                            <div class="border rounded p-3 mb-3">

                                <input type="hidden"
                                       name="items[{{ $item->id }}][id]"
                                       value="{{ $item->id }}">

                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="camp_item_title_{{ $item->id }}">
                                            <b>Заголовок пункта</b>
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               id="camp_item_title_{{ $item->id }}"
                                               name="items[{{ $item->id }}][title]"
                                               value="{{ old('items.' . $item->id . '.title', $item->title) }}"
                                               required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="camp_item_description_{{ $item->id }}">
                                            <b>Описание пункта</b>
                                        </label>

                                        <textarea class="form-control"
                                                  id="camp_item_description_{{ $item->id }}"
                                                  name="items[{{ $item->id }}][description]"
                                                  rows="3"
                                                  required>{{ old('items.' . $item->id . '.description', $item->description) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="camp_item_sort_{{ $item->id }}">
                                            <b>Сортировка</b>
                                        </label>

                                        <input type="number"
                                               class="form-control"
                                               id="camp_item_sort_{{ $item->id }}"
                                               name="items[{{ $item->id }}][sort_order]"
                                               value="{{ old('items.' . $item->id . '.sort_order', $item->sort_order) }}"
                                               min="0">
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <p class="text-muted">
                            Пунктов блока пока нет.
                        </p>

                    @endif

                </div>

                <div class="card-footer">
                    <button type="submit"
                            class="btn btn-primary">
                        Сохранить блок «Шахматный лагерь»
                    </button>
                </div>

            </form>

        </div>

    </section>
@endsection

@push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function () {

        /*
         * Предпросмотр нового слайда
         */
        const slideImageInput =
          document.getElementById('newSlideImage');

        const slidePreview =
          document.getElementById('newSlidePreview');

        if (slideImageInput && slidePreview) {
          slideImageInput.addEventListener('change', function () {
            showPreview(this, slidePreview);
          });
        }


        /*
         * Предпросмотр первого изображения адреса
         */
        document
          .querySelectorAll('input[type="file"][name="image_1"]')
          .forEach(function (input) {
            input.addEventListener('change', function () {
              const addressId =
                this.id.replace('image_1_', '');

              const preview =
                document.getElementById(
                  'image_1_preview_' + addressId
                );

              showPreview(this, preview);
            });
          });


        /*
         * Предпросмотр второго изображения адреса
         */
        document
          .querySelectorAll('input[type="file"][name="image_2"]')
          .forEach(function (input) {
            input.addEventListener('change', function () {
              const addressId =
                this.id.replace('image_2_', '');

              const preview =
                document.getElementById(
                  'image_2_preview_' + addressId
                );

              showPreview(this, preview);
            });
          });


        /*
         * Предпросмотр изображения онлайн-блока
         */
        const onlineImageInput =
          document.getElementById('online_block_image');

        const onlineImagePreview =
          document.getElementById('onlineBlockImagePreview');

        if (onlineImageInput && onlineImagePreview) {
          onlineImageInput.addEventListener('change', function () {
            showPreview(this, onlineImagePreview);
          });
        }


        /*
         * Общая функция предпросмотра
         */
        function showPreview(input, preview) {
          const file = input.files[0];

          if (!file || !preview) {
            return;
          }

          /*
           * Освобождаем ранее созданный URL,
           * чтобы не расходовать память браузера.
           */
          if (preview.dataset.objectUrl) {
            URL.revokeObjectURL(
              preview.dataset.objectUrl
            );
          }

          const objectUrl =
            URL.createObjectURL(file);

          preview.src = objectUrl;
          preview.dataset.objectUrl = objectUrl;
          preview.classList.remove('d-none');
        }
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const campImage1Input =
          document.getElementById('camp_image_1');

        const campImage1Preview =
          document.getElementById('campImage1Preview');

        if (campImage1Input && campImage1Preview) {
          campImage1Input.addEventListener('change', function () {
            showCampImagePreview(
              this,
              campImage1Preview
            );
          });
        }

        const campImage2Input =
          document.getElementById('camp_image_2');

        const campImage2Preview =
          document.getElementById('campImage2Preview');

        if (campImage2Input && campImage2Preview) {
          campImage2Input.addEventListener('change', function () {
            showCampImagePreview(
              this,
              campImage2Preview
            );
          });
        }

        function showCampImagePreview(input, preview) {
          const file = input.files[0];

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
        }
      });
    </script>
@endpush

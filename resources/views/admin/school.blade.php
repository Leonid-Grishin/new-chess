@extends('layouts.admin')

@section('title', 'Админка - Школа')

@section('content')

    <section class="content-header">

        <div class="container-fluid">
            <h1 class="h1 text-center mb-2">Страница «Школа»</h1>
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
             ПРОМО-БЛОКИ
        ============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Промо-блоки
        </h2>

        {{-- Добавление промо-блока --}}

        <div class="card mt-4">

            <div class="card-header">
                <h3 class="mb-0">Добавить промо-блок</h3>
            </div>

            <form
                    method="POST"
                    action="{{ route('admin.school.promo.store') }}"
                    enctype="multipart/form-data"
            >
                @csrf

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">

                            <label for="new_promo_image">
                                <b>Изображение</b>
                            </label>

                            <div class="custom-file">
                                <input
                                        type="file"
                                        class="custom-file-input"
                                        id="new_promo_image"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp"
                                >

                                <label
                                        class="custom-file-label"
                                        for="new_promo_image"
                                        data-browse="Выбрать"
                                >
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Рекомендуемый формат: PNG, 740px × 325px или 740px × 280px.
                            </small>

                            <img
                                    id="new_promo_preview"
                                    src=""
                                    alt="Предпросмотр"
                                    width="240"
                                    class="d-none mt-3 border"
                            >

                        </div>

                        <div class="form-group col-md-6">

                            <label for="new_promo_image_alt">
                                <b>Alt изображения</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="new_promo_image_alt"
                                    name="image_alt"
                                    value="{{ old('image_alt') }}"
                                    placeholder="Описание изображения"
                            >

                        </div>

                        <div class="form-group col-md-8">

                            <label for="new_promo_title">
                                <b>Заголовок</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="new_promo_title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Заголовок промо-блока"
                                    required
                            >

                        </div>

                        <div class="form-group col-md-4">

                            <label for="new_promo_sort_order">
                                <b>Сортировка</b>
                            </label>

                            <input
                                    type="number"
                                    class="form-control"
                                    id="new_promo_sort_order"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                            >

                        </div>

                        <div class="form-group col-md-12">

                            <label for="new_promo_description">
                                <b>Описание</b>
                            </label>

                            <textarea
                                    class="form-control"
                                    id="new_promo_description"
                                    name="description"
                                    rows="4"
                                    placeholder="Описание промо-блока"
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        Добавить промо-блок
                    </button>
                </div>

            </form>

        </div>

        {{-- Существующие промо-блоки --}}

        <h3 class="mt-5 mb-3">
            Существующие промо-блоки ({{ $promos->count() }})
        </h3>

        @if($promos->isEmpty())

            <p class="text-center text-muted">
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

                    <form
                            method="POST"
                            action="{{ route('admin.school.promo.update', $promo->id) }}"
                            enctype="multipart/form-data"
                    >
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
                                                    src="{{ asset('images/promos/' . $promo->image . '.png') }}?v={{ optional($promo->updated_at)->timestamp }}"
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

                                    <input
                                            type="file"
                                            class="form-control-file"
                                            id="promo_image_{{ $promo->id }}"
                                            name="image"
                                            accept="image/jpeg,image/png,image/webp"
                                    >

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="promo_image_alt_{{ $promo->id }}">
                                        <b>Alt изображения</b>
                                    </label>

                                    <input
                                            type="text"
                                            class="form-control"
                                            id="promo_image_alt_{{ $promo->id }}"
                                            name="image_alt"
                                            value="{{ old('image_alt', $promo->image_alt) }}"
                                            placeholder="Описание изображения"
                                    >

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="promo_title_{{ $promo->id }}">
                                        <b>Заголовок</b>
                                    </label>

                                    <input
                                            type="text"
                                            class="form-control"
                                            id="promo_title_{{ $promo->id }}"
                                            name="title"
                                            value="{{ old('title', $promo->title) }}"
                                            required
                                    >

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="promo_sort_order_{{ $promo->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input
                                            type="number"
                                            class="form-control"
                                            id="promo_sort_order_{{ $promo->id }}"
                                            name="sort_order"
                                            value="{{ old('sort_order', $promo->sort_order) }}"
                                            min="0"
                                    >

                                </div>

                                <div class="form-group col-md-12">

                                    <label for="promo_description_{{ $promo->id }}">
                                        <b>Описание</b>
                                    </label>

                                    <textarea
                                            class="form-control"
                                            id="promo_description_{{ $promo->id }}"
                                            name="description"
                                            rows="4"
                                    >{{ old('description', $promo->description) }}</textarea>

                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Сохранить промо-блок
                            </button>
                        </div>

                    </form>

                    <div class="card-footer border-top">

                        <form
                                method="POST"
                                action="{{ route('admin.school.promo.destroy', $promo->id) }}"
                                onsubmit="return confirm('Удалить этот промо-блок?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Удалить промо-блок
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach

        @endif


        {{-- ============================================================
             СЛАЙДЕР ШКОЛЫ
        ============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Слайдер школы
        </h2>

        {{-- Добавление слайда --}}

        <div class="card mt-4">

            <div class="card-header">
                <h3 class="mb-0">Добавить слайд</h3>
            </div>

            <form
                    method="POST"
                    action="{{ route('admin.school.slider.store') }}"
                    enctype="multipart/form-data"
            >
                @csrf

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">

                            <label for="new_school_slider_image">
                                <b>Маленькое изображение, 480px × 320px</b>
                            </label>

                            <div class="custom-file">
                                <input
                                        type="file"
                                        class="custom-file-input"
                                        id="new_school_slider_image"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp"
                                        required
                                >

                                <label
                                        class="custom-file-label"
                                        for="new_school_slider_image"
                                        data-browse="Выбрать"
                                >
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Изображение для обычного размера слайдера.
                            </small>

                            <img
                                    id="new_school_slider_image_preview"
                                    src=""
                                    alt="Предпросмотр изображения"
                                    width="300"
                                    class="d-none mt-3 border"
                            >

                        </div>

                        <div class="form-group col-md-6">

                            <label for="new_school_slider_image_big">
                                <b>Большое изображение, 1080px × 720px</b>
                            </label>

                            <div class="custom-file">
                                <input
                                        type="file"
                                        class="custom-file-input"
                                        id="new_school_slider_image_big"
                                        name="image_big"
                                        accept="image/jpeg,image/png,image/webp"
                                        required
                                >

                                <label
                                        class="custom-file-label"
                                        for="new_school_slider_image_big"
                                        data-browse="Выбрать"
                                >
                                    Выберите изображение
                                </label>
                            </div>

                            <small class="form-text text-muted">
                                Изображение для большого экрана.
                            </small>

                            <img
                                    id="new_school_slider_image_big_preview"
                                    src=""
                                    alt="Предпросмотр большого изображения"
                                    width="300"
                                    class="d-none mt-3 border"
                            >

                        </div>

                        <div class="form-group col-md-8">

                            <label for="new_school_slider_image_alt">
                                <b>Alt изображений</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="new_school_slider_image_alt"
                                    name="image_alt"
                                    value="{{ old('image_alt') }}"
                                    placeholder="Описание изображений"
                            >

                        </div>

                        <div class="form-group col-md-4">

                            <label for="new_school_slider_sort_order">
                                <b>Сортировка</b>
                            </label>

                            <input
                                    type="number"
                                    class="form-control"
                                    id="new_school_slider_sort_order"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                            >

                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        Добавить слайд
                    </button>
                </div>

            </form>

        </div>

        {{-- Существующие слайды --}}

        <h3 class="mt-5 mb-3">
            Существующие слайды ({{ $schoolSliders->count() }})
        </h3>

        @if($schoolSliders->isEmpty())

            <p class="text-center text-muted">
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

                    <form
                            method="POST"
                            action="{{ route('admin.school.slider.update', $schoolSlider->id) }}"
                            enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">

                                    <label for="school_slider_image_{{ $schoolSlider->id }}">
                                        <b>Маленькое изображение, 480px × 320px</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($schoolSlider->image)

                                            <img
                                                    id="school_slider_image_preview_{{ $schoolSlider->id }}"
                                                    src="{{ asset('images/school/gallery/' . $schoolSlider->image . '.jpg') }}?v={{ optional($schoolSlider->updated_at)->timestamp }}"
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

                                    <input
                                            type="file"
                                            class="form-control-file"
                                            id="school_slider_image_{{ $schoolSlider->id }}"
                                            name="image"
                                            accept="image/jpeg,image/png,image/webp"
                                    >

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="school_slider_image_big_{{ $schoolSlider->id }}">
                                        <b>Большое изображение, 1080px × 720px</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($schoolSlider->image_big)

                                            <img
                                                    id="school_slider_image_big_preview_{{ $schoolSlider->id }}"
                                                    src="{{ asset('images/school/gallery/' . $schoolSlider->image_big . '.jpg') }}?v={{ optional($schoolSlider->updated_at)->timestamp }}"
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

                                    <input
                                            type="file"
                                            class="form-control-file"
                                            id="school_slider_image_big_{{ $schoolSlider->id }}"
                                            name="image_big"
                                            accept="image/jpeg,image/png,image/webp"
                                    >

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="school_slider_image_alt_{{ $schoolSlider->id }}">
                                        <b>Alt изображений</b>
                                    </label>

                                    <input
                                            type="text"
                                            class="form-control"
                                            id="school_slider_image_alt_{{ $schoolSlider->id }}"
                                            name="image_alt"
                                            value="{{ old('image_alt', $schoolSlider->image_alt) }}"
                                            placeholder="Описание изображений"
                                    >

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="school_slider_sort_order_{{ $schoolSlider->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input
                                            type="number"
                                            class="form-control"
                                            id="school_slider_sort_order_{{ $schoolSlider->id }}"
                                            name="sort_order"
                                            value="{{ old('sort_order', $schoolSlider->sort_order) }}"
                                            min="0"
                                    >

                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Сохранить слайд
                            </button>
                        </div>

                    </form>

                    <div class="card-footer border-top">

                        <form
                                method="POST"
                                action="{{ route('admin.school.slider.destroy', $schoolSlider->id) }}"
                                onsubmit="return confirm('Удалить этот слайд?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Удалить слайд
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach

        @endif


        {{-- ============================================================
             ЦЕЛЬ ШКОЛЫ
        ============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Цель школы
        </h2>

        <div class="card mt-4">

            <div class="card-header">
                <h3 class="mb-0">
                    Редактирование блока «Цель школы»
                </h3>
            </div>

            <form
                    method="POST"
                    action="{{ route('admin.school.goal.update') }}"
                    enctype="multipart/form-data"
            >
                @csrf
                @method('PATCH')

                <div class="card-body">

                    <div class="row">

                        {{-- Изображение --}}

                        <div class="form-group col-md-6">

                            <label for="school_goal_image">
                                <b>Изображение, 1520px × 592px</b>
                            </label>

                            <div class="mb-3">

                                @if($schoolGoal && $schoolGoal->image)

                                    <img
                                            id="school_goal_image_preview"
                                            src="{{ asset('images/school/' . $schoolGoal->image . '.webp') }}?v={{ optional($schoolGoal->updated_at)->timestamp }}"
                                            alt="{{ $schoolGoal->image_alt }}"
                                            width="360"
                                            class="d-block border"
                                    >

                                @else

                                    <img
                                            id="school_goal_image_preview"
                                            src=""
                                            alt="Предпросмотр изображения"
                                            width="360"
                                            class="d-none border"
                                    >

                                @endif

                            </div>

                            <input
                                    type="file"
                                    class="form-control-file"
                                    id="school_goal_image"
                                    name="image"
                                    accept="image/jpeg,image/png,image/webp"
                            >

                            <small class="form-text text-muted">
                                Новое изображение заменит текущее.
                            </small>

                        </div>

                        {{-- Alt изображения --}}

                        <div class="form-group col-md-6">

                            <label for="school_goal_image_alt">
                                <b>Alt изображения</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="school_goal_image_alt"
                                    name="image_alt"
                                    value="{{ old('image_alt', $schoolGoal->image_alt ?? '') }}"
                                    placeholder="Описание изображения"
                            >

                        </div>

                        {{-- Заголовок --}}

                        <div class="form-group col-md-12">

                            <label for="school_goal_title">
                                <b>Заголовок</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="school_goal_title"
                                    name="title"
                                    value="{{ old('title', $schoolGoal->title ?? '') }}"
                                    placeholder="Например: Цель А5"
                                    required
                            >

                        </div>

                        {{-- Описание --}}

                        <div class="form-group col-md-12">

                            <label for="school_goal_description">
                                <b>Описание</b>
                            </label>

                            <textarea
                                    class="form-control"
                                    id="school_goal_description"
                                    name="description"
                                    rows="5"
                                    placeholder="Описание блока"
                            >{{ old('description', $schoolGoal->description ?? '') }}</textarea>

                        </div>

                        {{-- Основной текст --}}

                        <div class="form-group col-md-12">

                            <label for="school_goal_text">
                                <b>
                                    Основной текст.
                                    Каждый абзац оборачивайте в
                                    &lt;p&gt;&lt;/p&gt;
                                </b>
                            </label>

                            <textarea
                                    class="form-control"
                                    id="school_goal_text"
                                    name="text"
                                    rows="10"
                                    placeholder="Основной текст блока"
                            >{{ old('text', $schoolGoal->text ?? '') }}</textarea>

                            <small class="form-text text-muted">
                                Пример:
                                &lt;p&gt;Первый абзац текста.&lt;/p&gt;
                                &lt;p&gt;Второй абзац текста.&lt;/p&gt;
                            </small>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        Сохранить блок
                    </button>

                </div>

            </form>

        </div>

        {{-- ============================================================
             ГРУППЫ УЧАЩИХСЯ
        ============================================================= --}}

        <h2 class="bg-warning mt-5 text-center p-3">
            Группы учащихся
        </h2>

        {{-- Добавление группы --}}

        <div class="card mt-4">

            <div class="card-header">
                <h3 class="mb-0">
                    Добавить группу учащихся
                </h3>
            </div>

            <form
                    method="POST"
                    action="{{ route('admin.school.student-group.store') }}"
                    enctype="multipart/form-data"
            >
                @csrf

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">

                            <label for="new_student_group_image">
                                <b>Изображение, jpg 739px * 330px</b>
                            </label>

                            <div class="custom-file">

                                <input
                                        type="file"
                                        class="custom-file-input"
                                        id="new_student_group_image"
                                        name="image"
                                        accept="image/jpeg,image/png,image/webp"
                                        required
                                >

                                <label
                                        class="custom-file-label"
                                        for="new_student_group_image"
                                        data-browse="Выбрать"
                                >
                                    Выберите изображение
                                </label>

                            </div>

                            <small class="form-text text-muted">
                                Рекомендуемый размер: , jpg 739px * 330px.
                            </small>

                            <img
                                    id="new_student_group_image_preview"
                                    src=""
                                    alt="Предпросмотр изображения"
                                    width="300"
                                    class="d-none mt-3 border"
                            >

                        </div>

                        <div class="form-group col-md-6">

                            <label for="new_student_group_image_alt">
                                <b>Alt изображения</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="new_student_group_image_alt"
                                    name="image_alt"
                                    value="{{ old('image_alt') }}"
                                    placeholder="Описание изображения"
                            >

                        </div>

                        <div class="form-group col-md-8">

                            <label for="new_student_group_title">
                                <b>Название группы</b>
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="new_student_group_title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Например: Новички"
                                    required
                            >

                        </div>

                        <div class="form-group col-md-4">

                            <label for="new_student_group_sort_order">
                                <b>Сортировка</b>
                            </label>

                            <input
                                    type="number"
                                    class="form-control"
                                    id="new_student_group_sort_order"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                            >

                        </div>

                        <div class="form-group col-md-12">

                            <label>
                                <b>Пункты группы</b>
                            </label>

                            <div id="new_student_group_items">

                                <div class="input-group mb-2">

                                    <input
                                            type="text"
                                            class="form-control"
                                            name="items[0][text]"
                                            placeholder="Текст пункта"
                                    >

                                    <input
                                            type="hidden"
                                            name="items[0][sort_order]"
                                            value="0"
                                    >

                                    <div class="input-group-append">

                                        <button
                                                type="button"
                                                class="btn btn-danger remove-student-group-item"
                                        >
                                            Удалить
                                        </button>

                                    </div>

                                </div>

                            </div>

                            <button
                                    type="button"
                                    class="btn btn-outline-secondary btn-sm add-student-group-item"
                                    data-container="new_student_group_items"
                            >
                                Добавить пункт
                            </button>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-success">
                        Добавить группу
                    </button>

                </div>

            </form>

        </div>


        {{-- Существующие группы --}}

        <h3 class="mt-5 mb-3">
            Существующие группы учащихся ({{ $studentGroups->count() }})
        </h3>

        @if($studentGroups->isEmpty())

            <p class="text-center text-muted">
                Групп учащихся пока нет.
            </p>

        @else

            @foreach($studentGroups as $studentGroup)

                <div class="card mt-4">

                    <div class="card-header">
                        <h3 class="mb-0">
                            Группа №{{ $loop->iteration }}
                        </h3>
                    </div>

                    <form
                            method="POST"
                            action="{{ route('admin.school.student-group.update', $studentGroup->id) }}"
                            enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">

                                    <label for="student_group_image_{{ $studentGroup->id }}">
                                        <b>Изображение, jpg 739px * 330px</b>
                                    </label>

                                    <div class="mb-2">

                                        @if($studentGroup->image)

                                            <img
                                                    id="student_group_image_preview_{{ $studentGroup->id }}"
                                                    src="{{ asset('images/school/' . $studentGroup->image . '.webp') }}?v={{ optional($studentGroup->updated_at)->timestamp }}"
                                                    alt="{{ $studentGroup->image_alt }}"
                                                    width="300"
                                                    class="d-block border"
                                            >

                                        @else

                                            <img
                                                    id="student_group_image_preview_{{ $studentGroup->id }}"
                                                    src=""
                                                    alt="Предпросмотр изображения"
                                                    width="300"
                                                    class="d-none border"
                                            >

                                        @endif

                                    </div>

                                    <input
                                            type="file"
                                            class="form-control-file"
                                            id="student_group_image_{{ $studentGroup->id }}"
                                            name="image"
                                            accept="image/jpeg,image/png,image/webp"
                                    >

                                    <small class="form-text text-muted">
                                        Новое изображение заменит текущее.
                                    </small>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="student_group_image_alt_{{ $studentGroup->id }}">
                                        <b>Alt изображения</b>
                                    </label>

                                    <input
                                            type="text"
                                            class="form-control"
                                            id="student_group_image_alt_{{ $studentGroup->id }}"
                                            name="image_alt"
                                            value="{{ old('image_alt', $studentGroup->image_alt) }}"
                                            placeholder="Описание изображения"
                                    >

                                </div>

                                <div class="form-group col-md-8">

                                    <label for="student_group_title_{{ $studentGroup->id }}">
                                        <b>Название группы</b>
                                    </label>

                                    <input
                                            type="text"
                                            class="form-control"
                                            id="student_group_title_{{ $studentGroup->id }}"
                                            name="title"
                                            value="{{ old('title', $studentGroup->title) }}"
                                            required
                                    >

                                </div>

                                <div class="form-group col-md-4">

                                    <label for="student_group_sort_order_{{ $studentGroup->id }}">
                                        <b>Сортировка</b>
                                    </label>

                                    <input
                                            type="number"
                                            class="form-control"
                                            id="student_group_sort_order_{{ $studentGroup->id }}"
                                            name="sort_order"
                                            value="{{ old('sort_order', $studentGroup->sort_order) }}"
                                            min="0"
                                    >

                                </div>

                                <div class="form-group col-md-12">

                                    <label>
                                        <b>Пункты группы</b>
                                    </label>

                                    <div
                                            id="student_group_items_{{ $studentGroup->id }}"
                                            class="student-group-items"
                                    >

                                        @forelse($studentGroup->items as $item)

                                            <div class="input-group mb-2">

                                                <input
                                                        type="hidden"
                                                        name="items[{{ $item->id }}][id]"
                                                        value="{{ $item->id }}"
                                                >

                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        name="items[{{ $item->id }}][text]"
                                                        value="{{ $item->text }}"
                                                        placeholder="Текст пункта"
                                                >

                                                <input
                                                        type="hidden"
                                                        name="items[{{ $item->id }}][sort_order]"
                                                        value="{{ $item->sort_order }}"
                                                >

                                                <div class="input-group-append">

                                                    <button
                                                            type="button"
                                                            class="btn btn-danger remove-student-group-item"
                                                    >
                                                        Удалить
                                                    </button>

                                                </div>

                                            </div>

                                        @empty

                                            <div class="input-group mb-2">

                                                <input
                                                        type="text"
                                                        class="form-control"
                                                        name="items[new_0][text]"
                                                        placeholder="Текст пункта"
                                                >

                                                <input
                                                        type="hidden"
                                                        name="items[new_0][sort_order]"
                                                        value="0"
                                                >

                                                <div class="input-group-append">

                                                    <button
                                                            type="button"
                                                            class="btn btn-danger remove-student-group-item"
                                                    >
                                                        Удалить
                                                    </button>

                                                </div>

                                            </div>

                                        @endforelse

                                    </div>

                                    <button
                                            type="button"
                                            class="btn btn-outline-secondary btn-sm add-student-group-item"
                                            data-container="student_group_items_{{ $studentGroup->id }}"
                                    >
                                        Добавить пункт
                                    </button>

                                </div>

                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">
                                Сохранить группу
                            </button>

                        </div>

                    </form>

                    <div class="card-footer border-top">

                        <form
                                method="POST"
                                action="{{ route('admin.school.student-group.destroy', $studentGroup->id) }}"
                                onsubmit="return confirm('Удалить эту группу учащихся?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Удалить группу
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

        function setPreview(inputId, previewId) {

          const input = document.getElementById(inputId);
          const preview = document.getElementById(previewId);

          if (!input || !preview) {
            return;
          }

          input.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
              return;
            }

            const objectUrl = URL.createObjectURL(file);

            preview.src = objectUrl;
            preview.classList.remove('d-none');

            const label = document.querySelector(
              'label[for="' + inputId + '"]'
            );

            if (label && label.classList.contains('custom-file-label')) {
              label.textContent = file.name;
            }
          });
        }

        function addStudentGroupItem(container) {

          const index = container.children.length;
          const itemKey = 'new_' + Date.now() + '_' + index;

          const item = document.createElement('div');

          item.className = 'input-group mb-2';

          item.innerHTML = `
            <input
                type="text"
                class="form-control"
                name="items[${itemKey}][text]"
                placeholder="Текст пункта"
            >

            <input
                type="hidden"
                name="items[${itemKey}][sort_order]"
                value="${index}"
            >

            <div class="input-group-append">
                <button
                    type="button"
                    class="btn btn-danger remove-student-group-item"
                >
                    Удалить
                </button>
            </div>
        `;

          container.appendChild(item);
        }

        document
          .querySelectorAll('.add-student-group-item')
          .forEach(function (button) {

            button.addEventListener('click', function () {

              const container = document.getElementById(
                this.dataset.container
              );

              if (container) {
                addStudentGroupItem(container);
              }
            });
          });

        document.addEventListener('click', function (event) {

          if (
            event.target.classList.contains(
              'remove-student-group-item'
            )
          ) {
            const item = event.target.closest('.input-group');

            if (item) {
              item.remove();
            }
          }
        });

        setPreview(
          'new_student_group_image',
          'new_student_group_image_preview'
        );

        document
          .querySelectorAll('input[id^="student_group_image_"]')
          .forEach(function (input) {

            const id = input.id.replace(
              'student_group_image_',
              ''
            );

            setPreview(
              input.id,
              'student_group_image_preview_' + id
            );
          });

      });
    </script>

@endpush

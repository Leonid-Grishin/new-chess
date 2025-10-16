@extends('layouts.admin')
@section('title', 'Добавление преподавателя')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.teachers') }}">Все Преподаватели</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование Преподавателя</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Редактирование преподавателя "{{ $teacher->name }}"</h1>
            </div>
        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.teachers.update', ['teacher' => $teacher->id]) }}">

            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Имя</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" placeholder="Имя" value="{{ $teacher->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputRank">Звание</label>
                    <input type="text" class="form-control @error('rank') is-invalid @enderror" name="rank" id="inputRank" placeholder="Звание, например Кандидат в Мастера Спорта" value="{{ $teacher->rank }}">
                    @error('rank')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputOrder">Порядок сортировки</label>
                    <input type="text" class="form-control @error('order') is-invalid @enderror" id="inputOrder" name="order" placeholder="Порядок сортировки, например 1" value="{{ $teacher->order }}">
                    @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <img id="uploadedImage" class="mt-4 mb-3 mr-3" src="{{ asset($teacher->image) }}" alt="{{ $teacher->name }}" width="240">
                    <div class="mb-2"><b>Изображение, 740х495 jpg</b></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputImage" name="image">
                        <label class="custom-file-label" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img class="mt-3" id="uploadedImage" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
                </div>




                <label class="d-flex mt-5">
                    <input style="width: 50px" type="checkbox" class="mr-2 form-control teacher-achievement-is-camp-input"  name="is_camp_teacher" @if($teacher->is_camp_teacher) checked @endif value="1">
                    <span class="d-block ml-3 d-flex flex-wrap align-items-center">Если ведет летний лагерь отметить <span class="text-info ml-3">Галочка - Да</span></span>
                </label>

                <div class="form-group">
                    <img id="uploadedCampImage" class="mt-4 mb-3 mr-3" src="{{ asset($teacher->camp_image) }}" alt="{{ $teacher->name }}" width="240">
                    <div class="mb-2"><b>Изображение для страницы Лагерь, 740х400 jpg</b></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('camp_image') is-invalid @enderror" id="inputCampImage" name="camp_image">
                        <label class="custom-file-label" for="inputCampImage" data-browse="Выбрать">Выберите изображение для Лагеря</label>
                        @error('camp_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img class="mt-3" id="uploadedCampImage" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
                </div>


                <div class="form-group achievements-wrapper mt-5">
                    <p class="bg-danger text-light">Нужно указать обязательно 4 общих достижения и если тренер будет в лагере то 2 достижения для лагеря</p>
                    <button class="add-teacher-achievement-button bg-success" type="button">Добавить достижение</button>
                    @for($i = 0; $i < count($teacher->achievements); $i++)
                        <div class="achievement-container mt-3 border border-secondary p-2" >
                            <input class="teacher-achievement-id-input" type="hidden" name="{{ "achievement[".$i."][id]" }}" value="{{ $teacher->achievements[$i]->id }}">
                            <label class="d-flex">
                                <textarea type="text" class="form-control teacher-achievement-title-input" name={{ "achievement[".$i."][title]"}}"" placeholder="Опишите достижение" style="width: 50%;">{{ $teacher->achievements[$i]['title'] }}</textarea>
                                <span class="d-block ml-3 d-flex flex-wrap align-items-center teacher-achievement-title-label">Достижение</span>
                            </label>
                            <label class="d-flex mt-2">
                                <input style="width: 50px" type="text" class="mr-2 form-control teacher-achievement-order-input" name="{{ "achievement[".$i."][order]"}}" value="{{ $teacher->achievements[$i]['order'] }}">
                                <span class="d-block ml-3 d-flex flex-wrap align-items-center teacher-achievement-order-label">Сортировка для Достижения</span>
                            </label>

                            <div>
                                <button type="button" class="button-delete__second-level bg-danger float-right">Удалить достижение</button>
                            </div>

                            <label class="d-flex mt-2">
                                <input style="width: 50px" type="checkbox" class="mr-2 form-control teacher-achievement-is-camp-input"  name="{{ "achievement[".$i."][is_camp_achievement]"}}" @if($teacher->achievements[$i]['is_camp_achievement']) checked @endif value="1">
                                <span class="d-block ml-3 d-flex flex-wrap align-items-center ">Достижение только на страницу лагеря <span class="text-info ml-3">Галочка - Да</span></span>
                            </label>
                        </div>
                    @endfor
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Сохранить</button>
            </div>
        </form>
    </section>
    <x-admin-add-teacher-achievement-template />
@endsection

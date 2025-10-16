@extends('layouts.admin')
@section('title', 'Редактирование ученика')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.students') }}">Все Ученики</a></li>
        <li class="breadcrumb-item active" aria-current="page">Редактирование Ученика</li>
    </ol>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Редактирование ученика</h1>
            </div>
        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.students.update', ['student' => $student->id]) }}">

            @csrf
            @method('PUT')

            <div class="card-body d-flex flex-wrap">

                <h2 class="h4 col-md-12 mb-4 border-bottom">Общая информация</h2>

                <img class="col-md-1 mb-3 rounded-circle" src="{{ asset($student->photo) }}" alt="{{ $student->name }}" id="uploadedImage">
                <div class="form-group col-md-11">
                    <div class="mb-2"><b>Изображение, 110х110 jpg</b></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="inputImage" name="photo">
                        <label class="custom-file-label" for="inputImage" data-browse="Выбрать">Выберите изображение</label>
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputName">Имя Ученика</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" placeholder="Введите имя" value="{{ $student->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputBirth">Дата рождения</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="inputBirth" name="birth_date" value="{{ $student->birth_date }}">
                    @error('birth_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputFshr">ФШР ID</label>
                    <input type="text" class="form-control @error('fshr_id') is-invalid @enderror" name="fshr_id" id="inputFshr" placeholder="Добавьте ФШР ID" value="{{ $student->fshr_id }}">
                    @error('fshr_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputParent">Имя Родителя</label>
                    <input type="text" class="form-control @error('parent') is-invalid @enderror" name="parent" id="inputParent" placeholder="Добавьте имя родителя" value="{{ $student->parent }}">
                    @error('parent')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputTelephone">Телефон</label>
                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" id="inputTelephone" placeholder="Введите телефон" value="{{ $student->telephone }}">
                    @error('telephone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail">Почта</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" placeholder="Введите почту" value="{{ $student->email }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 mb-5">
                    <label for="inputDescription">Описание (заметки)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description" placeholder="Добавьте описание" rows="3">{{ $student->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h2 class="h4 col-md-12 mb-4 border-bottom">Рейтинг ученика</h2>

                <div class="form-group col-md-4">
                    <label for="inputRatingClassic">Рейтинг по Классике</label>
                    <input type="text" class="form-control @error('rating_classic') is-invalid @enderror" id="inputRatingClassic" name="rating_classic" placeholder="Добавьте рейтинг по Классике" value="{{ $student->rating_classic }}">
                    @error('rating_classic')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputRatingRapid">Рейтинг по Быстрым</label>
                    <input type="text" class="form-control @error('rating_rapid') is-invalid @enderror" id="inputRatingRapid" name="rating_rapid" placeholder="Добавьте рейтинг по Быстрым" value="{{ $student->rating_rapid }}">
                    @error('rating_rapid')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputRatingBlitz">Рейтинг по Блицу</label>
                    <input type="text" class="form-control @error('rating_blitz') is-invalid @enderror" id="inputRatingBlitz" name="rating_blitz" placeholder="Добавьте рейтинг по Блицу" value="{{ $student->rating_blitz }}">
                    @error('rating_blitz')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="selectRatingClassicChange">Изменение рейтинга по Классике</label>
                    <select class="form-control @error('rating_classic_change_class') is-invalid @enderror" id="selectRatingClassicChange" name="rating_classic_change_class">
                        <option value>Изменение рейтинга по Классике...</option>
                        <option {{ $student->rating_classic_change_class == 'up' ? "selected" : "" }} value="up">Увеличился</option>
                        <option {{ $student->rating_classic_change_class == 'down' ? "selected" : "" }} value="down">Уменьшился</option>
                    </select>
                    @error('rating_classic_change_class')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="selectRatingRapidChange">Изменение рейтинга по Быстрым</label>
                    <select class="form-control @error('rating_rapid_change_class') is-invalid @enderror" id="selectRatingRapidChange" name="rating_rapid_change_class">
                        <option value>Изменение рейтинга по Быстрым...</option>
                        <option {{ $student->rating_rapid_change_class == 'up' ? "selected" : "" }} value="up">Увеличился</option>
                        <option {{ $student->rating_rapid_change_class == 'down' ? "selected" : "" }} value="down">Уменьшился</option>
                    </select>
                    @error('rating_rapid_change_class')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="selectRatingBlitzChange">Изменение рейтинга по Блицу</label>
                    <select class="form-control @error('rating_blitz_change_class') is-invalid @enderror" id="selectRatingBlitzChange" name="rating_blitz_change_class">
                        <option value>Изменение рейтинга по Блицу...</option>
                        <option {{ $student->rating_blitz_change_class == 'up' ? "selected" : "" }} value="up">Увеличился</option>
                        <option {{ $student->rating_blitz_change_class == 'down' ? "selected" : "" }} value="down">Уменьшился</option>
                    </select>
                    @error('rating_blitz_change_class')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputRatingClassicChange">Изменение рейтинга по Классике (пункты)</label>
                    <input type="text" class="form-control @error('rating_classic_change') is-invalid @enderror" id="inputRatingClassicChange" name="rating_classic_change" placeholder="Добавьте изменение рейтинга по Классике" value="{{ $student->rating_classic_change }}">
                    @error('rating_classic_change')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputRatingRapidChange">Изменение рейтинга по Быстрым (пункты)</label>
                    <input type="text" class="form-control @error('rating_rapid_change') is-invalid @enderror" id="inputRatingRapidChange" name="rating_rapid_change" placeholder="Добавьте изменение рейтинга по Быстрым" value="{{ $student->rating_rapid_change }}">
                    @error('rating_rapid_change')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="inputRatingBlitzChange">Изменение рейтинга по Блицу (пункты)</label>
                    <input type="text" class="form-control @error('rating_blitz_change') is-invalid @enderror" id="inputRatingBlitzChange" name="rating_blitz_change" placeholder="Добавьте изменение рейтинга по Блицу" value="{{ $student->rating_blitz_change }}">
                    @error('rating_blitz_change')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Сохранить</button>
            </div>
        </form>
    </section>
@endsection

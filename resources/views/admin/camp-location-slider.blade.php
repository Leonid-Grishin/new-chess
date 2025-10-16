@extends('layouts.admin')
@section('title', 'Админка - Лагерь - Слайдер Локация')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Страница "Лагерь - Слайдер Локация"</h1>
            </div>


        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.campLocationSlider.update') }}">

            @csrf
            <div class="card-body">
                <button class="camp-add-location-slider-button bg-success" type="button">Добавить слайд</button>
                <span class="text-info ml-2">Добавится внизу списка</span>

                @if($sliders)
                    @for($i = 0; $i < count($sliders); $i++)
                        <div class="location-slider__wrapper">
                            <div class="location-slider__container d-flex mt-5">

                                <input class="location-slider__input-id" type="hidden" name="{{ "slider[".$i."][id]" }}" value="{{ $sliders[$i]->id }}">

                                <div class="form-group">
                                    <label >
                                        <span class="mb-2 d-block">Порядок сортировки</span>
                                        <input type="text" class="form-control location-slider__input-order" name="{{ "slider[".$i."][order]" }}" value="{{ $sliders[$i]->order }}">
                                    </label>
                                </div>

                                <div class="form-group ml-5">
                                    <div class="mb-2"><b>Изображение, 1131х690 jpg</b></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input location-slider__input-image_prev" name="{{ "slider[".$i."][image_prev]" }}">
                                        <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                    </div>
                                    <img class="mt-3" id="uploadedImage" src="/{{ $sliders[$i]->image_prev }}" alt="Загруженное изображение" width="240">
                                </div>

                                <button class="bg-danger button-delete__second-level m-0 ml-auto" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить слайд</button>
                            </div>
                            <hr style="height: 20px; background-color: #ffc1071a;">

                        </div>

                    @endfor
                @endif
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Обновить</button>
            </div>
        </form>
    </section>

    <x-admin-add-location-slider-template />
@endsection

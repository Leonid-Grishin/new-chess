@extends('layouts.admin')
@section('title', 'Админка - Лагерь - Слайдер Галерея')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="mb-2">
                <h1 class="h1 text-center">Страница "Лагерь - Слайдер Локация"</h1>
            </div>


        </div><!-- /.container-fluid -->

        <form enctype="multipart/form-data" method="post" action="{{ route('admin.campGallerySlider.update') }}">

            <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Первый слайдер</h2>

            @csrf
            <div class="card-body">

                @if($firstSlider)
                    <div class="camp-gallery-slider__container d-flex mt-5">

                        <input class="camp-gallery-slider__input-id" type="hidden" name="firstSlider[id]" value="{{ $firstSlider->id }}">

                        <div class="form-group ml-5">
                            <div class="mb-2"><b>Изображение превью, 780pх на 520px jpg</b></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input camp-gallery-slider__input-image_prev" name="firstSlider[image_prev]">
                                <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                            </div>
                            <img class="mt-3 uploadedImagePrev" src="/{{ $firstSlider->image_prev }}" alt="Загруженное изображение" width="240">
                        </div>

                        <div class="form-group ml-5">
                            <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, например 1200pх на 680px, jpg</b></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input camp-gallery-slider__input-image_big" name="firstSlider[image_big]">
                                <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                            </div>
                            <img class="mt-3 uploadedImageBig" src="/{{ $firstSlider->image_big }}" alt="Загруженное изображение" width="240">
                        </div>
                    </div>
                @endif
                @if($secondSlider)
                        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Второй слайдер</h2>
                        <div class="camp-gallery-slider__container d-flex mt-5">

                            <input class="camp-gallery-slider__input-id" type="hidden" name="secondSlider[id]" value="{{ $secondSlider->id }}">

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение превью, 350pх на 250px jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_prev" name="secondSlider[image_prev]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImagePrev" src="/{{ $secondSlider->image_prev }}" alt="Загруженное изображение" width="240">
                            </div>

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, например 1200pх на 680px, jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_big" name="secondSlider[image_big]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImageBig" src="/{{ $secondSlider->image_big }}" alt="Загруженное изображение" width="240">
                            </div>
                        </div>
                    @endif
                @if($thirdSlider)
                        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Третий слайдер</h2>
                        <div class="camp-gallery-slider__container d-flex mt-5">

                            <input class="camp-gallery-slider__input-id" type="hidden" name="thirdSlider[id]" value="{{ $thirdSlider->id }}">

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение превью, 350pх на 250px jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_prev" name="thirdSlider[image_prev]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImagePrev" src="/{{ $thirdSlider->image_prev }}" alt="Загруженное изображение" width="240">
                            </div>

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, например 1200pх на 680px, jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_big" name="thirdSlider[image_big]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImageBig" src="/{{ $thirdSlider->image_big }}" alt="Загруженное изображение" width="240">
                            </div>
                        </div>
                    @endif
                @if($fourthSlider)
                        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Четвертый слайдер</h2>
                        <div class="camp-gallery-slider__container d-flex mt-5">

                            <input class="camp-gallery-slider__input-id" type="hidden" name="fourthSlider[id]" value="{{ $fourthSlider->id }}">

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение превью, 350pх на 250px jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_prev" name="fourthSlider[image_prev]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImagePrev" src="/{{ $fourthSlider->image_prev }}" alt="Загруженное изображение" width="240">
                            </div>

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, например 1200pх на 680px, jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_big" name="fourthSlider[image_big]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImageBig" src="/{{ $fourthSlider->image_big }}" alt="Загруженное изображение" width="240">
                            </div>
                        </div>
                    @endif
                @if($fifthSlider)
                        <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Пятый слайдер</h2>
                        <div class="camp-gallery-slider__container d-flex mt-5">

                            <input class="camp-gallery-slider__input-id" type="hidden" name="fifthSlider[id]" value="{{ $fifthSlider->id }}">

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение превью, 350pх на 250px jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_prev" name="fifthSlider[image_prev]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImagePrev" src="/{{ $fifthSlider->image_prev }}" alt="Загруженное изображение" width="240">
                            </div>

                            <div class="form-group ml-5">
                                <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, например 1200pх на 680px, jpg</b></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input camp-gallery-slider__input-image_big" name="fifthSlider[image_big]">
                                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                </div>
                                <img class="mt-3 uploadedImageBig" src="/{{ $fifthSlider->image_big }}" alt="Загруженное изображение" width="240">
                            </div>
                        </div>
                    @endif
            </div>

            @if(count($hiddenSliders) > 0)
                <div class="camp-hidden-sliders">
                    <h2 class="bg-warning mt-5" style="text-align: center; padding: 20px">Галерея - Скрытые слайды</h2>
                    <button class="camp-hidden-slider-add-button bg-success mt-2" type="button">Добавить слайд</button>
                    <span class="text-info ml-2">Добавится внизу списка</span>

                    @for($i = 0; $i < count($hiddenSliders); $i++)
                        <div class="camp-hidden-slider__wrapper">
                            <div class="mt-5 camp-hidden-slider__container d-flex">

                                <input class="camp-hidden-slider__input-id" type="hidden" name="{{ "hiddenSliders[".$i."][id]" }}" value="{{ $hiddenSliders[$i]->id }}">

                                <div class="form-group">
                                    <label >
                                        <span class="mb-2 d-block">Порядок сортировки <br>
                                            <span class="text-info">Начинается с 6</span>
                                        </span>
                                        <input type="text" class="form-control camp-hidden-slider__input-order" name="{{ "hiddenSliders[".$i."][order]" }}" value="{{ $hiddenSliders[$i]->order }}">
                                    </label>
                                </div>

                                <div class="form-group ml-5">
                                    <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, <br>например 1200pх на 680px, jpg</b></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input camp-hidden-slider__input-image_big" name="{{ "hiddenSliders[".$i."][image_big]" }}">
                                        <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                                    </div>
                                    <img class="mt-3 uploadedImageBig" src="/{{ $hiddenSliders[$i]->image_big }}" alt="Загруженное изображение" width="240">
                                </div>

                                <button class="bg-danger button-delete__second-level ml-auto" type="button" style="margin-left: 30px; margin-bottom: 8px; height: 280px;">Удалить слайд</button>
                            </div>
                            <hr style="height: 20px; background-color: #ffc1071a;">
                        </div>
                    @endfor

                </div>
            @endif


            <div class="card-footer">
                <button type="submit" class="btn btn-primary button-disabled">Обновить</button>
            </div>
        </form>
    </section>

    <x-admin-add-camp-hidden-slider-template />
@endsection

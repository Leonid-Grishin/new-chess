<template class="camp-hidden-slider__template">
    <div class="camp-hidden-slider__wrapper">
        <div class="mt-5 camp-hidden-slider__container d-flex">

            <input class="camp-hidden-slider__input-id" type="hidden" name="" value="">

            <div class="form-group">
                <label >
                    <span class="mb-2 d-block">Порядок сортировки <br>
                        <span class="text-info">Начинается с 6</span>
                    </span>
                    <input type="text" class="form-control camp-hidden-slider__input-order" name="" value="">
                </label>
            </div>

            <div class="form-group ml-5">
                <div class="mb-2"><b>Изображение которое откроется при нажатии, адекватный размер чтобы долго не грузилось, <br>например 1200pх на 680px, jpg</b></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input camp-hidden-slider__input-image_big" name="">
                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                </div>
                <img class="mt-3 uploadedImageBig" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
            </div>

            <div class="ml-auto" style="height: 100%;">
                <button class="bg-danger button-delete__second-level ml-auto" type="button" style="margin-left: 30px; margin-bottom: 8px; height: 280px;">Удалить слайд</button>
            </div>
        </div>
        <hr style="height: 20px; background-color: #ffc1071a;">
    </div>
</template>

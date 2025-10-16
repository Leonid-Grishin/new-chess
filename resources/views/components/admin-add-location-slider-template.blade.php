<template class="location-slider__template">
    <div class="location-slider__wrapper">
        <div class="location-slider__container d-flex mt-5">


            <input class="location-slider__input-id" type="hidden" name="" value="">

            <div class="form-group">
                <label >
                    <span class="mb-2 d-block">Порядок сортировки</span>
                    <input type="text" class="form-control location-slider__input-order" name="" value="">
                </label>
            </div>

            <div class="form-group ml-5">
                <div class="mb-2"><b>Изображение, 1131х690 jpg</b></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input location-slider__input-image_prev" name="">
                    <label class="custom-file-label" data-browse="Выбрать">Выберите изображение</label>
                </div>
                <img class="mt-3 location-slider__input-image_prev" id="uploadedImage" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
            </div>

            <button class="bg-danger button-delete__second-level m-0 ml-auto" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить слайд</button>
        </div>
        <hr style="height: 20px; background-color: #ffc1071a;">

    </div>
</template>

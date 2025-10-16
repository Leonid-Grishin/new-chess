<template class="camp-feature-template">
    <div class="mt-5 camp-features-item">
        <div class="mt-5 d-flex ">

            <div class="visually-hidden camp-feature-item-number" data-campfeaturenumber=""></div>

            <input class="camp-features__id__input" type="hidden" name="" value="">

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                <label class="camp-features__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                    <span style="width: min-content">Порядок сортировки</span>
                    <input type="text" class="form-control camp-features__order__input" name="" value="">
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 400px">
                <label class="camp-features__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Название блока<br><span class="text-info">Обучение и игры</span></span>
                    <input type="text" class="form-control camp-features__title__input"  name="" value="">
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
                <label class="camp-features__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Большой текст для пункта<br><span class="text-info">КАЖДЫЙ абзац нужно обернуть в теги. &lt;p&gt;Пример абзаца&lt;/p&gt;</span></span>
                    <textarea type="text" class="form-control camp-features__description__input" rows="10"  name=""></textarea>
                </label>
            </div>

            <div class="form-group">
                <div class="mb-2"><b>Для первого блока нужен размер изображения 740px на 480px jpg, для остальных изображений размер 739px на 350px jpg</b></div>
                <div class="custom-file">
                    <label class="custom-file-label" data-browse="Выбрать">
                        <span>Выберите изображение</span>
                        <input type="file" class="custom-file-input camp-features__image__input" name="">
                    </label>
                </div>
                <img class="mt-3 camp-features__image" src="{{ asset('images/admin/news-no-image.jpg') }}" alt="Загруженное изображение" width="240">
            </div>
        </div>

            <div class="mt-5 camp-feature-items-container">
                <button class="camp-add-feature-items bg-success" type="button">Добавить плашку на фото</button>
                <span class="text-info ml-2">Добавится внизу списка</span>


            </div>


        <div class="d-flex justify-content-center ml-3" style="margin-top: 40px">
            <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px; width: 100%">Удалить весь блок выше этой кнопки</button>
        </div>

    </div>
    <hr style="height: 20px; background-color: #ffc1071a;">
</template>

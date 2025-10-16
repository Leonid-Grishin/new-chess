<template class="camp-feature-item-template">
    <div class="mt-5 d-flex camp-feature-items-wrapper">

        <input class="camp-feature-item__id__input" type="hidden" name="" value="">

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: min-content; margin: 0 10px;">
            <label class="сamp-feature-item__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                <span style="width: min-content">Порядок сортировки</span>
                <input type="text" class="form-control camp-feature-item__order__input" name="" value="">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 400px">
            <label class="сamp-feature-item__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                <span>Название плашки на фотографии - <span class="text-info">игры</span></span>
                <input type="text" class="form-control camp-feature-item__title__input"  name="" value="">
            </label>
        </div>

        <div class="d-flex justify-content-center ml-3" style="margin-top: 40px">
            <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px; width: 100%">Удалить плашку</button>
        </div>
    </div>
</template>

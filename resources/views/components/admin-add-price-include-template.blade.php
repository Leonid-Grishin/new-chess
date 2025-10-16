<template class="camp-price-include-template">
    <div class="mt-4 d-flex camp-price-include-item">
        <input class="camp-price-include__id__input" type="hidden" name="" value="">

        <div class="form-group mt-2 mb-0" style="width: fit-content; margin-right: 10px;">
            <label class="camp-price-include__is-discount__label d-flex flex-column justify-content-between" style="height: 100%">
                <span>Розовая плашка для скидки <br> <span class="text-info">Галочка - да</span></span>
                <input type="checkbox" class="form-control camp-price-include__is-discount__input"
                       name="" value="1">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
            <label class="camp-price-include__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                <span>Порядок плашки - <span class="text-info">1</span></span>
                <input type="text" class="form-control camp-price-include__order__input" name="" value="">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
            <label class="camp-price-include__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                <span>Описание на плашке <br><span class="text-info">Проживание в комнатах от 2 до 6 человек</span></span>
                <textarea type="text" class="form-control camp-price-include__description__input"  name="" ></textarea>
            </label>
        </div>

        <div class="d-flex justify-content-center" style="margin-top: 40px">
            <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
        </div>

    </div>
</template>

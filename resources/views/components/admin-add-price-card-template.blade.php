<template class="camp-price-card-template">
    <div class="camp-price-card-list">
        <div class="mt-5 d-flex">
            <h3 class="bg-info camp-price__h3" style="display: inline-block; padding: 0 20px;"></h3>
            <button class="bg-danger button-delete__second-level" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
        </div>

        <div class="d-flex">
            <input class="camp-price__id__input" type="hidden" name="" value="">

            <div class="form-group mt-2 mb-0" style="width: fit-content; margin-right: 10px;">
                <label class="camp-price__is-discount__label d-flex flex-column justify-content-between" style="height: 100%">
                    <span>Скидочный ценник? <br> <span class="text-info">Галочка - да</span></span>
                    <input type="checkbox" class="form-control camp-price__is-discount__input" name="" value="1">
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                <label class="camp-price__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                    <span>Порядок ценника - <span class="text-info">1</span></span>
                    <input type="text" class="form-control camp-price__order__input" name="" value="">
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
                <label class="camp-price__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Заголовок ценника <br> <span class="text-info">Участие в одной смене</span></span>
                    <textarea type="text" class="form-control camp-price__title__input" name=""></textarea>
                </label>

            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                <label class="camp-price__amount__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Цена 1, для добавления символа рубля добавить <span class="text-info"> {{ '&#8381;' }}</span></span>
                    <input type="text" class="form-control camp-price__amount__input" name="" value="">
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                <label class="camp-price__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Описание цены 1 <br><span class="text-info">7 дней</span></span>
                    <textarea type="text" class="form-control camp-price__description__input"  name="" ></textarea>
                </label>
            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                <label class="camp-price__second_amount__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Цена 2, для добавления символа рубля добавить <span class="text-info"> {{ '&#8381;' }}</span></span>
                    <input type="text" class="form-control camp-price__second_amount__input" name="" placeholder="" value="">
                </label>

            </div>

            <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: 250px; margin: 0 10px;">
                <label class="camp-price__second_description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                    <span>Описание цены 2 <br><span class="text-info">7 дней</span></span>
                    <textarea type="text" class="form-control camp-price__second_description__input" name="" placeholder="" ></textarea>
                </label>

            </div>
        </div>
    </div>
</template>

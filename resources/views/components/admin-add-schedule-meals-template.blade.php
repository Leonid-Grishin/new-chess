<template class="camp-schedule-meals-template">
    <div class="mt-4 d-flex camp-meals-item">
        <input class="camp-meals__id__input" type="hidden" name="" value="">

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="width: fit-content; margin: 0 10px;">
            <label class="camp-meals__order__label d-flex flex-column justify-content-between mb-0" style="height: 100%;">
                <span style="width: max-content">Порядок плашки - <span class="text-info">1</span></span>
                <input type="text" class="form-control camp-meals__order__input" name="" value="">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
            <label class="camp-meals__time__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                <span style="width: max-content">Время с - до <span class="text-info">10:00 - 10:30</span></span>
                <input type="text" class="form-control camp-meals__time__input"  name="" value="">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
            <label class="camp-meals__title__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                <span>Название пункта<br><span class="text-info">Завтрак</span></span>
                <input type="text" class="form-control camp-meals__title__input"  name="" value="">
            </label>
        </div>

        <div class="form-group mt-2 d-flex flex-column justify-content-between" style="margin: 0 10px; width: 100%;">
            <label class="camp-meals__description__label d-flex flex-column justify-content-between mb-0" style="height: 100%">
                <span>Описание пункта<br><span class="text-info">Каша, бутерброд, чай, хлопья, яйца</span></span>
                <input type="text" class="form-control camp-meals__description__input"  name="" value="">
            </label>
        </div>

        <div class="d-flex justify-content-center" style="margin-top: 40px">
            <button class="bg-danger button-delete__second-level m-0" type="button" style="margin-left: 30px; margin-bottom: 8px;">Удалить</button>
        </div>

    </div>
</template>

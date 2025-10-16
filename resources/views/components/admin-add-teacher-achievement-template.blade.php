<template class="teacher-achievement-template">
    <div class="achievement-container mt-3 border border-secondary p-2" >
        <input class="teacher-achievement-id-input" type="hidden" name="" value="">
        <label class="d-flex">
            <textarea type="text" class="form-control teacher-achievement-title-input" name="" placeholder="Опишите достижение" style="width: 50%;"></textarea>
            <span class="d-block ml-3 d-flex flex-wrap align-items-center teacher-achievement-title-label">Достижение</span>
        </label>
        <label class="d-flex mt-2">
            <input style="width: 50px" type="text" class="mr-2 form-control teacher-achievement-order-input" name="" value="">
            <span class="d-block ml-3 d-flex flex-wrap align-items-center teacher-achievement-order-label">Сортировка для Достижения</span>
        </label>

        <div>
            <button type="button" class="button-delete__second-level bg-danger float-right">Удалить достижение</button>
        </div>

        <label class="d-flex mt-2">
            <input style="width: 50px" type="checkbox" class="mr-2 form-control teacher-achievement-is-camp-input"  name="" value="1">
            <span class="d-block ml-3 d-flex flex-wrap align-items-center ">Достижение только на страницу лагеря <span class="text-info ml-3">Галочка - Да</span></span>
        </label>
    </div>
</template>

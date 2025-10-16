<div class="modal-request modal-request--request">
    <button class="modal-request__close-button" type="button">
        <span class="visually-hidden">Закрыть окно.</span>
    </button>
    <div class="modal-request__wrapper">
        <div class="modal-request__image"></div>
        <div class="modal-request__container">
            <p class="modal-request__title">Шахматный клуб <span class="modal-request__title-wrapper">А5</span></p>
            <p class="modal-request__subtitle">@if(Route::currentRouteName() !== 'camp') записаться на бесплатное пробное занятие @else узнать подробнее о лагере @endif </p>
            <form class="modal-request__form request-form request-form--request request-form--modal request-form--dark" method="post" action="{{ route('api.request') }}" data-name="">

                @csrf

                <div class="request-form__input-wrapper">
                    <label class="request-form__label" for="modal-request-input-name">Ваше имя</label>
                    <input class="request-form__input" type="text" name="name" placeholder="Введите ваше имя"
                           id="modal-request-input-name" required>
                </div>
                <div class="request-form__input-wrapper">
                    <label class="request-form__label" for="modal-request-input-phone">Ваш телефон</label>
                    <input class="request-form__input" type="text" name="phone" placeholder="+7(___)___-__-__"
                           id="modal-request-input-phone" required>
                </div>
                <button class="request-form__button button button--primary" type="submit">@if(Route::currentRouteName() !== 'camp') Записаться на занятие @else Перезвоните мне @endif</button>
                <label class="request-form__policy-control">
                    <input class="visually-hidden request-form__policy-control-input" type="checkbox" name="agreement" value="1" checked required>
                    <span class="request-form__policy-control-checkbox"></span>
                    <span class="request-form__policy-control-label">Заполняя форму я даю согласие на&nbsp;бработку персональных данных</span>
                </label>
                <label>
                    <input class="request-form__hidden-input visually-hidden" name="place" value="">
                </label>
            </form>
        </div>
    </div>
</div>

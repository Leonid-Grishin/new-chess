<div class="modal-request modal-request--subscribe">
    <button class="modal-request__close-button" type="button">
        <span class="visually-hidden">Закрыть окно.</span>
    </button>
    <div class="modal-request__wrapper">
        <div class="modal-request__image"></div>
        <div class="modal-request__container">
            <p class="modal-request__title">Шахматный клуб <span class="modal-request__title-wrapper">А5</span></p>
            <p class="modal-request__subtitle">Решайте задачи самостоятельно или на занятиях</p>
            <form class="modal-request__form request-form request-form--subscribe request-form--modal" method="post" action="{{ route('api.subscriber') }}" data-name="Главная > Узнать программу обучения">

                @csrf

                <div class="request-form__input-wrapper">
                    <label class="request-form__label" for="modal-subscribe-input-name">Ваше имя</label>
                    <input class="request-form__input" type="text" name="name" placeholder="Введите ваше имя"
                           id="modal-subscribe-input-name" required>
                </div>
                <div class="request-form__input-wrapper">
                    <label class="request-form__label" for="modal-subscribe-input-email">Ваш e-mail</label>
                    <input class="request-form__input" type="email" name="email" placeholder="Введите ваш e-mail"
                           id="modal-subscribe-input-email" required>
                </div>
{{--                <div class="request-form__input-wrapper">
                    <label class="request-form__label" for="modal-subscribe-input-telephone">Ваш телефон</label>
                    <input class="request-form__input" type="text" name="telephone" placeholder="Введите ваш телефон"
                           id="modal-subscribe-input-telephone" required>
                </div>--}}
                <button class="request-form__button button button--secondary" type="submit">Получить задачник</button>
                <label class="request-form__policy-control">
                    <input class="visually-hidden request-form__policy-control-input" type="checkbox" name="privacy" value="1" checked required>
                    <span class="request-form__policy-control-checkbox"></span>
                    <span class="request-form__policy-control-label">Заполняя форму я даю согласие на обработку персональных данных</span>
                </label>
                <label class="request-form__policy-control">
                    <input class="visually-hidden request-form__policy-control-input" type="checkbox" name="agreement" value="1" checked required>
                    <span class="request-form__policy-control-checkbox"></span>
                    <span class="request-form__policy-control-label">Согласен(а) на получение рассылки от шахматного клуба А5</span>
                </label>
                <label>
                    <input class="request-form__hidden-input visually-hidden" name="place" value="">
                </label>
            </form>
        </div>
    </div>
</div>

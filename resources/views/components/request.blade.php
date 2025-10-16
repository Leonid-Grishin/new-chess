<section class="index-request {{ $class }}">
    <h2 class="index-request__title second-title">@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'camp') Оставьте заявку на консультацию @else Запишитесь на бесплатное занятие @endif</h2>
    <form class="index-request__form request-form request-form--request" action="{{ route('api.request') }}" method="post" data-name="{{ \App\Src\Functions::translateRoute(\Illuminate\Support\Facades\Route::currentRouteName()) }} > форма заявки">

        @csrf

        <div class="request-form__input-wrapper">
            <label class="request-form__label" for="request-name">Ваше имя</label>
            <input class="request-form__input" type="text" name="name" id="request-name" placeholder="Введите ваше имя"
                   value="{{ old('name') }}" required>
            <span class="request-form__error"></span>
        </div>

        <div class="request-form__input-wrapper">
            <label class="request-form__label" for="request-telephone">Ваш телефон</label>
            <input class="request-form__input" type="tel" name="phone" id="request-telephone" placeholder="+7(___)___-__-__" value="{{ old('phone') }}" required>
            <span class="request-form__error"></span>
        </div>

        <button class="request-form__button button button--primary" type="submit" data-name="{{ \App\Src\Functions::translateRoute(\Illuminate\Support\Facades\Route::currentRouteName()) }} > форма заявки">@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'camp') Остваить заявку @else Записаться<span> на занятие</span>@endif</button>

        <label class="request-form__policy-control">
            <input class="visually-hidden request-form__policy-control-input" type="checkbox" name="agreement" value="1" checked required>
            <span class="request-form__policy-control-checkbox"></span>
            <span class="request-form__policy-control-label">Заполняя форму я даю согласие на&nbsp;обработку персональных данных</span>
            <span class="request-form__error"></span>
        </label>

        <label>
            <input class="request-form__hidden-input visually-hidden" name="place" value="">
        </label>
    </form>
</section>

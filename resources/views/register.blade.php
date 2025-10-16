@extends('layouts.empty')

@section('title', 'Регистрация пользователя')

@section('content')
    <main class="page__main">
        <form class="register-form" action="{{ route('register.store') }}" method="post">
            @csrf

            <div>
                <label for="register-form__name" class="register-form__label">Имя</label>
                <input class="register-form__input" id="register-form__name" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <span class="request-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="register-form__email" class="register-form__label">Почта</label>
                <input class="register-form__input" id="register-form__email" type="email" name="email" value=" {{ old('email') }}">
                @error('email')
                <span class="request-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="register-form__password" class="register-form__label">Пароль</label>
                <input class="register-form__input" id="register-form__password" type="text" name="password" value="">
                @error('password')
                <span class="request-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="register-form__password-confirmation" class="register-form__label">Повтор пароля</label>
                <input class="register-form__input" id="register-form__password-confirmation" type="text" name="password_confirmation" value="">
                @error('password')
                <span class="request-form__error">{{ $message }}</span>
                @enderror
            </div>

            <button class="register-form__button" type="submit">Зарегистрировать</button>
        </form>
    </main>
@endsection

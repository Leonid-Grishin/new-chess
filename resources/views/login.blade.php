@extends('layouts.empty')

@section('title', 'Вход пользователей')

@section('content')
    <main class="container">
        <h1 class="h1 mt-5 text-center">Вход в панель администратора</h1>

        @if(session('error'))
            <div class="alert alert-danger col-md-4 mx-auto mt-3">{{ session('error') }}</div>
        @endif

        <form class="login-form mx-auto mt-5 col-md-4" action="{{ route('login.auth') }}" method="post">
            @csrf

            <div class="form-floating mb-3">
                <input class="form-control" id="login-form__email" type="email" name="email" value=" {{ old('email') }}" placeholder="Введите логин">
                <label for="login-form__email">Введите логин</label>
                @error('email')
                <div class="text-danger ps-3">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input class="form-control" id="login-form__password" type="text" name="password" value="" placeholder="Введите пароль">
                <label for="login-form__password">Введите пароль</label>
                @error('password')
                <div class="text-danger ps-3">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary col-md-12">Войти</button>
        </form>
    </main>
@endsection

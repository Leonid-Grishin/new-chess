<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email:rfc', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'email.required' => 'Укажите Почту',
            'email.email' => 'Укажите правильный адрес',
            'email.unique' => 'Адрес занят',
            'password.required' => 'Укажите Пароль',
            'password.confirmed' => 'Пароли не совпадают',
        ];

        //Validator::make($request->all(), $rules, $messages);

        $request->validate($rules, $messages);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

        } catch (\Throwable $exception) {
            return Redirect::back()->with('message','произошла ошибка !');
        }

        return redirect()->route('index');
    }

    public function login()
    {
        if(Auth::check()) {
            return \redirect()->route('admin.index');
        } else {
            return view('login');
        }

    }

    public function loginAuth(Request $request)
    {
        $rules = [
            'email' => ['required', 'email:rfc'],
            'password' => ['required'],
        ];

        $messages = [
            'email.required' => 'Укажите Почту',
            'email.email' => 'Укажите правильный адрес',
            'password.required' => 'Укажите Пароль',
        ];

        $request->validate($rules, $messages);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('error', 'Неправильный Логин или Пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}

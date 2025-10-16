<?php

namespace App\Http\Controllers\Api;

use App\Mail\OrderNotificationMail;
use App\Src\DashaMailSubscriber;
use App\Src\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberControllerApi extends \App\Http\Controllers\Controller
{
    public function store(Request $request) {
        if($request->place === 1 || $request->place === '1'){
            return ['baseError' => 'Ошибка'];
        }

        $rules = [
            'name' => 'required',
            'email' => ['required', 'email:rfc'],
/*            'telephone' => ['required', 'regex:/^((8|\+374|\+994|\+995|\+375|\+7|\+380|\+38|\+996|\+998|\+993)[\- ]?)?\(?\d{3,5}\)?[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}(([\- ]?\d{1})?[\- ]?\d{1})?$/'],*/
            'agreement' => ['required', 'accepted'],
            'privacy' => ['required', 'accepted'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'email.required' => 'Укажите Почту',
            'email.email' => 'Укажите правильный адрес',
/*            'telephone.required' => 'Укажите Телефон',
            'telephone.regex' => 'Проверьте правильность телефона',*/
            'agreement.required' => 'Примите соглашение',
            'agreement.accepted' => 'Примите соглашение',
            'privacy.required' => 'Примите согласие',
            'privacy.accepted' => 'Примите согласие',
        ];

        if($request->place != 'Главная > первый экран' and $request->place != 'Школа > первый экран') {
            die();
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $validator->errors()->add('error', 'Ошибки валидации');
        }

        try {
            \App\Models\Subscriber::create($request->all());
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return ['baseError' => $exception->getMessage()];
        }

        //отправляем уведомление в телеграм
        try {
            $telegramMessage = new TelegramMessage(name: $request->name, email: $request->email, /*telephone: $request->telephone,*/ place: $request->place);
            $telegramMessage->sendMessage();
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return ['telegramError' => $exception->getMessage()];
        }

        //отправляем уведомление на почту
        //подправить переменные среды на продакшн
/*        try {
            Mail::to('alraun_work@mail.ru')->send(new OrderNotificationMail($request));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return ['notificationMail' => $exception->getMessage()];
        }*/

        //заносим подписчика в базу DashaMail
        try {
            $dashaMailSubscriber = new DashaMailSubscriber($request->name, $request->email);
            $dashaMailSubscriber->sendSubscriber();
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return ['dashaMailError' => $exception->getMessage()];
        }

        return ['success' => 'Заявка отправлена'];
    }
}

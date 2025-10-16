<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderNotificationMail;
use App\Src\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RequestControllerApi extends Controller
{
    public function store(Request $request) {

        $rules = [
            'name' => 'required',
            'phone' => ['required', 'regex:/^((8|\+374|\+994|\+995|\+375|\+7|\+380|\+38|\+996|\+998|\+993)[\- ]?)?\(?\d{3,5}\)?[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}(([\- ]?\d{1})?[\- ]?\d{1})?$/'],
            'agreement' => ['required', 'accepted'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'phone.required' => 'Укажите Телефон',
            'phone.regex' => 'Проверьте правильность телефона',
            'agreement.required' => 'Примите соглашение',
            'agreement.accepted' => 'Примите соглашение',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $validator->errors()->add('error', 'Ошибки валидации');
        }

        try {
            \App\Models\Request::create($request->all());
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return ['baseError' => $exception->getMessage()];
        }

        //отправляем уведомление в телеграм
        try {
            $telegramMessage = new TelegramMessage(name: $request->name, telephone: $request->phone, place: $request->place);
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

        return ['success' => 'Заявка отправлена'];
    }
}

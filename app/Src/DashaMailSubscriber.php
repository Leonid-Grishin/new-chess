<?php

namespace App\Src;

class DashaMailSubscriber
{
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function sendSubscriber() {

        //Отправляем подписчиков в базу dashamail.ru
        // массив для переменных, которые будут переданы с запросом
        $paramsArray = array(
            'list_id' => '177854',
            'no_conf' => "",
            'notify' => "",
            'email' => $this->email,
            'merge_1' => $this->name,
        );

        // преобразуем массив в URL-кодированную строку
        $vars = http_build_query($paramsArray);

        // создаем параметры контекста
        $options = array(
            'http' => array(
                'method'  => 'POST',  // метод передачи данных
                'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок
                'content' => $vars,  // переменные
            )
        );

        $context  = stream_context_create($options);  // создаём контекст потока

        return file_get_contents('https://forms.dmsubscribe.ru/', false, $context); //отправляем запрос
    }
}

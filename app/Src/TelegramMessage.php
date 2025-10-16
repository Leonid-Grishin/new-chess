<?php

namespace App\Src;

class TelegramMessage
{
    private $name;
    private $telephone;
    private $email;
    private $place;
    private $token = "5627833494:AAHttwlibnbYQIhq37aYuTiPUgT5AJNGzTs";
    private $chat_id = "-705938065";

    public function __construct($name, $telephone = null, $email = null, $place = null)
    {
        $this->name = $name;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->place = $place;
    }

    private function getMessage() {
        $template = null;
        $txt = null;
        $message = null;

        if($this->telephone && !$this->email) {
            $template = array(
                "Имя:" => $this->name,
                "Телефон:" => $this->telephone,
                "Цель:" => $this->place,
            );
        } elseif ($this->email && !$this->telephone) {
            $template = array(
                "Имя:" => $this->name,
                "E-mail:" => $this->email,
/*                "Телефон" => $this->telephone,*/
                "Цель:" => $this->place,
            );
        }

        if($template) {
            foreach($template as $key => $value) {
                $txt .= "<b>".$key."</b> ".$value."%0A";
            };

            if(/*$this->telephone && */!$this->email) {
                $message = '<b>Заявка с сайта:</b>'."%0A" . $txt;
            } elseif ($this->email /*&& $this->telephone*/) {
                $message = '<b>Добавился подписчик:</b>'."%0A" . $txt;
            }
        }

        return $message;
    }

    public function sendMessage() {

        return fopen("https://api.telegram.org/bot{$this->token}/sendMessage?chat_id={$this->chat_id}&parse_mode=html&text={$this->getMessage()}","r");
    }
}

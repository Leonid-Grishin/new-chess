<?php

namespace App\Src;

class Functions
{
    public static function getMonth ()
    {
        $months = [
            1 =>
            'январь',
            'февраль',
            'март',
            'апрель',
            'май',
            'июнь',
            'июль',
            'август',
            'сентябрь',
            'октябрь',
            'ноябрь',
            'декабрь'
        ];
        return date( $months[date( 'n' )] );
    }

    public static function jpgToWebp ($photo)
    {
        return pathinfo($photo)['dirname'] . '/' . pathinfo($photo)['filename'] . '.' . 'webp';
    }

    public static function getSocialClass ($link)
    {
        $host = parse_url($link, PHP_URL_HOST);
        if ($host == 't.me') {
            return 'telegram';
        } elseif ($host == 'vk.com') {
            return 'vk';
        } else {
            return '';
        }
    }

    public static function formatDateSocial ($date)
    {
        $months = [
            1 =>
             'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];

        $time = strtotime($date);
        return date('d', $time) . ' ' . $months[date( 'n', $time )] . ' ' . date('Y', $time) . ' ' . 'года';
    }

    public static function find_value ($filename, $value) {
        $f = fopen($filename, "r");
        $result = 'false';
        while ($row = fgetcsv($f, 0,";")) {
            if ($row[0] == $value) {
                $result = $row[1];
                break;
            }
        }

        fclose($f);
        return $result;
    }

    public static function addPlusToInt ($int) {
        if ($int > 0) {
            return "+{$int}";
        } else {
            return $int;
        }
    }

    public static function translateRoute ($route) {
        return match ($route) {
            'index' => 'Главная',
            'school' => 'Школа',
            'camp' => 'Летний лагерь'
        };
    }

    public static function createWebp ($src, $quality = 100) {
        $dir = pathinfo($src, PATHINFO_DIRNAME);
        $name = pathinfo($src, PATHINFO_FILENAME);
        $dest = "{$dir}/{$name}.webp";
        $is_alpha = false;

        if(mime_content_type($src) == 'image/png') {
            $is_alpha = true;
            $img = imagecreatefrompng($src);
        } elseif (mime_content_type($src) == 'image/jpeg') {
            $img = imagecreatefromjpeg($src);
        } else {
            return $src;
        }

        if($is_alpha) {
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        }

        imagewebp($img, $dest, $quality);
        return $dest;
    }
}

<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        $meta = [
            'title' => 'Такой страницы не существует',
            'description' => 'Перейдите на главную страницу.',
            'og-image' => 'images/camp/camp-og.jpg'
        ];
        return response()->view('errors.404', ['meta' => $meta,], 404);
    }
}

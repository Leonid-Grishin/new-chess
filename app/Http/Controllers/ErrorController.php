<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        return response()->view('errors.404', [], 404);
    }
}

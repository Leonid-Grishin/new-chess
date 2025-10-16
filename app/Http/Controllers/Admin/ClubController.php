<?php

namespace App\Http\Controllers\Admin;

class ClubController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view('admin.club');
    }
}

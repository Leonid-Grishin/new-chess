<?php

namespace App\Http\Controllers\Admin;

class AdminController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view('admin.index');
    }
}

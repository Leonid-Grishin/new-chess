<?php

namespace App\Http\Controllers\Admin;

class SchoolController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view('admin.school');
    }
}

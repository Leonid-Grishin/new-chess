<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function student(Student $student) {
        return view('student', ['student' => $student]);
    }
}

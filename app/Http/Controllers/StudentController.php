<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('users.students.create');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        return view('users.login');
    }
    public function create()
    {
        return view('users.create');
    }
    public function store($request)
    {
        User::create($request->validated());
        return redirect()->route('students.index');
    }
}

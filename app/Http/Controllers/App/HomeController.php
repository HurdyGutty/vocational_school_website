<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.index');
    }

    public function login(): View
    {
        return view('landing.login');
    }

    public function register(): View
    {
        return view('landing.register');
    }
}

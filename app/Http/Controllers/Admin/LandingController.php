<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class LandingController extends Controller
{
    public function index()
    {
        return view('layout-admin-site.master');
    }


}

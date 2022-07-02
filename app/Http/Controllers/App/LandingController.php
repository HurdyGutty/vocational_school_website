<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        return view('layout-dashboard-site.master');
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        return view('layout-dashboard-site.master');
    }


}

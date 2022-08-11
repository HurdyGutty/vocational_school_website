<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.index');
    }
    public function explore(Request $request): View
    {
        $classes = Subject::where('name','like',"%{$request->search}%")->paginate(6)
        ;
        return view('explore.explore',[
            'classes' => $classes,
        ]);
    }


}
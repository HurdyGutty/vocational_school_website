<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Major\StoreRequest;
use App\Models\Major;
use App\Models\MajorSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule as ValidationRule;

class MajorController extends Controller
{
    public function __construct()
    {
        $majors = Major::all();
        View::share('majors', $majors);
        $subjects = Subject::get();
        View::share('subjects', $subjects);
    }
    public function index()
    {
        $subject_major = Major::get()->map(function ($major) {
            $major->subject_name = 
                Major::find($major->id)->subjects->pluck('subject_id')
                ->map(function($subject){
                    return $subject = Subject::find($subject)->name;
                })
                ->toArray()
            ;
            return $major;
        });
        return view('majors.index',[
            "subject_major" => $subject_major,
        ]);
    }
    public function create()
    {
        return view('majors.create');
    }
    public function store(StoreRequest $request)
    {
        
        $request->validate([
            "subject_id" => [
                'bail',
                'required',
                'integer',
                ValidationRule::exists(Subject::class, 'id')
            ],
        ]);
        Major::create($request->validated());
        MajorSubject::create($request->validated());
        return redirect()->route('majors.index');
    }
    
}
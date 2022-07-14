<?php

namespace App\Http\Controllers\Admin;

use App\Events\Major\MajorUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Major\DeleteRequest;
use App\Http\Requests\Major\StoreRequest;
use App\Http\Requests\Major\UpdateRequest;
use App\Models\Major;
use App\Models\Subject;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class MajorController extends Controller
{
    public function __construct()
    {
        $majors = Major::all();
        View::share('majors', $majors);
        $subjects = Subject::get();
        View::share('subjects', $subjects);
        $route = Route::currentRouteName();
        View::share('route', $route);
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
    public function show(Major $major)
    {
        return view('majors.show',[
            'major' => $major,
            'subject_arr' => Subject::find($major->subjects()->getResults()->pluck('subject_id'))
            ->mapwithKeys(function ($subject) {
                return [$subject->id => $subject->name];
            })->toArray(),
        ]);
    }
    public function create()
    {
        return view('majors.create');
    }
    public function store(StoreRequest $request)
    {   
        $data = $request->validated();        
        $subject_id_arr = array_map(function($subject_id){
            return [
                'subject_id' => $subject_id
            ];
        },$data['subjects']);
        
        Major::firstOrCreate(Arr::except($data,['subjects']))
        ->Subjects()->createMany($subject_id_arr);
        
        return redirect()->route('admin.major.index');
    }
    public function edit(Major $major)
    {
        return view('majors.edit',[
            'major' => $major,
            'subject_arr' => Subject::find($major->subjects()->getResults()->pluck('subject_id'))
            ->mapwithKeys(function ($subject) {
                return [$subject->id => $subject->name];
            })->toArray(),
        ]);
    }
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        
        event(new MajorUpdate($data));
        Major::updateorCreate(Arr::except($data,['subjects']));
        return redirect()->route('admin.major.index');
    }

    public function delete(DeleteRequest $request, Major $major)
    {
        $major->delete();
        return redirect()->route('admin.major.index');
    }
}
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
        $subject_major = Major::with('subjects')
        ->get()
        ->map(function ($major) {
            $major->subject_name = $major->subjects->pluck('name')->toArray();
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
            'subject_arr' => $major->subjects()->pluck('name','id')->toArray(),
        ]);
    }
    public function create()
    {
        return view('majors.create');
    }
    public function store(StoreRequest $request)
    {   
        $data = $request->validated();
            if (isset($data['image'])) {
                $image = saveImage($data['image']);
                $data = Arr::add($data, 'image_id', $image->id);
            }
        
        $major_arr = Major::firstOrCreate(Arr::except($data,['subjects','image']))
                        ->subjects()
                        ->attach($data['subjects']);
        
        return redirect()->route('admin.major.index');
    }
    public function edit(Major $major)
    {
        return view('majors.edit',[
            'major' => $major,
            'subject_arr' => $major->subjects()->pluck('name','id')->toArray(),
        ]);
    }
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $image = saveImage($data['image']);
            $data = Arr::add($data, "image_id", $image->id);
        }
        event(new MajorUpdate(Arr::except($data,['image'])));
        Major::updateorCreate(['id'=>$data['id']],Arr::except($data,['subjects','image']));
        return redirect()->route('admin.major.index');
    }

    public function delete(DeleteRequest $request, Major $major)
    {
        $major->delete();
        return redirect()->route('admin.major.index');
    }
}
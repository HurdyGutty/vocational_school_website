<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\ClassModel;
use App\Models\Image;
use App\Models\Major;
use App\Models\Subject;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class SubjectController extends Controller
{
    public function __construct()
    {
        $majors = Major::all();
        View::share('majors', $majors);
        $subjects = Subject::get();
        View::share('subjects', $subjects);
        $classes = ClassModel::get();
        View::share('classes', $classes);
        $route = Route::currentRouteName();
        View::share('route', $route);
    }
    public function index()
    {
        return view('subjects.index');
    }
    public function show(Subject $subject)
    {
        return view('subjects.show',[
            'subject' => $subject,
            ]);
    }
    public function create()
    {
        return view('subjects.create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
            if (isset($data['image'])) {
                $image = Image::firstorCreate(['source' => base64_encode(file_get_contents($data['image']))]);
                $data = Arr::add($data, 'image_id', $image->id);
            }
        Subject::firstOrCreate(Arr::except($data,['image']));
        return redirect()->route('admin.subject.index');
    }
    public function edit(Subject $subject)
    {
        return view('subjects.edit',[
            'subject' => $subject,
        ]);
    }
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
            if (isset($data['image'])) {
                $image = Image::firstorCreate(['source' => base64_encode(file_get_contents($data['image']))]);
                $data = Arr::add($data, 'image_id', $image->id);
            }
        Subject::updateorCreate(['id' => $data['id']],Arr::except($data,['image']));
        return redirect()->route('admin.subject.index');
    }
}
<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.index');
    }
    public function explore(SearchRequest $request): View
    {
        $search = $request->validated();
        !empty($search)?
        $subjects = Subject::withcount(['classes' => fn($query) => $query->where('status',1)])
        ->where('name','like',"%{$search['search']}%")
        ->whereHas('classes' , fn($query) => $query->where('status',1))
        ->paginate(9)
        :$subjects = Subject::withcount(['classes' => fn($query) => $query->where('status',1)])
        ->whereHas('classes' , fn($query) => $query->where('status',1))
        ->paginate(9)
        ;
        return view('explore.explore',[
            'subjects' => $subjects,
        ]);
    }
    public function showClass(Subject $subject, SearchRequest $request): View
    {
        $search = $request->validated();
        !empty($search)?
        $classes = ClassModel::with('schedules','teacher:id,name')->where('subject_id',$subject->id)
        ->where('status',1)
        ->has('teacher.name','like',"%{$search['search']}%")
        ->get()
        :
        $classes = ClassModel::with('schedules','teacher:id,name')->where('subject_id',$subject->id)
        ->where('status',1)
        ->get()
        ;
        return view('explore.showClass',[
            'classes' => $classes,
            'subject' => $subject,
        ]);
    }

}
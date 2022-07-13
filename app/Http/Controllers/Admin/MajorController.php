<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Major\DeleteRequest;
use App\Http\Requests\Major\StoreRequest;
use App\Http\Requests\Major\UpdateRequest;
use App\Models\Major;
use App\Models\MajorSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
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
        // $subjects_id_names = Subject::get()->mapwithKeys(function ($subject) {
        //     return [$subject->id => $subject->name];
        // })->toArray();
        // View::share('subjects_id_names',$subjects_id_names);
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
            $request->merge([
                'subjects' => explode(',',$request->subjects),
            ]);
            $subject_data = Validator::make($request->all('subjects'),[
                "subjects.*" => [
                    'bail',
                    'required',
                    'integer',
                    ValidationRule::exists(Subject::class, 'id'),
                ],
            ],
            [
                'required' => 'Môn chưa nhập',
                'exists' => 'Môn không có trong danh sách môn',
                'integer' => 'Môn nhập sai',
            ])->validate();
        
        $subject_id_arr = array_map(function($subject_id){
            return [
                'subject_id' => $subject_id
            ];
        },$subject_data['subjects']);
        
        Major::firstOrCreate($request->validated())->Subjects()->createMany($subject_id_arr);
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
        $request->merge([
            'subjects' => explode(',',$request->subjects),
        ]);
        $subject_data = Validator::make($request->all('subjects'),[
            "subjects.*" => [
                'bail',
                'required',
                'integer',
                ValidationRule::exists(Subject::class, 'id'),
            ],
        ],
        [
            'required' => 'Môn chưa nhập',
            'exists' => 'Môn không có trong danh sách môn',
            'integer' => 'Môn nhập sai',
        ])->validate();
        $original_arr = MajorSubject::where('major_id', '=' , $request->id)->pluck('subject_id');
        
        $subject_id_arr = collect(array_merge(...array_values($subject_data)));
        $add_subjects = $subject_id_arr->diff($original_arr)->all();
        $delete_subjects = $original_arr->diff($subject_id_arr)->all();
        foreach ($add_subjects as $add_subject) {
            MajorSubject::firstOrCreate([
                'major_id' => $request->id,
                'subject_id' => $add_subject,
            ]);
        }
        foreach ($delete_subjects as $delete_subjects) {
                MajorSubject::where([
                    'major_id' => $request->id,
                    'subject_id' => $delete_subjects,
                    ])->delete();
        }
        Major::updateorCreate($request->validated());
        return redirect()->route('admin.major.index');
    }

    public function delete(DeleteRequest $request, Major $major)
    {
        $major->delete();
        return redirect()->route('admin.major.index');
    }
}
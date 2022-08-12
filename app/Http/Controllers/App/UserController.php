<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Class\storeClassRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use App\Services\CreateClassAndScheduleForTeacherService;
use App\Services\GetStudentClassService;
use App\Services\GetTeacherClassService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (getAccount()->role){
            $class_info = (new GetTeacherClassService)->getClasses()
            ;
        } else {
            $class_info = (new GetStudentClassService)->getClasses();
        };
        return view('users.index',[
            'classes' => $class_info
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createClass()
    {
        $subjects = Subject::pluck('name','id');
        return view('users.teachers.create',
        [
            'subjects' => $subjects,
        ]
    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeClass(storeClassRequest $request)
    {
        $shedule_data = $request->validated();
        $teacher_id = getAccount()->id;

        try{
            $new_class_array = DB::Transaction(function () use ($shedule_data,$teacher_id) {
                $new_service = (new CreateClassAndScheduleForTeacherService($shedule_data));
                $new_class = $new_service->createClassAndReturnClassId($teacher_id);
                $new_schedules = $new_service->createScheduleAndReturn(2);
                return $new_class_array = [
                    $new_class->id => $new_schedules
                ];
        });
        } catch (\Exception $ex) {
            return redirect()->route('app.user.index')->with([
                'storeErrorMessage' => 'Không tạo được lớp',
            ]);
        }
        return redirect()->route('app.user.index')->with([
            'new_class' => ClassModel::find(key($new_class_array))->name,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showClass(ClassModel $class)
    {
        if (getAccount()->role){
            $class_info = (new GetTeacherClassService)->getOneClass($class);
        } else {
            $class_info = (new GetStudentClassService)->getOneClass($class);
        }
        return view('users.showClass',[
            'class' => $class,
            'class_info' => $class_info,
            ]);
    }

    public function registerClass(ClassModel $class)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(getAccount()->id);
        return view('users.edit',[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
            if (isset($data['image'])) {
                $image = saveImage($data['image']);
                $data = Arr::add($data, 'image_id', $image->id);
            }
        User::updateorCreate(['id' => getAccount()->id],Arr::except($data,['image']));
        return redirect()->route('admin.subject.index');
    }

}
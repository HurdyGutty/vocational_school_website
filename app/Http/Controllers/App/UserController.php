<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            $class_info = ClassModel::where('teacher_id','=', getAccount()->id)
            ->with(['schedules' =>
                        fn($query) => $query
                                    ->select('id','class_id','date','start_time','end_time')
                                    ->where('date','>', Carbon::today())
                                    ->orderBy('date')
                                    ])
            ->get()
            ->map(function($class){
                $class->schedule_date = $class->schedules->pluck('date')->first();
                $class->start_time = $class->schedules->pluck('start_time')->first();
                $class->end_time = $class->schedules->pluck('end_time')->first();
                $class->teacher_name = getAccount()->name;
                unset($class->schedules);
                return $class;
            })
            ;
        } else {
            $class_info = ClassModel::
            with(['schedules' => 
                        fn($query) => $query
                                    ->select('id','class_id','date','start_time','end_time')
                                    ->where('date','>', Carbon::today())
                                    ->orderBy('date')
                                    ,
                    'subscriptions',
                    'teacher:id,name'])
            ->wherehas('subscriptions',
                        fn($query) => $query
                                    ->where('student_id',getAccount()->id)
                                    ->whereNotNull('admin_id'))
            ->get()
            ->map(function($class){
                $class->schedule_date = $class->schedules->pluck('date')->first();
                $class->start_time = $class->schedules->pluck('start_time')->first();
                $class->end_time = $class->schedules->pluck('end_time')->first();
                $class->teacher_name = $class->teacher->name;
                unset($class->teacher);
                unset($class->schedules);
                return $class;
            })
            ;
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
    public function storeClass(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showClass(ClassModel $class)
    {
        if (getAccount()->role){
            $class_info = $class->with(['schedules' =>
            fn($query) => $query
                        ->select('id','class_id','period','date','start_time','end_time')
                        ->where('date','>', Carbon::today())
                        ->orderBy('date')
                        ])
            ->first();
        } else {
            $date_next_class = Schedule::addSelect('date')
                                ->where(
                                    'class_id','=',$class->id
                                )
                                ->where('date','>=', Carbon::today())
                                ->orderBy('date')
                                ->take(1)
                                ->value('date');
            $class_info = $class->with(['schedules' =>
            fn($query) => $query
                        ->select('id','class_id','period','date','start_time','end_time')
                        ->where('date','<=', $date_next_class)
                        ->orderBy('date')],
                        'teacher:name',
                        'subject:name')
            ->where('id',$class->id)
            ->first();
        }
        return view('users.showClass',[
            'class' => $class,
            'class_info' => $class_info,
            ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
}
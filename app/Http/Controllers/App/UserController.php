<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                                    ->where('date','>', Carbon::today())],)
            ->get()
            ->map(function($class){
                $class->schedule_date = $class->schedules()->pluck('date')->sortBy('date')->first();
                $class->start_time = $class->schedules->pluck('start_time')->first();
                $class->end_time = $class->schedules->pluck('end_time')->first();
                $class->teacher_name = getAccount()->name;
                unset($class->schedules);
                return $class;
            });
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
                $class->schedule_date = $class->schedules()->pluck('date')->first();
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
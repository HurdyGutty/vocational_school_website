<?php

namespace App\Services;

use App\Contracts\GetClassesInterface;
use App\Models\ClassModel;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class GetStudentClassService implements GetClassesInterface
{
    private $first_query;

    public function __construct()
    {
    
    }
    

    public function getClasses(): Collection
    {
        return ClassModel::
        with(['schedules' => 
                    fn($query) => $query
                                ->select('id','class_id','date','start_time','end_time')
                                ->where('date','>', Carbon::today())
                                ->orderBy('date')
                ],
                'subscriptions',
                'teacher:id,name')
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
    }

    public function getOneClass(int|ClassModel $class_id): ClassModel
    {
        $class_id = $class_id??ClassModel::find($class_id);
        $date_next_class = Schedule::addSelect('date')
                                ->where(
                                    'class_id','=',$class_id->id
                                )
                                ->where('date','>=', Carbon::today())
                                ->orderBy('date')
                                ->take(1)
                                ->value('date');
        return $class_info = ClassModel::with(['schedules' =>
        fn($query) => $query
                    ->select('id','class_id','period','date','start_time','end_time')
                    ->where('date','<=', $date_next_class)
                    ->orderBy('date')],
                    'teacher:name',
                    'subject:name')
        ->where('id',$class_id->id)
        ->first();
    }

}
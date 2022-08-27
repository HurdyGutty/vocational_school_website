<?php

namespace App\Services;

use App\Contracts\GetClassesInterface;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Collection;

class GetClassAdminService implements GetClassesInterface
{
    private $classModel;

    public function __construct()
    {
        $this->classModel = ClassModel::class;
    }

    public function getClasses(): Collection
    {
        return ClassModel::where('status', 0)
            ->with('teacher:id,name', 'subject:id,name')
            ->with([
                'xschedules' =>
                fn ($q) => $q->select('id', 'class_id', 'date', 'start_time', 'end_time')
            ])
            ->get()
            ->map(function ($class) {
                $class->schedule_date = $class->schedules->take(2)->pluck('date');
                $class->start_time = $class->schedules->take(2)->pluck('start_time');
                $class->end_time = $class->schedules->take(2)->pluck('end_time');
                $class->date_time = $class->schedules->take(2)->map->only(['date', 'start_time', 'end_time'])->values()->toArray();
                $class->timetable = (new TimetableServices($class->date_time))->getAllWeekDaysWithTime();
                $class->teacher_name = $class->teacher->name;
                unset($class->teacher);
                unset($class->schedules);
                return $class;
            });
    }

    public function getOneClass(int|ClassModel $class_id): ClassModel
    {
        $class_id = $class_id ?? ClassModel::find($class_id);
        return ClassModel::with([
            'xschedules' =>
            fn ($query) => $query
                ->select('id', 'class_id', 'date', 'start_time', 'end_time')
        ])
            ->where('id', $class_id)
            ->where('status', 0)
            ->first();
    }
}
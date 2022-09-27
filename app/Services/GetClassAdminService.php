<?php

namespace App\Services;

use App\Contracts\GetClassesInterface;
use App\Models\ClassModel;
use App\Traits\Paginatable;
use Illuminate\Database\Eloquent\Collection;

class GetClassAdminService
{
    use Paginatable;
    private $classModel;

    public function __construct()
    {
    }

    public function getClasses(): Collection
    {
        return ClassModel::where('status', '!=', 0)
            ->with(
                'xschedules',
                'subject:id,name'
            )
            ->withCount(
                ['subscriptions' =>
                fn ($q) => $q->whereNotNull('admin_id')]
            )
            ->orderBy('subject_id')
            ->get()
            ->map(function ($class) {
                $class->subject_name = $class->subject->name;
                return $class;
            });
    }

    public function getAwaitingClasses(): Collection
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
        $class =  ClassModel::with([
            'xschedules' =>
            fn ($query) => $query
                ->select('id', 'period', 'class_id', 'date', 'start_time', 'end_time')
        ])
            ->with('teacher:id,name')
            ->with('subject:id,name')
            ->where('id', $class_id->id)
            ->first();
        return $class;
    }
}
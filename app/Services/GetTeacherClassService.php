<?php

namespace App\Services;

use App\Contracts\GetClassesInterface;
use App\Models\ClassModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class GetTeacherClassService implements GetClassesInterface
{
    private $first_query;

    public function __construct()
    {
        $this->first_query = ClassModel::where('teacher_id', '=', getAccount()->id)
            ->with([
                'schedules' =>
                fn ($query) => $query
                    ->select('id', 'class_id', 'date', 'start_time', 'end_time')
                    ->where('date', '>', Carbon::today())
                    ->orderBy('date')
            ]);
    }


    public function getClasses(): Collection
    {
        return $this->first_query->get()
            ->map(function ($class) {
                $class->schedule_date = $class->schedules->pluck('date')->first();
                $class->start_time = $class->schedules->pluck('start_time')->first();
                $class->end_time = $class->schedules->pluck('end_time')->first();
                $class->teacher_name = getAccount()->name;
                unset($class->schedules);
                return $class;
            });
    }

    public function getOneClass(int|ClassModel $class_id): ClassModel
    {
        $class_id = $class_id->id ?? $class_id;
        return $this->first_query->where('id', $class_id)
            ->first();
    }
}
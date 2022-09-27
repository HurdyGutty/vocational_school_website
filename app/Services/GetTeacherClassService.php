<?php

namespace App\Services;

use App\Contracts\GetClassesInterface;
use App\Enums\WeekdayConversion;
use App\Models\ClassModel;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class GetTeacherClassService implements GetClassesInterface
{
    private $first_query;

    public function __construct()
    {
    }

    public function getUncheckClasses()
    {
        return ClassModel::where('teacher_id', '=', getAccount()->id)
            ->where('status', 0)
            ->joinSub(
                Schedule::select('class_id', 'date', 'start_time', 'end_time'),
                'schedule',
                fn ($j) => $j->on('classes.id', '=', 'schedule.class_id')
            )
            ->get()
            ->groupBy('class_id')
            ->map(
                fn ($q) => $q->take(2)->map(
                    function ($schedule) {
                        $weekday = WeekdayConversion::from(Carbon::parse($schedule->date)->isoWeekday())->showIsoWeekday();
                        $schedule->timetable = $weekday . ' ' . $schedule->start_time . '-' . $schedule->end_time;
                        unset($schedule->date, $schedule->start_time, $schedule->end_time);
                        return $schedule;
                    }
                )
                    ->reduce(function ($carry, $item) {
                        $keys = array_keys($item->toArray());
                        if ($carry->count() == 0) {
                            $carry = $item;
                        } else {
                            foreach ($keys as $key) {
                                if ($carry->{$key} == $item->{$key}) {
                                    $carry->{$key} = $item->{$key};
                                } else {
                                    $carry->{$key} = [$carry->{$key}, $item->{$key}];
                                }
                            }
                        }
                        return $carry;
                    }, collect([]))
            );
    }

    public function getClasses(): Collection
    {
        return ClassModel::where('teacher_id', '=', getAccount()->id)
            ->whereIn('status', [1, 2, 3])
            ->with([
                'schedules' =>
                fn ($query) => $query
                    ->select('id', 'class_id', 'date', 'start_time', 'end_time')
                    ->where('date', '>', Carbon::today())
                    ->orderBy('date')
            ])
            ->get()
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
        return ClassModel::where('teacher_id', '=', getAccount()->id)
            ->where('id', $class_id)
            ->with([
                'schedules' =>
                fn ($query) => $query
                    ->select('id', 'class_id', 'date', 'start_time', 'end_time')
                    ->where('date', '>', Carbon::today())
                    ->orderBy('date')
            ])
            ->first();
    }
}
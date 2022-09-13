<?php

namespace App\Services;

use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Subscription;
use Illuminate\Pagination\LengthAwarePaginator;

class CalendarService
{
    public function __construct(private int $role, private int $user_id)
    {
    }

    public function getClasses(): LengthAwarePaginator
    {
        if ($this->role == 1) {
            return ClassModel::select('id', 'name')
                ->where('teacher_id', $this->user_id)
                ->whereNotIn('status', [0, 4])
                ->paginate(6);
        } else {
            return ClassModel::select('id', 'name')
                ->joinSub(
                    Subscription::select('class_id')
                        ->where('student_id', $this->user_id)
                        ->whereNotNull('admin_id'),
                    's',
                    fn ($j) => $j->on('s.class_id', '=', 'classes.id')
                )
                ->paginate(6);
        }
    }

    public static function getSchedule($class_id): array
    {
        return Schedule::select('class_id as id', 'period', 'date', 'start_time', 'end_time')
            ->where('class_id', $class_id)
            ->get()
            ->map(function ($schedule) {
                $schedule->title = 'Buổi ' . $schedule->period;
                $schedule->start = $schedule->date . ' ' . $schedule->start_time;
                $schedule->end = $schedule->date . ' ' . $schedule->end_time;
                unset($schedule->period, $schedule->date, $schedule->start_time, $schedule->end_time);
                return $schedule;
            })
            ->toArray();
    }
}
<?php

namespace App\Services;

use App\Models\Schedule;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class CheckScheduleService
{
    private $new_class;
    private $user;

    public function __construct(int $class_id, int $user_id)
    {
        $this->new_class = $class_id;
        $this->user = $user_id;
    }

    public function StudentSchedule(): Collection
    {
        return Schedule::wherehas(
            'class',
            fn ($query) => $query
                ->whereHas(
                    'subscriptions',
                    fn ($q) =>
                    $q->select('student_id', 'admin_id')
                        ->where('student_id', $this->user)
                        ->whereNotNull('admin_id')
                )
        )
            ->get()
            ->map(
                function ($schedule) {
                    $schedule->start_datetime = $schedule->date . ' ' . $schedule->start_time;
                    return $schedule;
                }
            );
    }

    public function targetedSudentSchedule(): Collection
    {
        return Schedule::wherehas(
            'class',
            fn ($query) => $query->where('id', $this->new_class)
                ->whereRelation('subscriptions', 'student_id', $this->user)
        )
            ->get()
            ->map(
                function ($schedule) {
                    $schedule->start_datetime = $schedule->date . ' ' . $schedule->start_time;
                    return $schedule;
                }
            );
    }

    public function checkStudent(): bool
    {
        $time_array = $this->StudentSchedule()->pluck('start_datetime')->toArray();
        $new_time_array = $this->targetedSudentSchedule()->pluck('start_datetime')->toArray();
        $array_intersect = array_intersect($time_array, $new_time_array);
        return empty($array_intersect) ? true : false;
    }

    public function TeacherApprovedClassesSchedule(): Collection
    {
        return Schedule::wherehas(
            'class',
            fn ($query) => $query->where('teacher_id', $this->user)
                ->whereIn('status', [1, 2])
        )
            ->get()
            ->map(
                function ($schedule) {
                    $schedule->start_datetime = $schedule->date . ' ' . $schedule->start_time;
                    return $schedule;
                }
            );
    }

    public function targetedTeacherSchedule(): Collection
    {
        return Schedule::wherehas(
            'class',
            fn ($query) => $query->where('teacher_id', $this->user)
                ->where('id', $this->new_class)
        )
            ->get()
            ->map(
                function ($schedule) {
                    $schedule->start_datetime = $schedule->date . ' ' . $schedule->start_time;
                    return $schedule;
                }
            );
    }

    public function checkTeacher(): bool
    {
        $approved = $this->TeacherApprovedClassesSchedule()->pluck('start_datetime')->toArray();
        $target = $this->targetedTeacherSchedule()->pluck('start_datetime')->toArray();
        $result = array_intersect($approved, $target);
        return empty($result) ? true : false;
    }

    private function no_dupes(array $time_array)
    {
        return count($time_array) === count(array_flip($time_array));
    }
}
<?php

namespace App\Services;

use App\Enums\StartTime;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Subject;
use Carbon\Carbon;

class CreateClassAndScheduleForTeacherService
{
    private $subject_id;
    private $week_day_1;
    private $week_day_2;
    private $slot_1;
    private $slot_2;

    public function __construct(array $shedule_data)
    {
        $this->subject_id = $shedule_data['subject'];
        $this->week_day_1 = $shedule_data['weekday1'];
        $this->week_day_2 = $shedule_data['weekday2'];
        $this->slot_1 = $shedule_data['time1'];
        $this->slot_2 = $shedule_data['time2'];

        $this->class_name = $this->getClassName($this->subject_id);
        $this->closest_weekday_1 = $this->getClosestDay($this->week_day_1)->copy()->addWeeks(2);
        $this->closest_weekday_2 = $this->getClosestDay($this->week_day_2)->copy()->addWeeks(2);
        $this->time_1 = $this->getStartTime($this->slot_1);
        $this->time_2 = $this->getStartTime($this->slot_2);

        $this->date_start = $this->getDateStart($this->closest_weekday_1, $this->closest_weekday_2);
    }

    private function getClassName(int $subject): string
    {
        return Subject::findorFail($subject)->name
            . " - " .
            sprintf("%03d", ClassModel::where('subject_id', $subject)
                ->count() + 1);
    }

    private function getClosestDay(?int $weekday): ?Carbon
    {
        return (!empty($weekday))
            ? Carbon::now()->next(intval($weekday))
            : null;
    }

    private function getStartTime(?int $time): ?Carbon
    {
        return (!empty($time))
            ? Carbon::createFromTimeString(StartTime::from($time)->showRole())
            : null;
    }

    public function getDateStart(?Carbon $closest_weekday_1, ?Carbon $closest_weekday_2): Carbon
    {
        if (!empty($closest_weekday_1) && !empty($closest_weekday_2)) {
            return ($closest_weekday_1 < $closest_weekday_2)
                ? $closest_weekday_1
                : $closest_weekday_2;
        } else {
            return $closest_weekday_1 ?? $closest_weekday_2;
        }
    }

    public function createClassAndReturnClassId(int &$teacher_id): ClassModel
    {
        return $this->class_created = ClassModel::create(
            [
                'name' => $this->class_name,
                'date_start' => $this->date_start,
                'teacher_id' => $teacher_id,
                'subject_id' => $this->subject_id,
            ]
        );
    }

    public function createScheduleAndReturn(int $period, int $class_id = null): array
    {
        $class_id = $this->class_created->id ?? $class_id;
        $created_schedule = [];

        $first_start_time = ($this->date_start === $this->closest_weekday_1) ? $this->time_1 : $this->time_2;
        $second_date = ($first_start_time === $this->closest_weekday_1) ? $this->closest_weekday_2 : $this->closest_weekday_1;
        $second_start_time = ($first_start_time === $this->time_1) ? $this->time_2 : $this->time_1;

        $created_schedule[] = Schedule::create(
            [
                'class_id' => $class_id,
                'period' => 1,
                'date' => $this->date_start,
                'start_time' => $first_start_time,
                'end_time' => $first_start_time->copy()->addHours(2),
            ]
        )->id;

        if ($period >= 2) {
            if (empty($this->closest_weekday_1) || empty($this->closest_weekday_2)) {
                $created_schedule[] = Schedule::create(
                    [
                        'class_id' => $class_id,
                        'period' => 2,
                        'date' => $this->date_start->addDays(7),
                        'start_time' => $first_start_time,
                        'end_time' => $first_start_time->copy()->addHours(2),
                    ]
                )->id;
            } else {
                $created_schedule[] = Schedule::create(
                    [
                        'class_id' => $class_id,
                        'period' => 2,
                        'date' => $second_date,
                        'start_time' => $second_start_time,
                        'end_time' => $second_start_time->copy()->addHours(2),
                    ]
                )->id;
            }
        }

        if ($period > 2) {
            if (empty($this->closest_weekday_1) || empty($this->closest_weekday_2)) {
                $date_next_week = $this->date_start->addDays(7);
                for ($i = 3; $i <= $period; ++$i) {
                    $date_next_week = $date_next_week->addDays(7);
                    $created_schedule[] = Schedule::create(
                        [
                            'class_id' => $class_id,
                            'period' => $i,
                            'date' => $date_next_week,
                            'start_time' => $first_start_time,
                            'end_time' => $first_start_time->copy()->addHours(2),
                        ]
                    )->id;
                }
            } else {
                $first_date = $this->date_start;
                for ($i = 3; $i <= $period; $i++) {
                    $first_date = $first_date->addDays(7);
                    $second_date = $second_date->addDays(7);

                    $created_schedule[] = Schedule::create(
                        [
                            'class_id' => $class_id,
                            'period' => $i,
                            'date' => $first_date,
                            'start_time' => $first_start_time,
                            'end_time' => $first_start_time->copy()->addHours(2),
                        ]
                    )->id;
                    ++$i;
                    if ($i <= $period) {
                        $created_schedule[] = Schedule::create(
                            [
                                'class_id' => $class_id,
                                'period' => $i,
                                'date' => $second_date,
                                'start_time' => $second_start_time,
                                'end_time' => $second_start_time->copy()->addHours(2),
                            ]
                        )->id;
                    }
                }
            }
        }
        return $created_schedule;
    }
    public function resetSchedule(int $class_id = null): void
    {
        $class_id = $this->class_created->id ?? $class_id;
        Schedule::where('class_id', $class_id)->delete();
    }
}
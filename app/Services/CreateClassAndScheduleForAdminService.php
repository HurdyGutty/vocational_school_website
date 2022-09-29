<?php

namespace App\Services;

use App\Models\ClassModel;
use App\Models\Schedule;
use Carbon\Carbon;

class CreateClassAndScheduleForAdminService
{
    private $class_id;
    private $period;
    public $schedule;
    public function __construct()
    {
    }

    public function setCondition(int $class_id, int $period = 2): self
    {
        $this->class_id = $class_id;
        $this->period = $period;
        $this->schedule =  Schedule::where('class_id', $this->class_id)->orderBy('period');
        return $this;
    }

    public function updateSchedule(): self
    {
        $this->number_of_created_schedule = $this->schedule->count();

        $date_taken = [];
        $this->update = $this->schedule->get()->map(function ($schedule) use (&$date_taken) {
            $schedule->date = Carbon::now()->copy()->addWeeks(2)->next(Carbon::parse($schedule->date)->weekday())->toDateString();

            while (in_array($schedule->date, $date_taken)) {
                $schedule->date = Carbon::parse($schedule->date)->copy()->addWeek()->toDateString();
            }

            $date_taken[] = $schedule->date;

            return $schedule;
        });

        $this->update->each->save();

        if ($this->period > $this->number_of_created_schedule) {
            $this->addable_schedule = $this->period - $this->number_of_created_schedule;
            $this->insertMoreSchedule();
        } else {
            $this->removable_schedule = $this->number_of_created_schedule - $this->period;
            $this->deleteOverflowSchedule();
        }
        return $this;
    }
    private function insertMoreSchedule()
    {

        $schedule_datetime = $this->update->map->only('period', 'date', 'start_time', 'end_time')->values()->toArray();

        //get dates in the first week
        foreach ($schedule_datetime as $key => $value) {
            if (date_diff(date_create($schedule_datetime[0]['date']), date_create($value["date"])) < 7) {
                $values_in_first_week[] =  $value;
            }
        }

        for ($i = 0; $i < $this->addable_schedule; $i++) {
            $index = $this->number_of_created_schedule %  count($values_in_first_week);
            $week = ($this->number_of_created_schedule % count($values_in_first_week) == 0)
                ? ($this->number_of_created_schedule / count($values_in_first_week))
                : floor($this->number_of_created_schedule / count($values_in_first_week));
            $period = $this->number_of_created_schedule + 1 + $i;
            $date = $values_in_first_week[$index]['date'];
            $start_time = $values_in_first_week[$index]['start_time'];
            $end_time = $values_in_first_week[$index]['end_time'];

            Schedule::insert([
                'class_id' => $this->class_id,
                'period' => $period,
                'date' => Carbon::createFromformat('Y-m-d', $date)->copy()->addDays(7 * $week),
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
        }
    }

    private function deleteOverflowSchedule()
    {
        $this->update->take(-$this->removable_schedule)->each->delete();
    }

    public function updateClassStatus(): self
    {
        ClassModel::where('id', $this->class_id)->update('status', 1);
        return $this;
    }

    public function updateClassDate(): self
    {
        $date_start = $this->update->first()->date;
        $date_end = Schedule::where('class_id', $this->class_id)->orderBy('period')->last()->date;

        ClassModel::where('id', $this->class_id)
            ->update([
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);

        return $this;
    }
}
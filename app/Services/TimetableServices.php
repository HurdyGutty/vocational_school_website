<?php

namespace App\Services;

use Carbon\Carbon;

class TimetableServices
{
    private $date;
    private $time;
    public $timetable;


    //param $timetable = [0 => ['date'=>...,'start_time'=>...,'end_time'=>...],...]
    public function __construct(array $timetable)
    {
        $this->timetable = array_map(
            fn ($timetable) => [
                'date' => $timetable['date'],
                'week_day' => ucfirst(Carbon::createFromFormat('Y-m-d', $timetable['date'])->locale('vi_VN')->dayName),
                'time' => $timetable['start_time'] . '-' . $timetable['end_time']
            ],
            $timetable
        );
    }

    public function getAllWeekDaysWithTime()
    {
        return array_unique(array_map(
            fn ($timetable) => $timetable['week_day'] . ' ' . $timetable['time'],
            $this->timetable
        ));
    }
    public function getUniqueWeekDaysWithTime()
    {
        $_timetable = array();
        foreach ($this->timetable as $v) {
            if (isset($_timetable[$v['week_day']])) {
                continue;
            }
            $_timetable[$v['week_day']] = $v;
        }
        return array_values(array_map(
            fn ($_timetable) => $_timetable['week_day'] . ' ' . $_timetable['time'],
            $_timetable
        ));
    }
}
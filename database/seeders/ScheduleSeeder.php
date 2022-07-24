<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSchedule(101);
    }
    
    public function createSchedule($teacher_id): void
    {
        $attendances = Attendance::whereIn('class_id',ClassModel::where('teacher_id',$teacher_id)->pluck('id')->toArray())->get();
        $starts = ["17:00:00", "19:00:00"];
        foreach ($attendances as $attendance) {
            $rand_key_start = array_rand($starts);
            Schedule::query()->create([
                'class_id' => $attendance->class_id,
                'period' => $attendance->period,
                'date' => $attendance->date,
                'start_time' => (new Carbon($starts[$rand_key_start])),
                'end_time' => (new Carbon($starts[$rand_key_start]))->addHours(2)
            ]);
        }
    }
}
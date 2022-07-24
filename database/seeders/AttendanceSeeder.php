<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ClassModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAttendance(101);
    }

    public function createAttendance($teacher_id): void
    {
        $faker = Faker::create();
        $class_ids = ClassModel::where('teacher_id',$teacher_id)->pluck('id')->toArray();
        foreach ($class_ids as $class_id) {
            $max_period = random_int( 6, 10 );
            $date = $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now')->format('Y-m-d');
            for ($i = 1; $i <= $max_period; $i++) {
                $created = Attendance::query()->orderBy('id', 'DESC')->first();
                $current_date = $created->date ?? $date;
                Attendance::query()->create([
                    'class_id' => $class_id,
                    'period' => $i,
                    'date' => (new Carbon($current_date))->addDays(7)
                ]);
            }
        }
    }

}
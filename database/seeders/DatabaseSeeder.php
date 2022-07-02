<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\ClassModel;
use App\Models\Major;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Faker\Provider\DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        User::factory(100)->create();
        Admin::factory(10)->create();
        Major::factory(5)->create();
        Subject::factory(15)->create();
        ClassModel::factory(5)->create();
        $this->createSubscription();
        $this->createAttendance();
        $this->createAttendanceDetail();
        $this->createSchedule();
        $this->createDefaultAccount();
    }

    public function createDefaultAccount(): void
    {
        Admin::query()->create([
            'name' => "acc cho ae",
            'gender' => 1,
            'date_of_birth' => "2010-05-05",
            'phone' => "0123465789",
            'email' => "admin@gmail.com",
            'password' => "1234",
            'role' => 1,
        ]);
    }

    public function createSubscription(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $student_id = User::query()->where('role', 0)->inRandomOrder()->value('id');
            $class_id = ClassModel::query()->inRandomOrder()->value('id');
            $check = Subscription::query()
                ->where('class_id', $class_id)
                ->where('student_id', $student_id)
                ->first();
            if ($check !== null) {
                continue;
            }
            Subscription::query()->create([
                'class_id' => $class_id,
                'student_id' => $student_id,
                'admin_id' => Admin::query()->inRandomOrder()->value('id'),
                'register_time' => now()
            ]);
        }
    }

    public function createAttendance(): void
    {
        $faker = Faker::create();
        $class_ids = ClassModel::query()->pluck('id')->toArray();
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

    public function createAttendanceDetail(): void
    {
        $attendances = Attendance::all();
        foreach ($attendances as $attendance) {
            $student_ids = Subscription::query()
                ->where('class_id', $attendance->class_id)
                ->pluck('student_id')
                ->toArray();
            foreach ($student_ids as $student_id) {
                AttendanceDetail::query()->create([
                    'attendance_id' => $attendance->id,
                    'student_id' => $student_id,
                    'is_present' => random_int(0,1) === 1
                ]);
            }
        }
    }

    public function createSchedule(): void
    {
        $attendances = Attendance::all();
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

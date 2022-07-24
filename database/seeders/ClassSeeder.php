<?php

namespace Database\Seeders;

use App\Enums\ClassStatus;
use App\Models\ClassModel;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addClassForDefaultAccount(2,101);
    }
    public function addClassForDefaultAccount($n, $id)
        {
            $faker = Faker::create();
            for ($i = 0; $i < $n; $i++) {
                $date_start = $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years')->format('Y-m-d');
                $date_end = (new Carbon($date_start))->addMonths(2);

                ClassModel::query()->create([
                    'name' => $faker->jobTitle(),
                    'status' => $faker->randomElement(ClassStatus::showValue()),
                    'date_start' => $date_start,
                    'date_end' => $date_end,
                    'teacher_id' => $id,
                    'subject_id' => Subject::pluck('id')->random(),
                ]);
            }
        }
}
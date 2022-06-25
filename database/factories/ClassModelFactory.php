<?php

namespace Database\Factories;

use App\Enums\ClassStatus;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassModel>
 */
class ClassModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date_start = $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')->format("Y-m-d");
        $date_end = (new Carbon($date_start))->addMonths(2);
        return [
            'name' => $this->faker->jobTitle(),
            'status' => $this->faker->randomElement(ClassStatus::showValue()),
            'date_start' => $date_start,
            'date_end' => $date_end,
            'teacher_id' => User::where('role', 1)->get('id')->random(),
            'subject_id' => Subject::all('id')->random(),
        ];
    }
}

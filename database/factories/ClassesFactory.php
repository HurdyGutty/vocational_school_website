<?php

namespace Database\Factories;

use App\Enums\ClassesStatus;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $schedule_file = Storage::get("json/schedule.json");
        // $schedule = json_decode($schedule_file);
        // $schedule_day = $schedule[array_rand($schedule)];
        return [
            'name' => $this->faker->jobTitle(),
            'status' => $this->faker->randomElement(ClassesStatus::showValue()),
            // 'schedule' => $schedule_day->thứ . ' ' . $schedule_day->ca[array_rand($schedule_day->ca)],
            'user_id' => User::where('role', 1)->get('id')->random(),
            'subject_id' => Subject::all('id')->random(),
        ];
    }
}

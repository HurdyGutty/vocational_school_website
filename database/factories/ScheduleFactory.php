<?php

namespace Database\Factories;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
//        return [
//            'class_id' => ClassModel::all('id')->random(),
//            'period' => $this->faker->numberBetween(1,20),
//            'date' => $this->faker->dateTimeBetween('now','+1 month')->format('Y-m-d'),
//            'time' => $this->faker->randomElement(["17h45-19h30","19h30-21h30"]),
//            'is_substitute' => $this->faker->boolean(),
//        ];
    }
}

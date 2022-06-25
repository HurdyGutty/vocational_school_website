<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
//        $class_ids = ClassModel::query()->pluck('id')->toArray();
//        foreach ($class_ids as $class_id) {
//
//        }
//
//
//        $class_id = ClassModel::all('id')->random();
//        $period = $this->faker->numberBetween(1,20);
//        while (Attendance::where('class_id', $class_id)->where('period', $period)->exists())
//            {
//                $class_id = ClassModel::all('id')->random();
//                $period = $this->faker->numberBetween(1,20);
//            }
//        return [
//            'class_id' => $class_id,
//            'period' => $period,
//            'date' => now()->format('Y-m-d'),
//        ];
    }
}

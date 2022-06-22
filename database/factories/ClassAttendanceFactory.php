<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\ClassAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Class_attendance>
 */
class ClassAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $attendance_id = Attendance::all('id')->random();
        $user_id = User::all('id')->random();
        while (ClassAttendance::where('attendance_id', $attendance_id)->where('user_id', $user_id)->exists())
            {
                $attendance_id = Attendance::all('id')->random();
                $user_id = User::all('id')->random();
            }
        return [
            'attendance_id' => $attendance_id,
            'user_id' => $user_id,
            'is_present' => $this->faker->boolean(),
        ];
    }
}

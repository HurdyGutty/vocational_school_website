<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Class_attendance>
 */
class AttendanceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
//        $attendance_id = Attendance::all('id')->random();
//        $user_id = User::where('role', 0)->get('id')->random();
//        while (AttendanceDetail::where('attendance_id', $attendance_id)->where('user_id', $user_id)->exists())
//            {
//                $attendance_id = Attendance::all('id')->random();
//                $user_id = User::where('role', 0)->get('id')->random();
//            }
//        return [
//            'attendance_id' => $attendance_id,
//            'user_id' => $user_id,
//            'is_present' => $this->faker->boolean(),
//        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\ClassModel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
//        $class_id = ClassModel::all('id')->random();
//        $user_id = User::where('role', 0)->get('id')->random();
//        while (Subscription::where('class_id', $class_id)->where('user_id', $user_id)->exists())
//            {
//                $class_id = ClassModel::all('id')->random();
//                $user_id = User::where('role', 0)->get('id')->random();
//            }
//
//        return [
//            'class_id' => $class_id,
//            'user_id' => $user_id,
//            'admin_id' => Admin::where('role', 0)->get('id')->random(),
//            'register_time' => now()
//        ];
    }
}

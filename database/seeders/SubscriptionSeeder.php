<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ClassModel;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSubscription(102);
    }
    
    public function createSubscription($id): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $student_id = $id;
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
                'register_time' => now(),
            ]);
        }
    }
}
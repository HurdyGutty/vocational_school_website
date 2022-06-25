<?php

namespace Database\Seeders;

use App\Models\AttendanceDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttendanceDetail::factory(5)->create();
    }
}

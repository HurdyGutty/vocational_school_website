<?php

namespace App\Services\ShowAccountService;

use App\Models\ClassModel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShowTeacher
{

    public function __construct()
    {
    }

    public function show(int $id)
    {
        return User::leftJoinSub(
            ClassModel::where('classes.status', '>', 0)
                ->select('teacher_id', DB::raw('count(class_id) as class_count'),  DB::raw('sum(student_count) as student_sum'))
                ->joinSub(
                    Subscription::select('class_id', DB::raw('count(student_id) as student_count'))
                        ->groupBy('class_id'),
                    's',
                    fn ($j) => $j->on('s.class_id', '=', 'classes.id')
                )
                ->groupBy('class_id'),
            'classes',
            fn ($j) => $j->on('classes.teacher_id', '=', 'users.id')
        )
            ->where('users.id', $id)
            ->select('users.id', 'users.name', 'users.gender', DB::raw('YEAR(date_of_birth) as birth_year'), 'class_count', 'student_sum')
            ->get();
    }
}
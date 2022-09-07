<?php

namespace App\Services\ShowAccountService;

use App\Models\Admin;
use App\Models\ClassModel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShowStaff
{
    public function __construct()
    {
    }

    public function show(int $id)
    {
        return Admin::leftJoinSub(
            Subscription::select('admin_id', DB::raw('count(student_id) as student_count'))->groupBy('admin_id'),
            'subscriptions',
            fn ($j) => $j->on('admins.id', '=', 'subscriptions.admin_id')
        )
            ->where('admins.id', $id)
            ->select('admins.id', 'admins.name', 'admins.gender', DB::raw('YEAR(date_of_birth) as birth_year'), 'student_count')
            ->first();
    }
}
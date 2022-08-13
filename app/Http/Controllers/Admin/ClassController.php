<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
    }

    public function show(ClassModel $class)
    {
    }

    public function create()
    {
    }
    public function store()
    {
    }

    public function pendingSubscription()
    {
        $pending_classes = ClassModel::with(
            [
                'students' => fn ($q) => $q->select('id', 'name')
                    ->whereHas('subscriptions', fn ($q) => $q->whereNull('admin_id'))
            ]
        )->with(
            [
                'subscriptions' => fn ($q) => $q->select('class_id', 'register_time')->whereNull('admin_id')
            ]
        )
            ->whereHas('subscriptions', fn ($q) => $q->whereNull('admin_id'))
            ->paginate(15);
        return view('classes.subscription.pending', [
            'pending_classes' => $pending_classes
        ]);
    }
}
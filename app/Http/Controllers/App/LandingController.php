<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subscription;
use App\Services\CalendarService;

class LandingController extends Controller
{
    public function index()
    {
        $classes = (new CalendarService(getAccount()->role, getAccount()->id))->getClasses();

        return view('schedule.index', [
            'classes' => $classes,
        ]);
    }

    public function calendar(int $class_id)
    {
        $calendar = CalendarService::getSchedule($class_id);
        return response()->json($calendar, 200);
    }
}
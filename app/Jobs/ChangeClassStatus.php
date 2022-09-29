<?php

namespace App\Jobs;

use App\Models\ClassModel;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeClassStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $classes_start = ClassModel::where('date_start', '<=', Carbon::now()->toDateString())
            ->where('status', 1)
            ->get();

        if ($classes_start->count() != 0) {
            foreach ($classes_start as $class) {
                if (Subscription::where('class_id', $class->id)->get()->count() >= 15) {
                    $class->status = 2;
                    $class->save();
                } else {
                    $class->status = 4;
                    $class->save();
                }
            }
        }

        $classes_end = ClassModel::where('date_end', '<=', Carbon::now()->copy()->subWeeks(2)->toDateString())
            ->where('status', 2)
            ->get();

        if ($classes_end->count() != 0) {
            foreach ($classes_start as $class) {
                $class->status = 3;
                $class->save();
            }
        }

        $classes_cancelled = ClassModel::where('date_start', '<', Carbon::now()->copy()->subMonths(6)->toDateString())
            ->where('status', 4)
            ->get();

        if ($classes_cancelled->count() != 0) {
            foreach ($classes_start as $class) {
                $class->delete();
            }
        }
    }
}
<?php

namespace App\Observers;

use App\Mail\ClassStatusNotify;
use App\Models\ClassModel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class ClassObserver
{
    /**
     * Handle the ClassModel "created" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function created(ClassModel $classModel)
    {
        //
    }


    public function updating(ClassModel $classModel)
    {
    }
    /**
     * Handle the ClassModel "updated" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function updated(ClassModel $classModel)
    {
        if ($classModel->wasChanged('status')) {
            $new_status = $classModel->status;
            $class_name = $classModel->name;
            $class_teacher_email = $classModel->teacher()->email;
            $class_student_emails =
                User::whereHas(
                    'user_classes',
                    fn (Builder $q) => $q->where('class_id', $classModel->id)
                )
                ->pluck('email')->toArray();
            if ($new_status != 0) {
                Mail::to($class_teacher_email)->send(new ClassStatusNotify($new_status, $class_name));
                foreach ($class_student_emails as $student_mail) {
                    Mail::to($student_mail)->send(new ClassStatusNotify($new_status, $class_name));
                }
            }
        }
    }

    /**
     * Handle the ClassModel "deleted" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function deleted(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the ClassModel "restored" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function restored(ClassModel $classModel)
    {
        //
    }

    /**
     * Handle the ClassModel "force deleted" event.
     *
     * @param  \App\Models\ClassModel  $classModel
     * @return void
     */
    public function forceDeleted(ClassModel $classModel)
    {
        //
    }
}
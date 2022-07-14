<?php

namespace App\Listeners\Major;

use App\Events\Major\MajorUpdate;
use App\Models\MajorSubject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class UpdateRelatedMajorSubjects implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\Major\MajorUpdate  $event
     * @return void
     */
    public function handle(MajorUpdate $event)
    {
        $data = $event->data;
        // dd($data);
        $original_arr = MajorSubject::where('major_id', $data['id'])->pluck('subject_id');
        $subject_id_arr = collect(Arr::flatten($data['subjects']));
        
        $add_subjects = $subject_id_arr->diff($original_arr)->all();
        $delete_subjects = $original_arr->diff($subject_id_arr)->all();

        foreach ($add_subjects as $add_subject) {
            MajorSubject::firstOrCreate([
                'major_id' => $data['id'],
                'subject_id' => $add_subject,
            ]);
        }
        
        foreach ($delete_subjects as $delete_subjects) {
                MajorSubject::where([
                    'major_id' => $data['id'],
                    'subject_id' => $delete_subjects,
                    ])->delete();
        }
    }
}
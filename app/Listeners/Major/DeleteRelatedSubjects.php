<?php

namespace App\Listeners\Major;

use App\Events\Major\MajorDelete;
use App\Models\MajorSubject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteRelatedSubjects implements ShouldQueue
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
     * @param  App\Events\Major\MajorDelete  $event
     * @return void
     */
    public function handle(MajorDelete $event)
    {
        MajorSubject::where('major_id',$event->major->id)->delete();
    }
}
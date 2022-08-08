<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $is_teacher;
    private $user_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $teacher_role, int $user_id = null)
    {
        $this->is_teacher = $teacher_role;
        $this->user_id = $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome',[
            'is_teacher' => $this->is_teacher,
            'user_id' => $this->user_id,
        ]);
    }
}
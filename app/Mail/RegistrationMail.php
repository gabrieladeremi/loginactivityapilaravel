<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public User $user){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = 'Hello there! You’ve been registered successfully.';

        return $this
            ->from(env('MAIL_FROM_ADDRESS'),  'Support')
            ->subject($subject)
            ->view('emails.registration_successful')
            ->with([
                'salutationName' => $this->user->firstname,
                'subject' => $subject,
            ]);


    }
}

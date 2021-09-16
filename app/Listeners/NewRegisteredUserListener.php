<?php

namespace App\Listeners;

use App\Events\NewUserRegisteredEvent;
use App\Mail\RegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewRegisteredUserListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param NewUserRegisteredEvent $event
     * @return void
     */
    public function handle(NewUserRegisteredEvent $event): void
    {
        Mail::to($event->user->email)
            ->send(new RegistrationMail($event->user));
    }
}

<?php

namespace App\Listeners;

use App\Events\SendEmail;
use App\Mail\SendUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Monolog\Logger;

class SendingEmail
{
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
     * @param  object  $event

     */
    public function handle(SendEmail $event)
    {
        Mail::to($event->user)->send(new SendUserEmail($event->user, $event->group));
    }
}

<?php

namespace App\Listeners;

use App\Mail\ContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendMailListener
{

    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        mail::to($event->mail)->send(new ContactMail($event->message));
    }
}

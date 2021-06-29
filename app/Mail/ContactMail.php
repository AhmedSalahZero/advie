<?php

namespace App\Mail;

use App\Setting;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;


    public $message  ;
    public function __construct($message)
    {
        $this->message = $message ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from_email = (isset(Setting::where('setting_name','from_email')->first()->setting_value)?Setting::where('setting_name','from_email')->first()->setting_value :'ahmedsalah20103020@gmail.com');
        return $this->from($from_email)->subject($this->message->subject)->view('backend.messages.mailMessage',['lastMessage'=>$this->message]) ;
    }
}

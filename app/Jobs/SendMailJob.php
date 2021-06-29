<?php

namespace App\Jobs;

use App\Events\sendMail;
use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $message ;
    public function __construct($message)
    {
        $this->message = $message ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifyEmail = (isset(Setting::where('setting_name','notifyEmail')->first()->setting_value) ? Setting::where('setting_name','notifyEmail')->first()->setting_value : 'ahmedconan17@yahoo.com' );
        Event(new sendMail($notifyEmail,$this->message) );
    }
}

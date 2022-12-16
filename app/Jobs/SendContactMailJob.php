<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendContactMailJob implements ShouldQueue
{
    public $name;
    public $email;
    public $subject;
    public $message;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct($name,$email,$subject,$message)
    {
        $this->name=$name;
        $this->email=$email;
        $this->subject=$subject;
        $this->message=$message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail($this->name,$this->email,$this->subject,$this->message));
    }
}

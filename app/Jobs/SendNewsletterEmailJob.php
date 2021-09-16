<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        $from = env('MAIL_FROM_ADDRESS');
        $from_name = env('APP_NAME');
        $subject = $this->details['subject'];
        $content_data = ['email_content' => $this->details['content']];
        $emails = ['kishan.urvam@gmail.com', 'hothimayur96@gmail.com', 'kishanambaliyala7996@gmail.com', 'kishan.urvam+1@gmail.com'];
        foreach ($emails as $key => $to) {
            Mail::send('email_sample', $content_data, function($message) use($to, $from, $from_name, $subject){
                $message->from($from, $from_name)
                    ->to($to)
                    ->subject($subject);
            });
        }
    }
}

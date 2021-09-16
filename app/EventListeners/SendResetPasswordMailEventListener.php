<?php

namespace App\EventListeners;

use App\Events\SendResetPasswordMailEvent;
use App\Interfaces\EmailServiceInterface;

class SendResetPasswordMailEventListener
{
    protected $emailService;
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(SendResetPasswordMailEvent $event)
    {
        $emailData = $event->data;
        $content_var_values = [
            'NAME' => $emailData['name'],
            'RESET_LINK' => $emailData['reset_link'],
        ];
        $data['to'] = $emailData['email'];
        $data['template'] = 'user_reset_password';
        $data['content_var_values'] = $content_var_values;
        $this->emailService->sendEmail($data);
    }
}

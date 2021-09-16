<?php

namespace App\EventListeners;

use App\Events\UserActivationMailEvent;
use App\Interfaces\EmailServiceInterface;

class UserActivationMailEventListener
{
    protected $emailService;
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(UserActivationMailEvent $event)
    {
        $user = $event->user;
        $content_var_values = [
            'NAME' => ucfirst($user->first_name).' '.$user->last_name,
            'ACTIVATION_LINK' => route('user.activation_link', $user->activation_key),
        ];
        $data['to'] = $user->email;
        $data['template'] = 'user_register_activation';
        $data['content_var_values'] = $content_var_values;
        $this->emailService->sendEmail($data);
    }
}

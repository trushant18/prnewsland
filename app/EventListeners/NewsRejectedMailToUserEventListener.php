<?php

namespace App\EventListeners;

use App\Events\NewsRejectedMailToUserEvent;
use App\Interfaces\EmailServiceInterface;

class NewsRejectedMailToUserEventListener
{
    protected $emailService;
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(NewsRejectedMailToUserEvent $event)
    {
        $newsDetails = $event->news;
        $content_var_values = [
            'NAME' => ucfirst($newsDetails->userDetails->first_name).' '.$newsDetails->userDetails->last_name,
            'NEWS_TITLE' => $newsDetails->title,
            'REASON' => $newsDetails->reject_reason,
        ];
        $data['to'] = $newsDetails->userDetails->email;
        $data['template'] = 'news_rejected_mail_to_user';
        $data['content_var_values'] = $content_var_values;
        $this->emailService->sendEmail($data);
    }
}

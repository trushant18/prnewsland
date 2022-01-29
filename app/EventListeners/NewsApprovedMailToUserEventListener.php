<?php

namespace App\EventListeners;

use App\Events\NewsApprovalMailToAdminEvent;
use App\Events\NewsApprovedMailToUserEvent;
use App\Interfaces\EmailServiceInterface;

class NewsApprovedMailToUserEventListener
{
    protected $emailService;
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(NewsApprovedMailToUserEvent $event)
    {
        $newsDetails = $event->news;
        $content_var_values = [
            'NAME' => ucfirst($newsDetails->userDetails->first_name).' '.$newsDetails->userDetails->last_name,
            'NEWS_TITLE' => $newsDetails->title,
        ];
        $data['to'] = $newsDetails->userDetails->email;
        $data['template'] = 'news_approved_mail_to_user';
        $data['content_var_values'] = $content_var_values;
        $this->emailService->sendEmail($data);
    }
}

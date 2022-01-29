<?php

namespace App\EventListeners;

use App\Events\NewsApprovalMailToAdminEvent;
use App\Interfaces\EmailServiceInterface;
use App\Models\SiteConfiguration;

class NewsApprovalMailToAdminEventListener
{
    protected $emailService;
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(NewsApprovalMailToAdminEvent $event)
    {
        $email_data = $event->data;
        $content_var_values = [
            'NAME' => $email_data['user_name'],
            'NEWS_TITLE' => $email_data['news_title'],
        ];
        $siteConfiguration = SiteConfiguration::where('identifier', 'email_address')->first();
        $data['to'] = $siteConfiguration->value;
        $data['template'] = 'news_approval_mail_to_admin';
        $data['content_var_values'] = $content_var_values;
        $this->emailService->sendEmail($data);
    }
}

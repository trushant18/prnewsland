<?php

namespace App\Providers;

use App\EventListeners\NewsApprovalMailToAdminEventListener;
use App\EventListeners\NewsApprovedMailToUserEventListener;
use App\EventListeners\NewsRejectedMailToUserEventListener;
use App\EventListeners\SendResetPasswordMailEventListener;
use App\EventListeners\UserActivationMailEventListener;
use App\Events\NewsApprovalMailToAdminEvent;
use App\Events\NewsApprovedMailToUserEvent;
use App\Events\NewsRejectedMailToUserEvent;
use App\Events\SendResetPasswordMailEvent;
use App\Events\UserActivationMailEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserActivationMailEvent::class => [
            UserActivationMailEventListener::class,
        ],
        SendResetPasswordMailEvent::class => [
            SendResetPasswordMailEventListener::class,
        ],
        NewsApprovalMailToAdminEvent::class => [
            NewsApprovalMailToAdminEventListener::class,
        ],
        NewsApprovedMailToUserEvent::class => [
            NewsApprovedMailToUserEventListener::class,
        ],
        NewsRejectedMailToUserEvent::class => [
            NewsRejectedMailToUserEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

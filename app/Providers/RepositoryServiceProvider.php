<?php

namespace App\Providers;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\ContactRequestRepositoryInterface;
use App\Interfaces\EmailServiceInterface;
use App\Interfaces\EmailTemplateRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PlanRepositoryInterface;
use App\Interfaces\SiteConfigurationsRepositoryInterface;
use App\Interfaces\UserAuthRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\ContactRequestRepository;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\PageRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SiteConfigurationsRepository;
use App\Repositories\UserAuthRepository;
use App\Repositories\UserRepository;
use App\Services\EmailService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PageRepositoryInterface::class, function ($app) {
            return $app->make(PageRepository::class);
        });
        $this->app->bind(EmailTemplateRepositoryInterface::class, function ($app) {
            return $app->make(EmailTemplateRepository::class);
        });
        $this->app->bind(SiteConfigurationsRepositoryInterface::class, function ($app) {
            return $app->make(SiteConfigurationsRepository::class);
        });
        $this->app->bind(BlogRepositoryInterface::class, function ($app) {
            return $app->make(BlogRepository::class);
        });
        $this->app->bind(PlanRepositoryInterface::class, function ($app) {
            return $app->make(PlanRepository::class);
        });
        $this->app->bind(ContactRequestRepositoryInterface::class, function ($app) {
            return $app->make(ContactRequestRepository::class);
        });
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return $app->make(UserRepository::class);
        });
        $this->app->bind(UserAuthRepositoryInterface::class, function ($app) {
            return $app->make(UserAuthRepository::class);
        });
        $this->app->bind(EmailServiceInterface::class, function ($app) {
            return $app->make(EmailService::class);
        });
       
    }
}

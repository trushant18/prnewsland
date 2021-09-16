<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\SiteConfigurationsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\ContactRequestController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*SITE CONFIGURATIONS*/
    Route::get('site_configurations', [SiteConfigurationsController::class, 'index'])->name('site_configurations');
    Route::post('site_configurations/update', [SiteConfigurationsController::class, 'update'])->name('site_configurations.update');

    /*PAGES ROUTES*/
    Route::get('pages', [PageController::class, 'index'])->name('pages');
    Route::get('page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('page/store', [PageController::class, 'store'])->name('page.store');
    Route::get('page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::post('page/update/{id}', [PageController::class, 'update'])->name('page.update');
    Route::get('page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');

    /*EMAIL TEMPLATE ROUTES*/
    Route::get('email_templates', [EmailTemplateController::class, 'index'])->name('email_templates');
    Route::get('email_template/create', [EmailTemplateController::class, 'create'])->name('email_template.create');
    Route::post('email_template/store', [EmailTemplateController::class, 'store'])->name('email_template.store');
    Route::get('email_template/edit/{id}', [EmailTemplateController::class, 'edit'])->name('email_template.edit');
    Route::post('email_template/update/{id}', [EmailTemplateController::class, 'update'])->name('email_template.update');
    Route::get('email_template/delete/{id}', [EmailTemplateController::class, 'delete'])->name('email_template.delete');

    /*BLOG ROUTES*/
    Route::get('blog', [BlogController::class, 'index'])->name('blog');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    /*PLAN/PRICE ROUTES*/
    Route::get('plans', [PlanController::class, 'index'])->name('plans');
    Route::get('plan/create', [PlanController::class, 'create'])->name('plan.create');
    Route::post('plan/store', [PlanController::class, 'store'])->name('plan.store');
    Route::get('plan/edit/{id}', [PlanController::class, 'edit'])->name('plan.edit');
    Route::post('plan/update/{id}', [PlanController::class, 'update'])->name('plan.update');
    Route::get('plan/delete/{id}', [PlanController::class, 'delete'])->name('plan.delete');

    /*NEWSLETTER ROUTES*/
    Route::get('newsletter', [NewsletterController::class, 'index'])->name('newsletter');
    Route::post('newsletter/send', [NewsletterController::class, 'send'])->name('newsletter.send');

    /*CONTACT REQUESTS ROUTES*/
    Route::get('contact_requests', [ContactRequestController::class, 'index'])->name('contact_requests');

    /*USERS ROUTES*/
    Route::get('users', [UserController::class, 'index'])->name('users');
});

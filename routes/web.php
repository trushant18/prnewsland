<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    /*******************Admin Login ************************/
    Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('admin/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');

    /*******************User Login ************************/
    Route::get('login', [AuthController::class, 'login'])->name('user.login');
    Route::get('register', [AuthController::class, 'register'])->name('user.register');
    Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('user.authenticate');
    Route::post('register/store', [AuthController::class, 'storeUser'])->name('user.store');

    Route::get('user/activate/{key}', [AuthController::class, 'activateUser'])->name('user.activation_link');

    Route::get('user/forgot-password', [AuthController::class, 'forgotUserPassword'])->name('user.forgot_password');
    Route::post('user/forgot-password/send-mail', [AuthController::class, 'sendForgotPasswordMail'])->name('user.forgot_password.send_mail');
    Route::get('user/reset-password/{token}', [AuthController::class, 'resetUserPassword'])->name('user.reset_password');
    Route::post('user/reset-password', [AuthController::class, 'resetPasswordStore'])->name('user.reset_password.store');

    Route::get('/contact', [ContactRequestController::class, 'getContactDetails'])->name('contact');
    Route::post('/contact/store', [ContactRequestController::class, 'storeContactForm'])->name('contact.store');

    Route::get('/pricing', [HomeController::class, 'getPricingList'])->name('pricing');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blog/{slug}', [BlogController::class, 'getBlogDetails'])->name('blog.detail');

    Route::group(['middleware' => ['users']], function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
        Route::get('profile', [UserController::class, 'getProfile'])->name('user.profile');
        Route::post('profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::post('password/update', [UserController::class, 'updatePassword'])->name('user.password.update');

        Route::get('news/create', [UserController::class, 'newsCreateForm'])->name('news.create');

        Route::get('draft-releases', [UserController::class, 'myDraftReleases'])->name('user.draft_releases');
        Route::get('press-releases', [UserController::class, 'myPressReleases'])->name('user.press_releases');
    });

    Route::get('page/{slug}', [HomeController::class, 'getPageDetails'])->name('page.detail');
});


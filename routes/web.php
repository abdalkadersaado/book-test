<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BooksController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\UsersController as FrontendUsersController;
use App\Http\Controllers\Backend\Auth\LoginController as BackendLoginController;
use App\Http\Controllers\Frontend\Auth\LoginController as FrontendLoginController;


Route::group(['middleware' => 'web'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('frontend.index');

    // Authentication Routes...
    Route::get('/login', [FrontendLoginController::class, 'showLoginForm'])->name('frontend.show_login_form');
    Route::post('login', [FrontendLoginController::class, 'login'])->name('frontend.login');
    Route::get('login/{provider}', [FrontendLoginController::class, 'redirectToProvider'])->name('frontend.social_login');
    Route::get('login/{provider}/callback', [FrontendLoginController::class, 'handleProviderCallback'])->name('frontend.social_login_callback');
    Route::post('logout', [FrontendLoginController::class, 'logout'])->name('frontend.logout');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('frontend.show_register_form');
    Route::post('register', [RegisterController::class, 'register'])->name('frontend.register');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/change-language/{locale}', [ServiceController::class, 'change_language'])->name('change_locale');

    // route Users and home page
    Route::group(['middleware' => 'verified', 'as' => 'users.'], function () {
        Route::get('/dashboard', [FrontendUsersController::class, 'index'])->name('dashboard');

        Route::resource('books', BookController::class);
        Route::POST('/edit-book/{id}', [BookController::class, 'update_book'])->name('books_update_edit');
    });
});

// Admin Route and dashboard
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Authentication Routes...
    Route::get('/login', [BackendLoginController::class, 'showLoginForm'])->name('show_login_form');
    Route::post('login', [BackendLoginController::class, 'login'])->name('login');
    Route::post('logout', [BackendLoginController::class, 'logout'])->name('logout');
    Route::group(['middleware' => ['roles', 'role:admin|editor']], function () {

        Route::get('/', [AdminController::class, 'index'])->name('index_route');
        Route::get('/index', [AdminController::class, 'index'])->name('index');

        Route::resource('books', BooksController::class);
        Route::POST('/edit-book/{id}', [BooksController::class, 'update_book'])->name('books_update_edit');
    });
});

// Like Or Dislike
Route::post('save-likedislike', [BookController::class, 'save_likedislike']);

// search
Route::get('/search', [IndexController::class, 'search'])->name('frontend.search');

<?php

use App\Http\Controllers\Admin\Auth\ConfirmPasswordController as AdminConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\VerificationController as AdminVerificationController;
use App\Http\Controllers\Admin\ProgrammingsShowsController;
use App\Http\Controllers\Admin\ShowingsController;
use App\Http\Controllers\Admin\ShowingsImportController;
use App\Http\Controllers\Admin\ShowsController;
use App\Http\Controllers\Admin\ShowsImportController;
use App\Http\Controllers\Admin\ShowsImportSearchController;
use App\Http\Controllers\Admin\ShowsVideosController;
use App\Http\Controllers\Admin\Website\PagesController;
use App\Http\Controllers\Admin\WeeksController;
use App\Http\Controllers\ShowingsByWeekController;
use App\Http\Controllers\ShowingsNowController;
use App\Http\Controllers\ShowingsTonightController;
use Gordesch\CineCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Login Routes...
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login']);
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

        // Registration Routes...
        Route::get('register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [AdminRegisterController::class, 'register']);

        // Password Reset Routes...
        Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');

        // Password Confirmation Routes...
        Route::get('password/confirm', [AdminConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
        Route::post('password/confirm', [AdminConfirmPasswordController::class, 'confirm']);

        // Email Verification Routes...
        Route::get('email/verify', [AdminVerificationController::class, 'show'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', [AdminVerificationController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend', [AdminVerificationController::class, 'resend'])->name('verification.resend');
    });

Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware(['auth-admin:admin', 'verified-admin'])
    ->group(function () {

    Route::get('shows', [ShowsController::class, 'index'])->name('shows.index');
    Route::get('shows/create', [ShowsController::class, 'create'])->name('shows.create');
    Route::post('shows', [ShowsController::class, 'store'])->name('shows.store');
    Route::get('shows/{show:id}/edit', [ShowsController::class, 'edit'])->name('shows.edit');
    Route::put('shows/{show:id}', [ShowsController::class, 'update'])->name('shows.update');
    Route::delete('shows/{show:id}', [ShowsController::class, 'destroy'])->name('shows.destroy');

    Route::get('shows/import/search/create', [ShowsImportSearchController::class, 'create'])->name('shows.import.search.create');
    Route::get('shows/import/create', [ShowsImportController::class, 'create'])->name('shows.import.create');

    Route::get('shows/{show:id}/videos/edit', [ShowsVideosController::class, 'edit'])->name('shows.videos.edit');
    Route::put('shows/{show:id}/videos', [ShowsVideosController::class, 'update'])->name('shows.videos.update');

    Route::get('showings-import/create', [ShowingsImportController::class, 'create'])->name('showings.import.create');
    Route::post('showings-import', [ShowingsImportController::class, 'store'])->name('showings.import.store');

    Route::get('weeks', [WeeksController::class, 'index'])->name('weeks.index');
    Route::get('weeks/{week}/edit', [WeeksController::class, 'edit'])->name('weeks.edit');
    Route::put('weeks/{week}', [WeeksController::class, 'update'])->name('weeks.update');

    Route::get('weeks/{week}/programmings/shows/edit', [ProgrammingsShowsController::class, 'edit'])->name('weeks.programmings.shows.edit');
    Route::get('weeks/{week}/programmings/shows', [ProgrammingsShowsController::class, 'index'])->name('weeks.programmings.shows.index');
    Route::get('weeks/{week}/showings', [ShowingsController::class, 'index'])->name('weeks.showings.index');

    Route::namespace('Website')->prefix('website')->name('website.')->group(function () {
        Route::get('pages/create', [PagesController::class, 'create'])->name('pages.create');
        Route::post('pages', [PagesController::class, 'store'])->name('pages.store');
    });
});

Auth::routes(['verify' => true]);

Route::get('a-l-affiche/cette-semaine', function () {
    return (new ShowingsByWeekController())
        ->show(CineCarbon::now()->programmingWeek());
})->name('showing.this-week');
Route::get('a-l-affiche/semaine-prochaine', function () {
    return (new ShowingsByWeekController())
        ->show(CineCarbon::now()->modify('+1 week')->programmingWeek());
})->name('showing.next-week');
Route::get('a-l-affiche/ce-soir/{date?}', [ShowingsTonightController::class])->name('showing.tonight');
Route::get('a-l-affiche/maintenant/{from?}', [ShowingsNowController::class])->name('showing.now');

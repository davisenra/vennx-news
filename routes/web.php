<?php

use App\Http\Controllers\Auth\GoogleOAuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth/google')
    ->middleware('guest')
    ->group(function () {
        Route::get('/redirect', [GoogleOAuthController::class, 'redirectToGoogle'])
            ->name('auth.google.redirect');

        Route::get('/callback', [GoogleOAuthController::class, 'handleCallback'])
            ->name('auth.google.callback');
    });

Route::get('/logout', LogoutController::class)
    ->name('auth.logout')
    ->middleware('auth');

Route::get('/', HomeController::class)->name('home');

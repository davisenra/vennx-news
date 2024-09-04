<?php

use App\Http\Controllers\Auth\GoogleOAuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
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

Route::prefix('/articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])
        ->name('article.index')
        ->middleware('auth');
    Route::get('/write', [ArticleController::class, 'create'])
        ->name('article.create')
        ->middleware('auth');
    Route::get('/{id}', [ArticleController::class, 'show'])
        ->name('article.show');
    Route::get('/{id}/delete', [ArticleController::class, 'destroy'])
        ->name('article.destroy')
        ->middleware('auth');
});

<?php

use App\Http\Controllers\Auth\GoogleOAuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/auth/google',
    'middleware' => ['guest'],
    ], function () {
        Route::get('/redirect', [GoogleOAuthController::class, 'redirectToGoogle'])
            ->name('auth.google.redirect');
        Route::get('/callback', [GoogleOAuthController::class, 'handleCallback'])
            ->name('auth.google.callback');
    });

Route::get('/logout', LogoutController::class)
    ->name('auth.logout')
    ->middleware('auth');

Route::get('/', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');

Route::prefix('/articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])
        ->name('article.index')
        ->middleware('auth');
    Route::get('/write', [ArticleController::class, 'create'])
        ->name('article.create')
        ->middleware('auth');
    Route::post('/', [ArticleController::class, 'store'])
        ->name('article.store')
        ->middleware('auth');
    Route::get('/{id}', [ArticleController::class, 'show'])
        ->name('article.show');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])
        ->name('article.edit');
    Route::post('/{article}', [ArticleController::class, 'update'])
        ->name('article.update');
    Route::get('/{id}/delete', [ArticleController::class, 'destroy'])
        ->name('article.destroy')
        ->middleware('auth');
});

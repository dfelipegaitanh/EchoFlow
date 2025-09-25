<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Deezer\ArtistController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('ability:deezer')
        ->prefix('deezer')
        ->name('deezer.')
        ->group(function () {

            Route::get('/artist/{artistName}', [ArtistController::class, 'getArtist'])
                ->name('artist-get');

        });

});

Route::post('login', [AuthController::class, 'login'])
    ->name('api.login');

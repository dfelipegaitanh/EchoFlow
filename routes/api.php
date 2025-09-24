<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('ability:deezer')->group(function () {})->name('deezer');

});

Route::post('login', [AuthController::class, 'login'])
    ->name('api.login');

<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\DeezerAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function (): Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory {
    return view('welcome');
})->name('home');

Volt::route('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::prefix('auth/deezer')->name('auth.deezer.')->middleware('auth')->group(function (): void {
//    Route::get('redirect', [DeezerAuthController::class, 'redirect'])->name('redirect');
//    Route::get('callback', [DeezerAuthController::class, 'callback'])->name('callback');
// });

Route::middleware(['auth'])->group(function (): void {
    Volt::route('deezer', 'pages.deezer.index')->name('deezer.index');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

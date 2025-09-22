<?php

declare(strict_types=1);

use App\Clients\Music\DeezerClient;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function (): Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory {
    return view('welcome');
})->name('home');

Volt::route('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function (): void {
    Volt::route('deezer', 'pages.deezer.index')->name('deezer.index');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/test-deezer/{artistName}', function (string $artistName, DeezerClient $client) {
    return $client->searchArtist($artistName)?->toJson();
});

require __DIR__.'/auth.php';

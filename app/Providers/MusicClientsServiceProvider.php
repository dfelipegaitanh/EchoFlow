<?php

declare(strict_types=1);

namespace App\Providers;

use App\Clients\Music\LastFmClient;
use Illuminate\Support\ServiceProvider;

final class MusicClientsServiceProvider extends ServiceProvider
{
    public function boot(): void {}

    public function register(): void
    {
        $this->bindLastFmClient();
    }

    private function bindLastFmClient(): void
    {
        $this->app->singleton(LastFmClient::class, function (): LastFmClient {
            return new LastFmClient(
                apiKey: config('services.lastfm.api_key'),
            );
        });
    }
}

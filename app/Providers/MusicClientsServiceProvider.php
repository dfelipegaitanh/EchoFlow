<?php

declare(strict_types=1);

namespace App\Providers;

use App\Clients\Music\LastFmClient;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

final class MusicClientsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->bindLastFmClient();
    }

    private function bindLastFmClient(): void
    {
        $this->app->singleton(LastFmClient::class, function (): LastFmClient {
            $apiKey = config('services.lastfm.api_key');

            if (! is_string($apiKey)) {
                throw new RuntimeException('Last.fm API key is not configured.');
            }

            return new LastFmClient($apiKey);
        });
    }
}

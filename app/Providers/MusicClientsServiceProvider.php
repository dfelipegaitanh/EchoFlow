<?php

declare(strict_types=1);

namespace App\Providers;

use App\Clients\Music\DeezerClient;
use App\Clients\Music\LastFmClient;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

final class MusicClientsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->bindLastFmClient();
        $this->bindDeezerClient();
    }

    private function bindDeezerClient(): void
    {
        $this->app->singleton(DeezerClient::class, fn (): DeezerClient => new DeezerClient());
    }

    private function bindLastFmClient(): void
    {
        $this->app->singleton(LastFmClient::class, function (): LastFmClient {
            $apiKey = config('services.lastfm.api_key');

            if (! is_string($apiKey) || in_array(mb_trim($apiKey), ['', '0'], true)) {
                throw new RuntimeException('Last.fm API key is not configured.');
            }

            return new LastFmClient($apiKey);
        });
    }
}

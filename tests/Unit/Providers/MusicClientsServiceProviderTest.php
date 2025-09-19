<?php

declare(strict_types=1);

namespace Tests\Unit\Providers;

use App\Clients\Music\LastFmClient;
use RuntimeException;

it('throws an exception if the lastfm api key is not configured', function () {
    // Arrange
    config(['services.lastfm.api_key' => null]);

    // Act & Assert
    expect(fn () => app(LastFmClient::class))
        ->toThrow(RuntimeException::class, 'Last.fm API key is not configured.');
});

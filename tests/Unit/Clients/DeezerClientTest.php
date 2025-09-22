<?php

declare(strict_types=1);

namespace Tests\Unit\Clients;

use App\Clients\Music\DeezerClient;
use App\DTOs\ArtistDto;
use Illuminate\Support\Facades\Http;
use Tests\Traits\ProvidesDeezerFixtures;

uses(ProvidesDeezerFixtures::class);

it('returns an artist DTO when searching for an existing artist', function () {
    // Arrange
    $artistName = 'Daft Punk';
    $artistData = $this->fakeDeezerArtist();

    Http::fake([
        'api.deezer.com/*' => Http::response([
            'data' => [$artistData],
            'total' => 1,
        ]),
    ]);

    // Act
    $result = app(DeezerClient::class)->searchArtist($artistName);

    // Assert
    expect($result)->toBeInstanceOf(ArtistDto::class)
        ->and($result->name)->toBe($artistName)
        ->and($result->url)->toBe('https://www.deezer.com/artist/27');
});

it('returns null when searching for a non-existing artist', function () {
    // Arrange: Simulate an API response with an empty data array.
    Http::fake([
        'api.deezer.com/*' => Http::response(['data' => [], 'total' => 0]),
    ]);

    // Act: Search for an artist that we expect not to find.
    $result = app(DeezerClient::class)->searchArtist('NonExistingArtist');

    // Assert: The result should be null.
    expect($result)->toBeNull();
});

it('returns null when no exact match is found', function () {
    // Arrange: Fake an artist, but search for a slightly different name.
    $artistData = $this->fakeDeezerArtist(['name' => 'Daft Punk']);
    Http::fake([
        'api.deezer.com/*' => Http::response(['data' => [$artistData], 'total' => 1]),
    ]);

    // Act: Search for a name that will not produce an exact match.
    $result = app(DeezerClient::class)->searchArtist('Daft Punkish');

    // Assert: The result should be null because no exact match was found.
    expect($result)->toBeNull();
});

it('throws an exception on api error', function () {
    // Arrange: Simulate an API error response from Deezer.
    Http::fake([
        'api.deezer.com/*' => Http::response([
            'error' => ['type' => 'DataException', 'message' => 'No data', 'code' => 800],
        ], 200), // Deezer can return errors with a 200 status
    ]);

    // Act & Assert: Expect our custom DeezerApiException to be thrown.
    expect(fn () => app(DeezerClient::class)->searchArtist('any'))
        ->toThrow(\App\Exceptions\DeezerApiException::class, 'No data');
});

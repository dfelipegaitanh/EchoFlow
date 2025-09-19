<?php

declare(strict_types=1);

use App\Clients\Music\LastFmClient;
use App\Collections\ArtistCollection;
use App\DTOs\ArtistDto;
use App\Enums\LastFmPeriod;
use App\Exceptions\LastFmApiException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('fetches top artists for a user', function () {
    // Arrange
    fakeTopArtistsResponse([
        fakeArtistData(),
        fakeArtistData('twice'),
    ]);

    // Configura la API key para el test
    config(['services.lastfm.api_key' => 'test-api-key']);

    $client = app(LastFmClient::class);

    // Act
    $artists = $client->getUserTopArtists('test-user', LastFmPeriod::DAYS_7, 2, 1);

    // Assert
    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://ws.audioscrobbler.com/2.0/?method=user.getTopArtists&api_key=test-api-key&format=json&user=test-user&period=7day&limit=2&page=1';
    });

    expect($artists)->toBeInstanceOf(ArtistCollection::class)
        ->and($artists->items)->toHaveCount(2);

    $firstArtist = $artists->items->first();
    expect($firstArtist)->toBeInstanceOf(ArtistDto::class)
        ->and($firstArtist->name)->toBe('IVE')
        ->and($firstArtist->playcount)->toBe(2000)
        ->and($firstArtist->mbid)->toBe('6c52643c-a9b3-452c-bd96-187a2e7b3c27');
});

// Helpers

function fakeTopArtistsResponse(array $artists): void
{
    Http::fake([
        'https://ws.audioscrobbler.com/2.0/*' => Http::response([
            'topartists' => [
                'artist' => $artists,
            ],
        ]),
    ]);
}

function fakeArtistData(string $artist = 'ive', array $overrides = []): array
{
    $artists = [
        'ive' => [
            'name' => 'IVE',
            'playcount' => 2000,
            'mbid' => '6c52643c-a9b3-452c-bd96-187a2e7b3c27',
            'url' => 'https://www.last.fm/music/IVE',
        ],
        'twice' => [
            'name' => 'TWICE',
            'playcount' => 1800,
            'mbid' => '10175331-3253-4P75-8548-808501F51368',
            'url' => 'https://www.last.fm/music/TWICE',
        ],
    ];

    return array_merge($artists[$artist], $overrides);
}

it('throws specific exceptions for different API errors', function (int $errorCode, string $errorMessage, string $expectedMessage) {
    // Arrange
    Http::fake([
        'https://ws.audioscrobbler.com/2.0/*' => Http::response([
            'error' => $errorCode,
            'message' => $errorMessage,
        ], 500),
    ]);

    // Configura la API key para el test
    config(['services.lastfm.key' => 'test-api-key']);

    $client = app(LastFmClient::class);

    // Act & Assert
    expect(fn () => $client->getUserTopArtists('test-user'))
        ->toThrow(LastFmApiException::class, $expectedMessage);
})->with([
    [6, 'Invalid params', 'Invalid parameters: Invalid params'],
    [8, 'Operation failed', 'Operation failed: Operation failed'],
    [9, 'Invalid session key', 'Invalid session key: Invalid session key'],
    [10, 'Invalid API key', 'Invalid API key'],
    [11, 'Service offline', 'Service offline'],
    [13, 'Invalid method signature', 'Invalid method signature'],
    [16, 'Temporary error', 'Temporary error'],
    [17, 'Login required', 'Login required'],
    [26, 'Suspended API key', 'Suspended API key'],
    [29, 'Rate limit exceeded', 'Rate limit exceeded'],
    [99, 'Some other error', 'Some other error'],
]);

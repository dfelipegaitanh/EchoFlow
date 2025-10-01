<?php

declare(strict_types=1);

use App\Clients\Music\LastFmClient;
use App\Collections\ArtistCollection;
use App\DTOs\ArtistDto;
use App\Enums\LastFmPeriod;
use App\Exceptions\LastFmApiException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\Traits\ProvidesLastFmFixtures;

uses(ProvidesLastFmFixtures::class);

beforeEach(function () {
    config(['services.lastfm.api_key' => 'test-api-key']);
});

it('fetches top artists for a user', function () {
    // Arrange
    $this->fakeTopArtistsResponse([
        $this->fakeArtistData('ive'),
        $this->fakeArtistData('twice'),
    ]);

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

it('throws an exception when user is empty', function () {
    // Arrange
    $client = app(LastFmClient::class);

    // Act & Assert
    expect(fn () => $client->getUserTopArtists(''))
        ->toThrow(InvalidArgumentException::class, 'User cannot be empty');
});

it('throws specific exceptions for different API errors', function (int $errorCode, string $errorMessage, string $expectedMessage) {
    // Arrange
    Http::fake([
        'https://ws.audioscrobbler.com/2.0/*' => Http::response([
            'error' => $errorCode,
            'message' => $errorMessage,
        ], 500),
    ]);

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

<?php

declare(strict_types=1);

use App\Clients\Music\LastFmClient;
use App\Exceptions\LastFmApiException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

it('fetches top artists for a user', function () {
    // Arrange
    Http::fake([
        'https://ws.audioscrobbler.com/2.0/*' => Http::response([
            'topartists' => [
                'artist' => [
                    ['name' => 'The Weeknd'],
                    ['name' => 'Daft Punk'],
                ],
            ],
        ]),
    ]);

    $client = new LastFmClient('test-api-key');

    // Act
    $response = $client->getTopArtists('test-user', '7day', 2, 1);

    // Assert
    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://ws.audioscrobbler.com/2.0/?method=user.getTopArtists&api_key=test-api-key&format=json&user=test-user&period=7day&limit=2&page=1';
    });

    expect($response->json('topartists.artist.0.name'))->toBe('The Weeknd')
        ->and($response->json('topartists.artist.1.name'))->toBe('Daft Punk');
});

it('throws specific exceptions for different API errors', function (int $errorCode, string $errorMessage, string $expectedMessage) {
    // Arrange
    Http::fake([
        'https://ws.audioscrobbler.com/2.0/*' => Http::response([
            'error' => $errorCode,
            'message' => $errorMessage,
        ], 500),
    ]);

    $client = new LastFmClient('test-api-key');

    // Act & Assert
    expect(fn () => $client->getTopArtists('test-user'))
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

<?php

declare(strict_types=1);

namespace App\Clients\Music;

use App\Collections\ArtistCollection;
use App\Enums\LastFmPeriod;
use App\Exceptions\LastFmApiException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

final readonly class LastFmClient
{
    private const BASE_URL = 'https://ws.audioscrobbler.com/2.0/';

    private PendingRequest $client;

    public function __construct(private string $apiKey)
    {
        $this->client = Http::baseUrl(self::BASE_URL)
            ->withUserAgent('LastFmV2/1.0')
            ->timeout(30)
            ->retry(3, 100)
            ->throw(fn ($response, $e) => $this->handleApiError($response));
    }

    public function getUserTopArtists(string $user, LastFmPeriod $period = LastFmPeriod::OVERALL, int $limit = 50, int $page = 1): ArtistCollection
    {

        if ($user === '' || $user === '0') {
            throw new InvalidArgumentException('User cannot be empty');
        }

        $response = $this->get('user.getTopArtists', [
            'user' => $user,
            'period' => $period->value,
            'limit' => $limit,
            'page' => $page,
        ]);

        return ArtistCollection::fromLastFm($response->json());
    }

    private function get(string $method, array $parameters = []): Response
    {
        return $this->client->get('', [
            'method' => $method,
            'api_key' => $this->apiKey,
            'format' => 'json',
            ...$parameters,
        ]);
    }

    private function handleApiError(Response $response): void
    {
        $body = $response->json() ?? [];

        $errorCode = $body['error'] ?? null;
        $message = $body['message'] ?? 'Unknown error';

        throw match ($errorCode) {
            6 => new LastFmApiException("Invalid parameters: {$message}", $errorCode),
            8 => new LastFmApiException("Operation failed: {$message}", $errorCode),
            9 => new LastFmApiException("Invalid session key: {$message}", $errorCode),
            10 => new LastFmApiException('Invalid API key', $errorCode),
            11 => new LastFmApiException('Service offline', $errorCode),
            13 => new LastFmApiException('Invalid method signature', $errorCode),
            16 => new LastFmApiException('Temporary error', $errorCode),
            17 => new LastFmApiException('Login required', $errorCode),
            26 => new LastFmApiException('Suspended API key', $errorCode),
            29 => new LastFmApiException('Rate limit exceeded', $errorCode),
            default => new LastFmApiException($message, $errorCode ?? 0),
        };
    }
}

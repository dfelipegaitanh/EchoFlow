<?php

declare(strict_types=1);

namespace App\Clients\Music;

use App\Exceptions\LastFmApiException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class LastFmClient
{
    private const BASE_URL = 'https://ws.audioscrobbler.com/2.0/';

    private PendingRequest $client;

    public function __construct(private readonly string $apiKey)
    {
        $this->client = Http::baseUrl(self::BASE_URL)
            ->withUserAgent('LastFmV2/1.0')
            ->timeout(30)
            ->retry(3, 100)
            ->throw(fn ($response, $e) => $this->handleApiError($response));
    }

    public function getTopArtists(string $user, string $period = 'overall', int $limit = 50, int $page = 1): Response
    {
        return $this->get('user.getTopArtists', [
            'user' => $user,
            'period' => $period,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    private function get(string $method, array $parameters = []): Response
    {
        $response = $this->client->get('', [
            'method' => $method,
            'api_key' => $this->apiKey,
            'format' => 'json',
            ...$parameters,
        ]);

        return $response;
    }

    private function handleApiError(Response $response): void
    {
        $body = $response->json();

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

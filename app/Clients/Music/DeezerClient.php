<?php

declare(strict_types=1);

namespace App\Clients\Music;

use App\DTOs\ArtistDto;
use App\Exceptions\DeezerApiException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Str;

final readonly class DeezerClient
{
    private const BASE_URL = 'https://api.deezer.com';

    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(self::BASE_URL)
            ->withUserAgent('EchoFlow/1.0')
            ->timeout(30)
            ->retry(3, 100)
            ->throw(fn (Response $response) => $this->handleApiError($response));
    }

    public function searchArtist(string $name): ?ArtistDto
    {
        $response = $this->client->get('/search/artist', ['q' => $name]);

        $data = $response->collect('data');

        if ($data->isEmpty()) {
            return null;
        }
        // @phpstan-ignore-next-line
        $artist = $data->first(fn ($item): bool => Str::lower($item['name']) === Str::lower($name));

        if (is_null($artist)) {
            return null;
        }

        return ArtistDto::fromDeezer($artist);
    }

    private function handleApiError(Response $response): never
    {
        $body = $response->json() ?? [];
        $error = $body['error'] ?? [];

        $message = $error['message'] ?? 'Unknown Deezer API error.';
        $code = $error['code'] ?? 0;

        throw new DeezerApiException($message, $code);
    }
}

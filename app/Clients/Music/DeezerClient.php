<?php

declare(strict_types=1);

namespace App\Clients\Music;

use App\DTOs\ArtistDto;
use App\Exceptions\DeezerApiException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

    public function getArtist(string $artistName): ArtistDto
    {
        $artist = $this->searchArtist($artistName);

        if (is_null($artist) || $artist === []) {
            return ArtistDto::empty();
        }

        $response = $this->client->get('/artist/'.$artist['id']);

        return ArtistDto::fromDeezer($response->collect()->toArray());
    }

    public function searchArtist(string $artistName): ?array
    {
        $response = $this->client->get('/search/artist', ['q' => $artistName]);

        if ($error = $response->json('error')) {
            throw new DeezerApiException($error['message'] ?? 'Unknown Error', $error['code'] ?? 0);
        }

        $data = $response->collect('data');

        if ($data->isEmpty()) {
            return null;
        }
        $artist = $data->first(fn ($item): bool => Str::lower($item['name']) === Str::lower($artistName));

        return collect($artist)->toArray();

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

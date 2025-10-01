<?php

declare(strict_types=1);

namespace App\Actions\Deezer;

use App\Clients\Music\DeezerClient;
use App\DTOs\ArtistDto;

final readonly class GetArtistAction
{
    public function __construct(
        private DeezerClient $deezerClient
    ) {}

    /**
     * Execute the action.
     */
    public function handle(string $artistName): ArtistDto
    {
        return $this->deezerClient->getArtist($artistName);
    }
}

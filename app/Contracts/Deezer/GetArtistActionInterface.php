<?php

declare(strict_types=1);

namespace App\Contracts\Deezer;

use App\DTOs\ArtistDto;

interface GetArtistActionInterface
{
    public function handle(string $artistName): ArtistDto;
}

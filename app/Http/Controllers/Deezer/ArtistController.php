<?php

declare(strict_types=1);

namespace App\Http\Controllers\Deezer;

use App\Actions\Deezer\GetArtistAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class ArtistController extends Controller
{
    public function __construct(
        private readonly GetArtistAction $searchArtistAction
    ) {}

    public function getArtist(string $artistName): JsonResponse
    {
        return $this->searchArtistAction
            ->handle($artistName)
            ->toJsonResponse();

    }
}

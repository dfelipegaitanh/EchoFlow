<?php

declare(strict_types=1);

namespace App\Collections;

use App\DTOs\ArtistDto;
use Illuminate\Support\Collection;

final readonly class ArtistCollection
{
    public function __construct(
        public Collection $items
    ) {}

    public static function fromLastFm(array $data): self
    {
        $items = collect($data['topartists']['artist'] ?? [])
            ->map(fn (array $artist): ArtistDto => ArtistDto::fromLastFm($artist));

        return new self($items);
    }
}

<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class ArtistDto
{
    public function __construct(
        public string $name,
        public int $playcount,
        public ?string $mbid,
        public string $url,
    ) {}

    public static function fromLastFm(array $data): self
    {

        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('Missing required fields: name must be present');
        }

        return new self(
            name: $data['name'],
            playcount: (int) ($data['playcount'] ?? 0),
            mbid: $data['mbid'] ?? null,
            url: $data['url'],
        );
    }
}

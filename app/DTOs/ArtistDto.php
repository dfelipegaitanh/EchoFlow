<?php

declare(strict_types=1);

namespace App\DTOs;

use App\DTOs\Shared\HasConversions;
use InvalidArgumentException;

final readonly class ArtistDto
{
    use HasConversions;

    public function __construct(
        public string $name,
        public int $playcount,
        public ?string $mbid,
        public string $url,
        public string $pictureMedium,
        public string $pictureXl,
        public int $nbAlbum,
        public int $nbFan,
        public bool $radio,
        public string $tracklist,
    ) {}

    public static function fromDeezer(array $data): self
    {
        if (! isset($data['name'], $data['link'], $data['id'])) {
            throw new InvalidArgumentException('Missing required fields: name and link must be present');
        }

        return new self(
            name: $data['name'],
            playcount: (int) ($data['nb_fan'] ?? 0),
            mbid: null,
            url: $data['link'],
            pictureMedium: $data['picture_medium'],
            pictureXl: $data['picture_xl'],
            nbAlbum: (int) ($data['nb_album'] ?? 0),
            nbFan: (int) ($data['nb_fan'] ?? 0),
            radio: (bool) ($data['radio'] ?? false),
            tracklist: $data['tracklist']
        );
    }

    public static function fromLastFm(array $data): self
    {

        if (! isset($data['name'])) {
            throw new InvalidArgumentException('Missing required fields: name must be present');
        }

        return new self(
            name: $data['name'],
            playcount: (int) ($data['playcount'] ?? 0),
            mbid: $data['mbid'] ?? null,
            url: $data['url'] ?? '',
            pictureMedium: $data['image'][2]['#text'] ?? '',
            pictureXl: $data['image'][3]['#text'] ?? '',
            nbAlbum: 0,
            nbFan: 0,
            radio: false,
            tracklist: '',
        );
    }
}

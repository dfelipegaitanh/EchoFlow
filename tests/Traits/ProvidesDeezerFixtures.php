<?php

declare(strict_types=1);

namespace Tests\Traits;

trait ProvidesDeezerFixtures
{
    protected function fakeDeezerArtist(array $overrides = []): array
    {
        $base = [
            'id' => 27,
            'name' => 'Daft Punk',
            'link' => 'https://www.deezer.com/artist/27',
            'picture' => 'https://api.deezer.com/artist/27/image',
            'picture_small' => 'https://e-cdns-images.dzcdn.net/images/artist/f2bc007e9133c946ac3c3907ddc5d2ea/56x56-000000-80-0-0.jpg',
            'picture_medium' => 'https://e-cdns-images.dzcdn.net/images/artist/f2bc007e9133c946ac3c3907ddc5d2ea/250x250-000000-80-0-0.jpg',
            'picture_big' => 'https://e-cdns-images.dzcdn.net/images/artist/f2bc007e9133c946ac3c3907ddc5d2ea/500x500-000000-80-0-0.jpg',
            'picture_xl' => 'https://e-cdns-images.dzcdn.net/images/artist/f2bc007e9133c946ac3c3907ddc5d2ea/1000x1000-000000-80-0-0.jpg',
            'nb_album' => 19,
            'nb_fan' => 5868653,
            'radio' => true,
            'tracklist' => 'https://api.deezer.com/artist/27/top?limit=50',
            'type' => 'artist',
        ];

        return array_merge($base, $overrides);
    }
}

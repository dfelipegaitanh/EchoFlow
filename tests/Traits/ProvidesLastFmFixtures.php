<?php

declare(strict_types=1);

namespace Tests\Traits;

use Illuminate\Support\Facades\Http;

trait ProvidesLastFmFixtures
{
    protected function fakeArtistData(string $artist = 'ive', array $overrides = []): array
    {
        $artists = [
            'ive' => [
                'name' => 'IVE',
                'playcount' => 2000,
                'mbid' => '6c52643c-a9b3-452c-bd96-187a2e7b3c27',
                'url' => 'https://www.last.fm/music/IVE',
                'image' => [
                    ['#text' => '', 'size' => 'small'],
                    ['#text' => '', 'size' => 'medium'],
                    ['#text' => 'https://lastfm.freetls.fastly.net/i/u/174s/2a96cbd8b46e442fc41c2b86b821562f.png', 'size' => 'large'],
                    ['#text' => 'https://lastfm.freetls.fastly.net/i/u/300x300/2a96cbd8b46e442fc41c2b86b821562f.png', 'size' => 'extralarge'],
                ],
            ],
            'twice' => [
                'name' => 'TWICE',
                'playcount' => 1800,
                'mbid' => '10175331-3253-4P75-8548-808501F51368',
                'url' => 'https://www.last.fm/music/TWICE',
                'image' => [
                    ['#text' => '', 'size' => 'small'],
                    ['#text' => '', 'size' => 'medium'],
                    ['#text' => 'https://lastfm.freetls.fastly.net/i/u/174s/a6a169a073794301a8c8e77373f0d9c4.png', 'size' => 'large'],
                    ['#text' => 'https://lastfm.freetls.fastly.net/i/u/300x300/a6a169a073794301a8c8e77373f0d9c4.png', 'size' => 'extralarge'],
                ],
            ],
        ];

        return array_merge($artists[$artist], $overrides);
    }

    protected function fakeTopArtistsResponse(array $artists): void
    {
        Http::fake([
            'https://ws.audioscrobbler.com/2.0/*' => Http::response([
                'topartists' => [
                    'artist' => $artists,
                ],
            ]),
        ]);
    }
}

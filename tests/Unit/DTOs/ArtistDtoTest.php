<?php

declare(strict_types=1);

namespace Tests\Unit\DTOs;

use App\DTOs\ArtistDto;
use InvalidArgumentException;
use Tests\Traits\ProvidesDeezerFixtures;

uses(ProvidesDeezerFixtures::class);

it('throws an exception if required fields are missing from deezer data', function (array $data) {
    // Act & Assert
    expect(fn () => ArtistDto::fromDeezer($data))
        ->toThrow(InvalidArgumentException::class, 'Missing required fields: name and link must be present');
})->with([
    'missing id' => [fn () => $this->fakeDeezerArtist(['id' => null])],
    'missing name' => [fn () => $this->fakeDeezerArtist(['name' => null])],
    'missing link' => [fn () => $this->fakeDeezerArtist(['link' => null])],
]);

it('throws an exception if name is missing from data', function () {
    // Arrange
    $data = [
        'playcount' => 100,
        'mbid' => 'some-mbid',
        'url' => 'http://some-url.com',
    ];

    // Act & Assert
    expect(fn () => ArtistDto::fromLastFm($data))
        ->toThrow(InvalidArgumentException::class, 'Missing required fields: name must be present');
});

<?php

declare(strict_types=1);

namespace Tests\Unit\DTOs;

use App\DTOs\ArtistDto;
use InvalidArgumentException;
use Tests\Traits\ProvidesDeezerFixtures;

uses(ProvidesDeezerFixtures::class);

it('throws an exception if required fields are missing from deezer data', function (string $missingField) {
    $data = $this->fakeDeezerArtist([$missingField => null]);

    // Act & Assert
    expect(fn () => ArtistDto::fromDeezer($data))
        ->toThrow(InvalidArgumentException::class, 'Missing required fields: name and link must be present');
})->with([
    'missing id' => ['id'],
    'missing name' => ['name'],
    'missing link' => ['link'],
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

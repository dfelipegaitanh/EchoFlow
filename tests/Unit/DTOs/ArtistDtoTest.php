<?php

declare(strict_types=1);

namespace Tests\Unit\DTOs;

use App\DTOs\ArtistDto;
use InvalidArgumentException;

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

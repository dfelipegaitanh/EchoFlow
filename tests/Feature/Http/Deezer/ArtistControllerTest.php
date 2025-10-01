<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(
        User::factory()->can_deezer()->create(),
        ['deezer']
    );
});

it('returns a successful response for an existing artist', closure: function () {

    $artist = 'IVE';
    $response = $this->get(route('api.deezer.artist-get', $artist));

    expect($response->collect()->toArray())->not->toBeEmpty();

    $response->assertStatus(200)
        ->assertJsonStructure([
            'name',
            'playcount',
            'mbid',
            'url',
            'pictureMedium',
            'pictureXl',
            'nbAlbum',
            'nbFan',
            'radio',
            'tracklist',
        ]);

    expect($response->collect()->toJson())
        ->json()
        ->toHaveCount(10)
        ->name->toBe($artist);

});

it('returns a not found response for a non-existing artist', function () {

    $artist = 'xxx....xxxx';

    $response = $this->get(route('api.deezer.artist-get', $artist));

    $response->assertStatus(404)
        ->assertJsonStructure([
            'message',
        ]);

    expect($response->collect()->toArray())->not->toBeEmpty()
        ->and($response->collect()->toJson())
        ->json()
        ->toHaveCount(1)
        ->message->toBe('Artist not found');

});

it('returns a validation error for an invalid artist name', function () {

    $invalidName = '<script>alert("xss")</script>';
    $response = $this->get('/api/deezer/artist/'.urlencode($invalidName));
    $response->assertStatus(404);

    $specialChars = '!@#$%^&*()';
    $response = $this->get('/api/deezer/artist/'.urlencode($specialChars));
    $response->assertStatus(404);

    $response = $this->get('/api/deezer/artist/');
    $response->assertStatus(404);

    $onlySpaces = '   ';
    $response = $this->get('/api/deezer/artist/'.urlencode($onlySpaces));
    $response->assertStatus(404);

    $tooLong = str_repeat('a', 256);
    $response = $this->get('/api/deezer/artist/'.urlencode($tooLong));
    $response->assertStatus(404);

});

it('returns a forbidden response for a user without deezer permission', function () {

    Sanctum::actingAs(
        User::factory()->create(),
    );
    $artist = 'xxx....xxxx';

    $response = $this->get(route('api.deezer.artist-get', $artist));
    $response->asssertStatus(300);

});

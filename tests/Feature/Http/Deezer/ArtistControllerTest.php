<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\actingAs;

it('returns a successful response for an existing artist', closure: function () {

    $user = User::factory()->can_deezer()->create();
    $artist = 'IVE';

    $response = actingAs($user)
        ->get(route('api.deezer.artist-get', $artist));

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

    $user = User::factory()->can_deezer()->create();
    $artist = 'xxx....xxxx';

    $response = actingAs($user)
        ->get(route('api.deezer.artist-get', $artist));

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
    // TODO: Implement this test
});

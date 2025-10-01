<?php

declare(strict_types=1);

use App\Models\User;

uses()->group('unit', 'models');

it('returns empty string when no permissions are enabled', function () {
    expect(User::factory()->create()->getAllPermissions())->toBe('');
});

it('returns last_fm when username and permission are enabled', function () {
    $user = User::factory()
        ->can_last_fm()
        ->create();

    expect($user->getAllPermissions())->toBe('last_fm');
});

it('ignores last_fm when no username is provided', function () {
    $user = User::factory()
        ->can_last_fm()
        ->without_last_fm_username()
        ->create();

    expect($user->getAllPermissions())->toBe('');
});

it('ignores last_fm when permission is disabled', function () {
    $user = User::factory()
        ->with_last_fm_username()
        ->create();

    expect($user->getAllPermissions())->toBe('');
});

it('returns deezer when enabled', function () {
    $user = User::factory()
        ->can_deezer()
        ->create();

    expect($user->getAllPermissions())->toBe('deezer');
});

it('returns spotify when enabled', function () {
    $user = User::factory()
        ->can_spotify()
        ->create();

    expect($user->getAllPermissions())->toBe('spotify');
});

it('returns multiple permissions comma separated', function () {
    $user = User::factory()
        ->with_last_fm_username()
        ->can_last_fm()
        ->can_deezer()
        ->can_spotify()
        ->create();

    $permissions = $user->getAllPermissions();
    $permissionsArray = explode(',', $permissions);

    expect($permissionsArray)
        ->toHaveCount(3)
        ->toContain('last_fm')
        ->toContain('deezer')
        ->toContain('spotify');
});

it('returns deezer and spotify without last_fm', function () {
    $user = User::factory()
        ->can_deezer()
        ->can_spotify()
        ->create();

    $permissions = $user->getAllPermissions();
    $permissionsArray = explode(',', $permissions);

    expect($permissionsArray)
        ->toHaveCount(2)
        ->toContain('deezer')
        ->toContain('spotify')
        ->not->toContain('last_fm');
});

it('returns last_fm and deezer without spotify', function () {
    $user = User::factory()
        ->can_last_fm()
        ->can_deezer()
        ->create();

    $permissions = $user->getAllPermissions();
    $permissionsArray = explode(',', $permissions);

    expect($permissionsArray)
        ->toHaveCount(2)
        ->toContain('last_fm')
        ->toContain('deezer')
        ->not->toContain('spotify');
});

it('returns last_fm and spotify without deezer', function () {
    $user = User::factory()
        ->can_last_fm()
        ->can_spotify()
        ->create();

    $permissions = $user->getAllPermissions();
    $permissionsArray = explode(',', $permissions);

    expect($permissionsArray)
        ->toHaveCount(2)
        ->toContain('last_fm')
        ->toContain('spotify')
        ->not->toContain('deezer');
});

<?php

declare(strict_types=1);

use App\Models\User;
use Livewire\Volt\Volt as LivewireVolt;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('Can login', function () {

    $user = User::factory(
    )->create();

    $response = $this->actingAs($user)
        ->post(route('api.login'), ['email' => $user->email, 'password' => 'password']);

    $response->assertStatus(200);
});

test('Login with wrong password', function () {

    $user = User::factory(
    )->create();
    $response = $this->actingAs($user)
        ->post(route('api.login'), ['email' => $user->email, 'password' => 'wrong-password']);

    $response->assertStatus(401);
});

test('login screen can be rendered', function (): void {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function (): void {
    $user = User::factory()->create();

    $response = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function (): void {
    $user = User::factory()->create();

    $response = LivewireVolt::test('auth.login')
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login');

    $response->assertHasErrors('email');

    $this->assertGuest();
});

test('users can logout', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('home'));

    $this->assertGuest();
});

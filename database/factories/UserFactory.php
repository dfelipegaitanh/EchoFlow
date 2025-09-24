<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     *
     * @phpstan-ignore-next-line
     */
    private static ?string $password;

    public function can_deezer(): self
    {
        return $this->state(fn (array $attributes): array => [
            'can_deezer' => true,
        ]);
    }

    public function can_last_fm(): self
    {
        return $this->state(fn (array $attributes): array => [
            'can_last_fm' => true,
        ]);
    }

    public function can_spotify(): self
    {
        return $this->state(fn (array $attributes): array => [
            'can_spotify' => true,
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => self::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'last_fm_username' => '',
            'can_last_fm' => false,
            'can_spotify' => false,
            'can_deezer' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): self
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    public function with_last_fm_username(): self
    {
        return $this->state(fn (array $attributes): array => [
            'last_fm_username' => fake()->userName(),
        ]);
    }
}

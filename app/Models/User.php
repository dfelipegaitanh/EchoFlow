<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $name
 * @property string $email
 * @property string $last_fm_username
 * @property bool $can_last_fm
 * @property bool $can_spotify
 * @property bool $can_deezer
 */
final class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    public const ALL = [
        self::LAST_FM,
        self::SPOTIFY,
        self::DEEZER,
    ];

    public const DEEZER = 'deezer';

    public const LAST_FM = 'last_fm';

    public const PERMISSIONS = [
        self::LAST_FM => 'last_fm',
        self::SPOTIFY => 'spotify',
        self::DEEZER => 'deezer',
    ];

    public const SPOTIFY = 'spotify';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAllPermissions(): string
    {
        $permissions = [];
        if ($this->last_fm_username && $this->can_last_fm) {
            $permissions[] = self::PERMISSIONS[self::LAST_FM];
        }

        if ($this->can_deezer) {
            $permissions[] = self::PERMISSIONS[self::DEEZER];
        }

        if ($this->can_spotify) {
            $permissions[] = self::PERMISSIONS[self::SPOTIFY];
        }

        return implode(',', $permissions);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'email' => $this->email,
            'name' => $this->name,
            'token' => $this->resource->createToken(
                'Token: '.$this->email,
                ['ability:'.$this->resource->getAllPermissions()],
                now()->addDay()
            )->plainTextToken,
        ];
    }
}

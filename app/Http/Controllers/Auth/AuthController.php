<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request): JsonResponse
    {

        if (! Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('Invalid Credentials', 401);
        }

        return $this->ok(
            'Authenticated',
            new UserResource(Auth::user()),
        );
    }
}

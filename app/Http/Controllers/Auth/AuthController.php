<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Auth;
use Illuminate\Http\JsonResponse;

final class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request): JsonResponse
    {
        //        $request->validated();

        // @phpstan-ignore-next-line
        if (! Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('Invalid Credentials', 500);
        }

        // @phpstan-ignore-next-line
        $user = User::firstWhere('email', $request->get('email'));

        return $this->ok(
            'Authenticated',
            new UserResource($user),
        );
    }
}

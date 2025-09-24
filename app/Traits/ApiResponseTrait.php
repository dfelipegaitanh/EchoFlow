<?php

declare(strict_types=1);

namespace App\Traits;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait ApiResponseTrait
{
    protected function error(string|array|Collection $message, int $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    //    protected function notContent(): Response
    //    {
    //        return response()->noContent();
    //    }

    protected function ok(string $message, UserResource $data): JsonResponse
    {
        return $this->success($message, 200, $data);
    }

    protected function success(string $message, int $code, UserResource $data): JsonResponse
    {
        $response = [
            'message' => $message,
        ];
        $response['data'] = $data;

        return response()->json($response, $code);
    }
}

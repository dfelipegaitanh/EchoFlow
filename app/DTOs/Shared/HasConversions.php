<?php

declare(strict_types=1);

namespace App\DTOs\Shared;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;

trait HasConversions
{
    /**
     * Convert the DTO to an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $data = [];

        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }

    /**
     * Convert the DTO to a Laravel Collection.
     *
     * @return Collection<string, mixed>
     */
    public function toCollection(): Collection
    {
        return new Collection($this->toArray());
    }

    /**
     * Convert the DTO to a JSON string.
     */
    public function toJson(): string
    {
        return $this->toCollection()->toJson();
    }

    /**
     * Convert the DTO to a JSON response.
     */
    public function toJsonResponse(): JsonResponse
    {
        return response()->json($this->toCollection());
    }
}

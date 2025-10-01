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
            // Skip static properties—they aren’t part of this DTO instance’s data.
            if ($property->isStatic()) {
                continue;
            }

            // If a typed property hasn’t been initialized yet, avoid a fatal error and emit null.
            if (! $property->isInitialized($this)) {
                $data[$property->getName()] = null;

                continue;
            }

            // Safe to read now that it’s initialized and non-static.
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
    /*
    public function toJson(): string
    {
        return $this->toCollection()->toJson();
    }
    */

    /**
     * Convert the DTO to a JSON response.
     */
    public function toJsonResponse(): JsonResponse
    {
        return response()->json($this->toCollection());
    }
}

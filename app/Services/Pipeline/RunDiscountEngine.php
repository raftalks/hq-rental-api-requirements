<?php

namespace App\Services\Pipeline;

use App\Services\DiscountEngine\DiscountEngine;
use App\Services\DTO\Payload;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataPipes\DataPipe;
use Spatie\LaravelData\Support\DataClass;

class RunDiscountEngine implements DataPipe
{
    public function handle(mixed $payload, DataClass $class, Collection $properties): Collection
    {
        $payloadDTO = new Payload(
            sku: $payload->sku,
            name: $payload->name,
            category: $payload->category,
            price: $payload->price
        );

        return DiscountEngine::apply($payloadDTO);
    }
}

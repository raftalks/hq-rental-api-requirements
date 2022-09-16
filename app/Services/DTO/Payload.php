<?php

namespace App\Services\DTO;

use Spatie\LaravelData\Data;

class Payload extends Data
{
    public function __construct(
        public readonly string $sku,
        public readonly string $name,
        public readonly string $category,
        public readonly int $price,
    ) {
    }
}

<?php

namespace App\Services\DTO;

class Price
{
    public function __construct(
        public readonly int $original,
        public readonly int $final,
        public readonly string|null $discount_percentage,
        public readonly string $currency
    ) {
    }
}

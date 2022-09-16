<?php

namespace App\Services\DiscountEngine\Rules;

use App\Services\Contracts\DiscountRule;
use App\Services\DTO\Payload;

class SkuDiscount implements DiscountRule
{
    public function __construct(
        protected string $sku,
        public readonly int $discount
    ) {
    }

    public function evaluate(Payload $payload): bool
    {
        return $payload->sku === $this->sku;
    }

    public function getDiscountAmount(): int
    {
        return $this->discount;
    }
}

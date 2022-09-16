<?php

namespace App\Services\DiscountEngine\Rules;

use App\Services\Contracts\DiscountRule;
use App\Services\DTO\Payload;

class CategoryDiscount implements DiscountRule
{
    public function __construct(
        protected string $category,
        public readonly int $discount
    ) {
    }

    public function evaluate(Payload $payload): bool
    {
        return $payload->category === $this->category;
    }

    public function getDiscountAmount(): int
    {
        return $this->discount;
    }
}

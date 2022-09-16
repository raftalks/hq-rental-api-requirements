<?php

namespace App\Services\Contracts;

use App\Services\DTO\Payload;

interface DiscountRule
{
    public function evaluate(Payload $payload): bool;

    public function getDiscountAmount(): int;
}

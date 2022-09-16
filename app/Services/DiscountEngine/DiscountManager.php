<?php

namespace App\Services\DiscountEngine;

use App\Services\Contracts\DiscountRule;
use App\Services\DTO\Payload;
use App\Services\DTO\Price;
use Illuminate\Support\Collection;
use Money\Money;

class DiscountManager
{
    public function __construct(
        protected array $rules = []
    ) {
    }

    public function addRule(DiscountRule $rule)
    {
        $this->rules[] = $rule;
    }

    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            $this->addRule($rule);
        }
    }

    public function apply(Payload $payload): Collection
    {
        $discountedProduct = null;
        foreach ($this->rules as $rule) {
            if ($this->evaluateRule($rule, $payload)) {
                $discountedProduct = $this->applyDiscount($rule, $payload);
                break;
            }
        }

        return $discountedProduct ?? collect($this->transformPayload($payload));
    }

    protected function evaluateRule(DiscountRule $rule, Payload $payload): bool
    {
        return $rule->evaluate($payload);
    }

    protected function applyDiscount(DiscountRule $rule, Payload $payload): Collection
    {
        $discountPercent = $rule->getDiscountAmount();
        $priceOriginal = Money::EUR($payload->price);
        if ($discountPercent) {
            $discountAmount = $priceOriginal->multiply(strval($discountPercent / 100));
            $priceFinal = $priceOriginal->subtract($discountAmount);
        } else {
            $priceFinal = $priceOriginal;
        }

        return collect($this->transformPayload($payload, new Price(
            original: $priceOriginal->getAmount(),
            final: $priceFinal->getAmount(),
            discount_percentage: $discountPercent.'%' ?? null,
            currency: $priceFinal->getCurrency()->getCode()
        )));
    }

    protected function transformPayload(Payload $payload, Price $priceData = null): array
    {
        $price = [
            'sku' => $payload->sku,
            'name' => $payload->name,
            'category' => $payload->category,
        ];

        if ($priceData) {
            $price['price'] = $priceData;
        } else {
            $price['price'] = new Price(
                original: $payload->price,
                final: $payload->price,
                discount_percentage: null,
                currency: 'EUR'
            );
        }

        return $price;
    }
}

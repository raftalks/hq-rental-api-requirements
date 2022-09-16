<?php

namespace App\Services\DTO;

use App\Services\Pipeline\RunDiscountEngine;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataPipeline;
use Spatie\LaravelData\DataPipes\AuthorizedDataPipe;

class Product extends Data
{
    public function __construct(
        public string $sku,
        public string $name,
        public string $category,
        public Price $price,
    ) {
    }

    public static function pipeline(): DataPipeline
    {
        return DataPipeline::create()
            ->into(static::class)
            ->through(AuthorizedDataPipe::class)
            ->through(RunDiscountEngine::class);
    }
}

<?php

namespace App\Services;

use App\Services\DTO\Product;
use Spatie\LaravelData\DataCollection;

class InventoryRepository
{
    /**
     * Note: Instead of using a database, I have setup here to return the products
     * as DataCollection contain each product as a DTO.
     *
     * @return DataCollection
     */
    public function getProducts($items): DataCollection
    {
        return Product::collection($items);
    }
}

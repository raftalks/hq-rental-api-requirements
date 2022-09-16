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
    public function getProducts(): DataCollection
    {
        $items = json_decode('[ { "sku": "000001", "name": "Full coverage insurance", "category": "insurance", "price": 89000 }, { "sku": "000002", "name": "Compact Car X3", "category": "vehicle", "price": 99000 }, { "sku": "000003", "name": "SUV Vehicle, high end", "category": "vehicle", "price": 150000 }, { "sku": "000004", "name": "Basic coverage", "category": "insurance", "price": 20000 }, { "sku": "000005", "name": "Convertible X2, Electric", "category": "vehicle", "price": 250000 } ]');

        return Product::collection($items);
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Request;

class ProductRepository
{
    public function getProducts(Request $request): array
    {
        $items = collect(json_decode('[ { "sku": "000001", "name": "Full coverage insurance", "category": "insurance", "price": 89000 }, { "sku": "000002", "name": "Compact Car X3", "category": "vehicle", "price": 99000 }, { "sku": "000003", "name": "SUV Vehicle, high end", "category": "vehicle", "price": 150000 }, { "sku": "000004", "name": "Basic coverage", "category": "insurance", "price": 20000 }, { "sku": "000005", "name": "Convertible X2, Electric", "category": "vehicle", "price": 250000 } ]'));

        return $items->when($request->query('category'), function ($collection) use ($request) {
            return $collection->where('category', $request->query('category'));
        })->when($request->query('price'), function ($collection) use ($request) {
            return $collection->where('price', $request->query('price'));
        })->toArray();
    }
}

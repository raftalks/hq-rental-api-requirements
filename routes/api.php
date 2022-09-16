<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// No api middelware set and this endpoint is accessible to public
Route::get('/products', function (Request $request) {
    /**
     * Here I have defined the discount rules into the discount engine.
     * This can be set dynamically from a config or discount rules taken
     * from a database table. To simplify, I have defined the rules directly in the route.
     */
    \App\Services\DiscountEngine\DiscountEngine::addRules([
        new \App\Services\DiscountEngine\Rules\CategoryDiscount(
            category: 'insurance', discount: 30
        ),
        new \App\Services\DiscountEngine\Rules\SkuDiscount(
            sku: '000003', discount: 15
        ),
    ]);

    $items = (new \App\Services\ProductRepository())->getProducts($request);

    return (new \App\Services\InventoryRepository())->getProducts($items);
});

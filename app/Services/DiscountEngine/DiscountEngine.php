<?php

namespace App\Services\DiscountEngine;

use Illuminate\Support\Facades\Facade;

class DiscountEngine extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'discount.manager';
    }
}

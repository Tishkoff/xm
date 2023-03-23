<?php

namespace App\Xm\Contracts;

use App\Xm\Price\PricesCollection;

interface IPricesFetcher
{
    public function getPrices(string $symbol): PricesCollection;
}

<?php

namespace App\Xm;

use App\Xm\Price\PricesCollection;
use Carbon\CarbonInterface;

class PricesFilterByDate
{
    public function filter(PricesCollection $prices, CarbonInterface $startDate, CarbonInterface $endDate): PricesCollection
    {
        $returnCollection = new PricesCollection();

        foreach ($prices->all() as $price) {
            if ($price->getDate() >= $startDate->timestamp && $price->getDate() <= $endDate->timestamp) {
                $returnCollection->add($price);
            }
        }

        return $returnCollection;
    }
}

<?php

namespace App\Xm\Price;

class PricesCollection
{
    /**
     * @var Price[]
     */
    private array $list = [];

    public function __construct(Price ...$prices)
    {
        foreach ($prices as $price) {
            $this->add($price);
        }
    }

    public function add(Price $price): void
    {
        $this->list[] = $price;
    }

    /**
     * @return Price[]
     */
    public function all(): array
    {
        return $this->list;
    }
}

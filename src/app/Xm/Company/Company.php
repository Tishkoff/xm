<?php

namespace App\Xm\Company;

class Company
{
    private ?string $name;
    private ?string $symbol;

    /**
     * @param string|null $companyName
     * @param string|null $symbol
     */
    public function __construct(?string $companyName, ?string $symbol)
    {
        $this->name = $companyName;
        $this->symbol = $symbol;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }
}

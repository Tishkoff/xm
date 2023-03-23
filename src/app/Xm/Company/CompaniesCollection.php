<?php

namespace App\Xm\Company;

class CompaniesCollection
{
    /**
     * @var Company[]
     */
    private array $list = [];

    public function __construct(Company ...$companies)
    {
        foreach ($companies as $company) {
            $this->add($company);
        }
    }

    public function add(Company $company): void
    {
        $this->list[$company->getSymbol()] = $company;
    }

    /**
     * @return Company[]
     */
    public function all(): array
    {
        return $this->list;
    }

    public function exists(string $companySymbol): bool
    {
        return array_key_exists($companySymbol, $this->list);
    }

    public function get(string $companySymbol): ?Company
    {
        return $this->all()[$companySymbol] ?? null;
    }
}

<?php

namespace App\Xm\Cache;

use App\Xm\Company\CompaniesCollection;
use App\Xm\Company\CompaniesFetcher;
use App\Xm\Contracts\ICompaniesFetcher;
use Illuminate\Support\Facades\Cache;

class CompaniesCache implements ICompaniesFetcher
{
    protected const KEY = 'companies';

    protected CompaniesFetcher $fetcher;

    /**
     * @param CompaniesFetcher $fetcher
     */
    public function __construct(CompaniesFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function getCompanies(): CompaniesCollection
    {
        if (Cache::has(self::KEY)) {
            return Cache::get(self::KEY);
        }

        $companies = $this->fetcher->getCompanies();
        Cache::add(self::KEY, $companies);

        return $companies;
    }
}

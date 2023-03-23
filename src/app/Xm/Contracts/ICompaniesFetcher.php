<?php

namespace App\Xm\Contracts;

use App\Xm\Company\CompaniesCollection;

interface ICompaniesFetcher
{
    public function getCompanies(): CompaniesCollection;
}

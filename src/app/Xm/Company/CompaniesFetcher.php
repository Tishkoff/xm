<?php

namespace App\Xm\Company;

use App\Xm\Contracts\ICompaniesFetcher;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class CompaniesFetcher implements ICompaniesFetcher
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getCompanies(): CompaniesCollection
    {
        $result = new CompaniesCollection();

        try {
            $response = Http::get($this->url, []);
            if ($response->successful()) {
                $data = $response->json();

                foreach ($data ?? [] as $body) {
                    $result->add(new Company(
                        $body["Company Name"] ?? null,
                        $body["Symbol"] ?? null
                    ));
                }
            }
        } catch (Exception $ex) {

        }

        return $result;
    }
}

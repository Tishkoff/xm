<?php

namespace Tests\Unit;

use App\Xm\Company\CompaniesFetcher;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CompaniesFetcherTest extends TestCase
{
    public function test_get_companies(): void
    {
        Http::fake([
            'pkgstore.datahub.io/*' => Http::response(
                '[{"Company Name": "iShares MSCI All Country Asia Information Technology Index Fund", "Financial Status": "N", "Market Category": "G", "Round Lot Size": 100.0, "Security Name": "iShares MSCI All Country Asia Information Technology Index Fund", "Symbol": "AAIT", "Test Issue": "N"},{"Company Name": "American Airlines Group, Inc.", "Financial Status": "N", "Market Category": "Q", "Round Lot Size": 100.0, "Security Name": "American Airlines Group, Inc. - Common Stock", "Symbol": "AAL", "Test Issue": "N"}]',
                200
            ),
        ]);

        $sut = new CompaniesFetcher('pkgstore.datahub.io/aaaa');
        $companies = $sut->getCompanies()->all();

        $this->assertCount(2, $companies);
        $this->assertArrayHasKey('AAIT', $companies);
        $this->assertSame('iShares MSCI All Country Asia Information Technology Index Fund', $companies['AAIT']->getName());
        $this->assertSame('AAIT', $companies['AAIT']->getSymbol());
        $this->assertArrayHasKey('AAL', $companies);
        $this->assertSame('American Airlines Group, Inc.', $companies['AAL']->getName());
        $this->assertSame('AAL', $companies['AAL']->getSymbol());
    }

    public function test_get_empty_companies(): void
    {
        Http::fake([
            'pkgstore.datahub.io/*' => Http::response(
                '[]',
                200
            ),
        ]);

        $sut = new CompaniesFetcher('pkgstore.datahub.io/aaaa');
        $companies = $sut->getCompanies()->all();

        $this->assertCount(0, $companies);
    }

    public function test_request_error(): void
    {
        Http::fake([
            'pkgstore.datahub.io/*' => Http::response(
                '',
                500
            ),
        ]);

        $sut = new CompaniesFetcher('pkgstore.datahub.io/aaaa');
        $companies = $sut->getCompanies()->all();

        $this->assertCount(0, $companies);
    }
}

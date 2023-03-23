<?php

namespace Tests\Unit;

use App\Xm\Price\PricesFetcher;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PricesFetcherTest extends TestCase
{
    public function test_get_companies(): void
    {
        Http::fake([
            'yh-finance.p.rapidapi.com/*' => Http::response(
                '{"prices": [{"date": 1679491800,"open": 1.6399999856948853,"high": 1.6399999856948853,"low": 1.5299999713897705,"close": 1.5299999713897705,"volume": 2387700,"adjclose": 1.5299999713897705},{"date": 1679405400,"open": 1.6100000143051147,"high": 1.659999966621399,"low": 1.5700000524520874,"close": 1.6200000047683716,"volume": 3387300,"adjclose": 1.6200000047683716}],"isPending": false,"firstTradeDate": 1023370200,"id": "","timeZone": {"gmtOffset": -14400},"eventsData": []}',
                200
            ),
        ]);

        $sut = new PricesFetcher('yh-finance.p.rapidapi.com/aaaa', 'bbbb');
        $prices = $sut->getPrices('AMRN')->all();

        $this->assertCount(2, $prices);

        $this->assertArrayHasKey(0, $prices);
        $this->assertSame(1679491800, $prices[0]->getDate());
        $this->assertSame(1.6399999856948853, $prices[0]->getOpen());
        $this->assertSame(1.6399999856948853, $prices[0]->getHigh());
        $this->assertSame(1.5299999713897705, $prices[0]->getLow());
        $this->assertSame(1.5299999713897705, $prices[0]->getClose());
        $this->assertSame(2387700, $prices[0]->getVolume());
        $this->assertSame('2023-03-22', $prices[0]->getDateFormatted());

        $this->assertArrayHasKey(1, $prices);
        $this->assertSame(1679405400, $prices[1]->getDate());
        $this->assertSame(1.6100000143051147, $prices[1]->getOpen());
        $this->assertSame(1.659999966621399, $prices[1]->getHigh());
        $this->assertSame(1.5700000524520874, $prices[1]->getLow());
        $this->assertSame(1.6200000047683716, $prices[1]->getClose());
        $this->assertSame(3387300, $prices[1]->getVolume());
        $this->assertSame('2023-03-21', $prices[1]->getDateFormatted());
    }

    public function test_get_empty_companies(): void
    {
        Http::fake([
            'yh-finance.p.rapidapi.com/*' => Http::response(
                '{"prices": [],"isPending": false,"firstTradeDate": 1023370200,"id": "","timeZone": {"gmtOffset": -14400},"eventsData": []}',
                200
            ),
        ]);

        $sut = new PricesFetcher('yh-finance.p.rapidapi.com/aaaa', 'bbbb');
        $prices = $sut->getPrices('AMRN')->all();

        $this->assertCount(0, $prices);
    }

    public function test_request_error(): void
    {
        Http::fake([
            'yh-finance.p.rapidapi.com/*' => Http::response(
                '',
                500
            ),
        ]);

        $sut = new PricesFetcher('yh-finance.p.rapidapi.com/aaaa', 'bbbb');
        $prices = $sut->getPrices('AMRN')->all();

        $this->assertCount(0, $prices);
    }
}

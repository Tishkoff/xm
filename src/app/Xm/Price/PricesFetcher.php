<?php

namespace App\Xm\Price;

use App\Xm\Contracts\IPricesFetcher;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class PricesFetcher implements IPricesFetcher
{
    protected string $url;
    protected string $apiKey;

    public function __construct(string $url, string $apiKey)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

    public function getPrices(string $symbol): PricesCollection
    {
        $result = new PricesCollection();

        try {
            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
                'X-RapidAPI-Key' => $this->apiKey,
            ])->get($this->url, [
                'symbol' => $symbol,
            ]);

            $data = $response->json();

            foreach ($data['prices'] ?? [] as $body) {
                $result->add(new Price(
                    $body['date'] ?? null,
                    $body['open'] ?? null,
                    $body['high'] ?? null,
                    $body['low'] ?? null,
                    $body['close'] ?? null,
                    $body['volume'] ?? null
                ));
            }
        } catch (Exception $ex) {

        }

        return $result;
    }
}

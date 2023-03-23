<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryGetRequest;
use App\Mail\HistoryRequest;
use App\Xm\Contracts\ICompaniesFetcher;
use App\Xm\Contracts\IPricesFetcher;
use App\Xm\PricesFilterByDate;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected ICompaniesFetcher $companiesFetcher;
    protected IPricesFetcher $pricesFetcher;
    protected PricesFilterByDate $pricesFilterByDate;

    public function __construct(
        ICompaniesFetcher $companiesFetcher,
        IPricesFetcher $pricesFetcher,
        PricesFilterByDate $pricesFilterByDate
    ) {
        $this->companiesFetcher = $companiesFetcher;
        $this->pricesFetcher = $pricesFetcher;
        $this->pricesFilterByDate = $pricesFilterByDate;
    }

    public function index(): View
    {
        $companies = $this->companiesFetcher->getCompanies();

        return view('index', ['companies' => $companies]);
    }

    public function data(HistoryGetRequest $request): View
    {
        $prices = $this->pricesFetcher->getPrices($request->get('symbol'));
        $startDate = CarbonImmutable::createFromFormat('Y-m-d', $request->get('start_date'));
        $endDate = CarbonImmutable::createFromFormat('Y-m-d', $request->get('end_date'));
        $filteredPrices = $this->pricesFilterByDate->filter($prices, $startDate, $endDate);

        $companies = $this->companiesFetcher->getCompanies();
        $company = $companies->get($request->get('symbol'));

        Mail::to($request->get('email'))->send(new HistoryRequest($company, $startDate, $endDate));

        return view('data', ['prices' => $filteredPrices]);
    }
}

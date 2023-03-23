<?php

namespace App\Providers;

use App\Xm\Cache\CompaniesCache;
use App\Xm\Company\CompaniesFetcher;
use App\Xm\Contracts\ICompaniesFetcher;
use App\Xm\Contracts\IPricesFetcher;
use App\Xm\Price\PricesFetcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICompaniesFetcher::class, CompaniesCache::class);
        $this->app->when(CompaniesFetcher::class)
            ->needs('$url')
            ->giveConfig('app.companies_url');

        $this->app->bind(IPricesFetcher::class, PricesFetcher::class);
        $this->app->when(PricesFetcher::class)
            ->needs('$url')
            ->giveConfig('app.prices_url');
        $this->app->when(PricesFetcher::class)
            ->needs('$apiKey')
            ->giveConfig('app.prices_api_key');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

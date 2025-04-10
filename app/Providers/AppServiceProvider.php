<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Repository\PricingRepository;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PricingRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PricingRepositoryInterface::class,PricingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe((TransactionObserver::class));
    }
}

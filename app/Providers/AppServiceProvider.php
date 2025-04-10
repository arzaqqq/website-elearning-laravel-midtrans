<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Repository\PricingRepository;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;
use App\Repository\TransactionRepository;
use App\Repositories\PricingRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PricingRepositoryInterface::class,PricingRepository::class);
        $this->app->singleton(TransactionRepositoryInterface::class,TransactionRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe((TransactionObserver::class));
    }
}

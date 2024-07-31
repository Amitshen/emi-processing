<?php

namespace App\Providers;

use App\Repositories\LoanDetailRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\LoanDetailRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(LoanDetailRepositoryInterface::class, LoanDetailRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

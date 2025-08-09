<?php

namespace App\Providers;

use App\Repositories\Eloquent\InvoiceRepository;
use App\Repositories\Eloquent\PlanRepository;
use App\Repositories\Eloquent\SubscriptionRepository;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);
        $this->app->bind(SubscriptionRepository::class, SubscriptionRepository::class);
        $this->app->bind(SubscriptionService::class, SubscriptionService::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Inertia::share('flash', function () {
        return session('flash');
    });
    }
}

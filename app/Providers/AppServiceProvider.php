<?php

namespace App\Providers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            ProductRepositoryInterface::class,
            \App\Repositories\ProductRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Contracts\MetroRepositoryInterface::class,
            \App\Repositories\MetroRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Contracts\ClientInterface::class,
            \App\Repositories\ClientRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}

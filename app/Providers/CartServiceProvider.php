<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartModelRepository;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class, function () {
            return new CartModelRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php
namespace App\Providers;

use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Category Repository Binding
        $this->app->bind(
            // Category Repository Binding
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        // Cart Repository Binding
        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );

        // // Cart Service Binding (optional, but recommended if you want to control its instantiation)
        // $this->app->singleton(
        //     CartService::class,
        //     function ($app) {
        //         return new CartService(
        //             $app->make(CartRepositoryInterface::class),
        //             // inject other dependencies as needed
        //         );
        //     }
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

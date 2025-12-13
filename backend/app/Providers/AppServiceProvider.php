<?php
namespace App\Providers;

use App\Repositories\Contracts\API\ApiCategoryRepositoryInterface;
use App\Repositories\Contracts\API\ApiProductRepositoryInterface;
use App\Repositories\Contracts\API\ApiSliderRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquent\API\ApiCategoryRepository;
use App\Repositories\Eloquent\API\ApiSliderRepository;
use App\Repositories\Eloquent\API\ApiProductRepository;
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
        // Admin Category Repository Binding
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        // Add to register() method:
        $this->app->bind(
            ApiProductRepositoryInterface::class,
            ApiProductRepository::class
        );

        // API Category Repository Binding
        $this->app->bind(
            ApiCategoryRepositoryInterface::class,
            ApiCategoryRepository::class
        );

        // API Slider Repository Binding
        $this->app->bind(
            ApiSliderRepositoryInterface::class,
            ApiSliderRepository::class
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

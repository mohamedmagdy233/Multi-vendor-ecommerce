<?php

namespace App\Providers;

use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepository::class, function () {
            return new CartModelRepository();
        });

//        $this->app->bind('currency.converter', function () {
//            return new CurrencyConverter(config('services.currency_converter.api_key'));
//        });

//        $this->app->bind('stripe.client', function() {
//            return new \Stripe\StripeClient(config('services.stripe.secret_key'));
//        });

//        if (App::environment('production')) {
//            $this->app->singleton('path.public', function () {
//                return base_path('public_html');
//            });
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
     paginator::useBootstrapFour();
    }
}

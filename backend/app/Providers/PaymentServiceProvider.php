<?php
namespace App\Providers;

use App\Contracts\PaymentGatewayInterface;
use App\Services\Payments\PaymobGateway;
use App\Services\Payments\StripeGateway;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $gateway = request()->get('gateway', 'stripe');

            return match ($gateway) {
                'stripe' => new StripeGateway(),
                'paymob' => new PaymobGateway(),
                default  => new StripeGateway(),
            };
        });
    }
}

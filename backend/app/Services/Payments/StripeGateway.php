<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class StripeGateway implements PaymentGatewayInterface
{
    public function chagre(array $data)
    {
        // Stripe charge logic
        return ['status' => 'success' , 'gateway' => 'stripe'];
    }

    public function handleWebhook(array $payload)
    {
        // Handle Stripe webhook
        return response()->json(['message' => 'Stripe webhook received']);
    }
}
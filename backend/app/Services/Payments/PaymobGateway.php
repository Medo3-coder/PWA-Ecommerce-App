<?php
namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class PaymobGateway implements PaymentGatewayInterface
{
    public function chagre(array $data)
    {
        // Paymob charge logic
        return ['status' => 'success', 'gateway' => 'paymob'];
    }

    public function handleWebhook(array $payload)
    {
        // Handle Paymob webhook
        return response()->json(['message' => 'Paymob webhook received']);
    }
}

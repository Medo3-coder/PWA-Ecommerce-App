<?php
namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class PaymentService
{
    protected $gataway;

    public function __construct(PaymentGatewayInterface $gataway)
    {
        $this->gataway = $gataway;
    }

    public function charge(array $data)
    {
        return $this->gataway->chagre($data);
    }

    public function webhook(array $payload)
    {
        return $this->gataway->handleWebhook($payload);
    }
}

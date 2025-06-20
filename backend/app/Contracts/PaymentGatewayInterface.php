<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function chagre(array $data);
    public function handleWebhook(array $payload);
}
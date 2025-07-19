<?php
namespace App\Services\Payments;

interface PaymentGatewayInterface
{
    public function charge(array $data): PaymentResult;
}

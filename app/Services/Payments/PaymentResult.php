<?php
namespace App\Services\Payments;

class PaymentResult
{
    public function __construct(
        public bool $success,
        public ?string $transactionId = null,
        public ?string $message = null,
    ) {}
}

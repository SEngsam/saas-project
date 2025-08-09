<?php
namespace App\Services\Payments;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Str;

class FakePaymentService implements PaymentGatewayInterface
{
    public function charge(array $data): PaymentResult
    {
        return new PaymentResult(
            success: true,
            transactionId: 'FAKE-' . Str::upper(Str::random(10)),
            message: 'تم الدفع بنجاح - وهمي'
        );
    }
}

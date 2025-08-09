<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Payments\FakePaymentService;
use App\Models\Plan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $plan = Plan::findOrFail($request->plan_id);

        $paymentService = new FakePaymentService();
        $result = $paymentService->charge([
            'user' => $user,
            'amount' => $plan->price,
            'description' => 'اشتراك في خطة ' . $plan->name,
        ]);

        if (! $result->success) {
            return redirect()->back()->withErrors(['الدفع فشل: ' . $result->message]);
        }

        // إلغاء الاشتراكات السابقة
        $user->subscriptions()->update(['status' => 'cancelled']);

        $subscription = $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addDays($plan->duration_days),
            'payment_method' => 'fake',
            'payment_status' => 'paid',
        ]);

        $subscription->payments()->create([
            'user_id' => $user->id,
            'amount' => $plan->price,
            'payment_method' => 'fake',
            'payment_date' => now(),
            'status' => 'completed',
            'transaction_id' => $result->transactionId,
            'notes' => $result->message,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'تم الاشتراك بنجاح');
    }
}

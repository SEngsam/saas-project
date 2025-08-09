<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Subscription;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SubscriptionSuccess;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function confirm(Subscription $subscription, InvoiceService $invoiceService)
    {

        if ($subscription->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($subscription, $invoiceService) {

                $subscription->update([
                    'is_active' => true,
                    'status' => 'active',
                ]);
                $invoiceService->generateForSubscription($subscription);
                $subscription->user->notify(new SubscriptionSuccess($subscription->plan->name));
            });

            return redirect()->route('dashboard')->with('success', 'Subscription completed successfully!');
        } catch (\Exception $e) {

            Log::error('Subscription confirmation failed: ' . $e->getMessage());

            return redirect()->route('dashboard')->with('error', 'Failed to complete subscription. Please try again.');
        }
    }
}

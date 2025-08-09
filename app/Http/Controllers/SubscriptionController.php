<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index()
    {
        return Inertia::render('Subscription/Index', [
            'subscription' => $this->subscriptionService->getUserSubscription(),
            'history' => $this->subscriptionService->getUserHistory(),
        ]);
    }

    public function confirmPayment($subscriptionId)
    {
        $this->subscriptionService->cancelSubscription($subscriptionId);
        return redirect()->route('dashboard')->with('success', 'Subscription confirmed!');
    }

    public function cancel($id)
    {
        $this->subscriptionService->cancelSubscription($id);
        return redirect()->back()->with('success', 'Subscription cancelled.');
    }
}

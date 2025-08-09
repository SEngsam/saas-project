<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }
    public function index()
    {
        $plans = $this->subscriptionService->getAllPlans();

        return Inertia::render('Plans/Index', [
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function subscribe(Request $request, $planId)
    {
        $user = Auth::user();

        try {
            $subscription = $this->subscriptionService->subscribeUserToPlan($user, $planId);
            return Inertia::render('Payment/FakeCheckout', [
                'plan' => $subscription->plan,
                'subscription_id' => $subscription->id,
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

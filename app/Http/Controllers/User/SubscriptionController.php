<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePlanRequest;
use App\Services\Subscription\SubscriptionService;
use App\Repositories\PlanRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
            'payment_method' => 'required|string',
        ]);

        try {
            $subscription = $this->subscriptionService->subscribeUserToPlan(
                Auth::user()->id,
                $request->plan_id,
                ['method' => $request->payment_method]
            );

            return redirect()->route('user.dashboard')->with('success', 'Subscription created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function showCheckout()
    {
        $plans = app(PlanRepository::class)->all();

        return Inertia::render('Checkout', [
            'plans' => $plans,
        ]);
    }

    public function changePlanView(PlanRepository $planRepo)
    {

        return Inertia::render('User/ChangePlan', [
            'plans' => $planRepo->all(), // Array of available plans
            'current_plan_id' => Auth::user()->subscription?->plan_id,
        ]);
    }

    public function changePlan(ChangePlanRequest $request, SubscriptionService $service)
    {
        $service->changeUserPlan(Auth::user(), $request->plan_id);
        return redirect()->route('user.dashboard')->with('success', 'Plan updated successfully.');
    }
}

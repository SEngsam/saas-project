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

    public function changePlanView(PlanRepository $planRepo)
    {
        return Inertia::render('User/ChangePlan', [
            'plans' => $planRepo->all(),
            'current_plan_id' => Auth::user()->subscription?->plan_id,
        ]);
    }

    public function confirmPlanChange(Request $request, PlanRepository $repo)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
        ]);

        $newPlan = $repo->find($request->plan_id);
        $currentPlan = Auth::user()->subscription?->plan;

        return Inertia::render('User/ConfirmPlanChange', [
            'new_plan' => $newPlan,
            'current_plan' => $currentPlan,
        ]);
    }

    public function showCheckout(Request $request, PlanRepository $repo)
    {
        $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
        ]);

        return Inertia::render('User/FakeCheckout', [
            'plan' => $repo->find($request->plan_id),
        ]);
    }

    public function checkout(Request $request)
    {

        $request->validate([
            'plan_id' => 'required|integer|exists:plans,id',
            'payment_method' => 'nullable|string',
        ]);

        try {


            $this->subscriptionService->subscribeUserToPlan(
                Auth::id(),
                $request->plan_id,
                ['method' => $request->payment_method ?? 'fake']
            );

            return redirect()->route('user.dashboard')->with('success', 'Subscription completed!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}

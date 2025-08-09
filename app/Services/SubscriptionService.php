<?php

namespace App\Services;

use App\Models\Subscription;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Repositories\Eloquent\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    protected $planRepo ,$subscriptionRepo;

    public function __construct(PlanRepositoryInterface $planRepo,SubscriptionRepository $subscriptionRepo)
    {
        $this->planRepo = $planRepo;
        $this->subscriptionRepo = $subscriptionRepo;
    }
    public function getAllPlans()
    {
        return $this->planRepo->all();
    }

    public function subscribeUserToPlan($user, $planId)
    {
        $plan = $this->planRepo->find($planId);
        if (!$plan) {
            throw new \Exception("Plan not exist");
        }

        // Optionally, cancel previous subscriptions
        $this->cancelActiveSubscriptions($user->id);

        return DB::transaction(function () use ($user, $plan) {
            return Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'starts_at' => now(),
                'ends_at' => $this->calculateEndDate($plan->interval),
                'is_active' => false,
                'status' => 'pending',
            ]);
        });
    }

    public function cancelActiveSubscriptions($userId)
    {
        Subscription::where('user_id', $userId)
            ->where('ends_at', '>', now())
            ->update(['ends_at' => now()]);
    }

    protected function calculateEndDate(string $interval)
    {

        return match ($interval) {
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            default => now()->addMonth(), // fallback
        };
    }

      public function getUserSubscription()
    {
        return $this->subscriptionRepo->getActiveByUser(Auth::id());
    }

    public function getUserHistory()
    {
        return $this->subscriptionRepo->getHistoryByUser(Auth::id());
    }

    public function subscribe($plan)
    {
        return $this->subscriptionRepo->create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'is_active' => true
        ]);
    }

    public function cancelSubscription($subscriptionId)
    {
        return $this->subscriptionRepo->cancel($subscriptionId);
    }
}

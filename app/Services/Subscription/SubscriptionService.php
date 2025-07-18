<?php

namespace App\Services\Subscription;


use App\Repositories\UserRepository;
use App\Repositories\PlanRepository;
use App\Models\Subscription;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    protected UserRepository $userRepo;
    protected PlanRepository $planRepo;

    public function __construct(UserRepository $userRepo, PlanRepository $planRepo)
    {
        $this->userRepo = $userRepo;
        $this->planRepo = $planRepo;
    }

    public function subscribeUserToPlan(int $userId, int $planId, array $paymentData): Subscription
    {
        try {
            $user = $this->userRepo->find($userId);
            $plan = $this->planRepo->find($planId);

            Log::info("🔔 Simulated payment for user {$user->id} using method: " . ($options['method'] ?? 'unknown'));

            if (!$user) {
                throw new Exception("User not found");
            }
            if (!$plan) {
                throw new Exception("Plan not found");
            }


            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'payment_method' => $paymentData['method'] ?? 'manual',
                'payment_status' => 'completed',
            ]);


            return $subscription;
        } catch (\Exception $e) {
            dd('ERROR:', $e->getMessage());
        }
    }
    public function changeUserPlan(User $user, int $planId): void
    {
        $plan = $this->planRepo->find($planId);

        $user->subscription()->update([
            'plan_id' => $plan->id,
            'status' => 'active',
            'updated_at' => now(),
        ]);
    }
}

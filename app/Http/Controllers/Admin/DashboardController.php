<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $activeUsersCount = User::whereNotNull('email_verified_at')->count();

        $activeSubscriptionsCount = Subscription::where('status', 'active')->count();

        $plansCount = Plan::count();

        $mrr = $this->calculateMRR();

        // $stats = [
        //     'activeUsers' => $activeUsersCount,
        //     'activeSubscriptions' => $activeSubscriptionsCount,
        //     'plans' => $plansCount,
        //     'mrr' => $mrr,
        // ];

        $stats = [
            'activeUsers' => 10,
            'activeSubscriptions' => 5,
            'plans' => 2,
            'mrr' => 150.25,
        ];
        return Inertia::render('Admin/Dashboard', [
            'stats' =>  $stats
        ]);
    }

    private function calculateMRR()
    {
        $subscriptions = Subscription::where('status', 'active')->with('plan')->get();

        $mrr = 0;

        foreach ($subscriptions as $subscription) {
            $planPrice = $subscription->plan->price;
            $billingInterval = $subscription->plan->billing_interval ?? 'monthly';

            if ($billingInterval === 'monthly') {
                $mrr += $planPrice;
            } elseif ($billingInterval === 'yearly') {
                $mrr += $planPrice / 12;
            }
        }

        return round($mrr, 2);
    }
}

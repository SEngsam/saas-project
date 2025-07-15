<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;

class SubscriptionsSeeder extends Seeder
{
    public function run()
    {


        $user = User::first();
        $plan = Plan::first();

        if ($user && $plan) {
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => now()->addDays($plan->duration_days),
                'payment_method' => 'admin',
                'payment_status' => 'pending',
            ]);
        }
    }
}

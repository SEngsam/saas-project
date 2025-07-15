<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansSeeder extends Seeder
{
    public function run()
    {


        Plan::create([
            'name' => 'Basic Plan',
            'price' => 10.00,
            'duration_days' => 30,
            'description' => 'Basic monthly subscription',
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'status' => 'active',
            'assignee' => 'System',
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'price' => 30.00,
            'duration_days' => 90,
            'description' => 'Premium quarterly subscription',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'status' => 'active',
            'assignee' => 'System',
        ]);


    }
}

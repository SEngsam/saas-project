<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    Plan::insert([
        [
            'name' => 'Basic',
            'slug' => 'basic',
            'price' => 0,
            'features' => json_encode(['1 User', '5 Projects']),
        ],
        [
            'name' => 'Pro',
            'slug' => 'pro',
            'price' => 19.99,
            'features' => json_encode(['5 Users', '50 Projects']),
        ],
        [
            'name' => 'Enterprise',
            'slug' => 'enterprise',
            'price' => 99.99,
            'features' => json_encode(['Unlimited Users', 'Unlimited Projects']),
        ],
    ]);
}
}

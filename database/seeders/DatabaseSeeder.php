<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory(10)->create();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('123456')
        ]);

        $user->assignRole($adminRole);

        $this->call([PlanSeeder::class]);
    }
}

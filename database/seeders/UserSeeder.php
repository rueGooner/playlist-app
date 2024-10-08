<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'ruebencee@gmail.com',
            'password' => Hash::make('i6a8uejKJc!'),
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);

        User::factory()->count(9)->create([
            'role' => 'client',
        ]);
    }
}

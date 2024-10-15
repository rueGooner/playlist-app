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

    $clientCount = rand(50, 150);
    $djCount = 15;

    User::factory()->count($clientCount)->create([
      'role' => 'client',
    ]);

    User::factory()->count($djCount)->create([
      'role' => 'dj',
    ]);
  }
}

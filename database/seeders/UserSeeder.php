<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 1. Admin User
    User::create([
      'name' => 'Admin User',
      'first_name' => 'Rueben',
      'last_name' => 'Cumberbatch',
      'email' => 'ruebencee@gmail.com',
      'password' => Hash::make('i6a8uejKJc!'),
      'email_verified_at' => now(),
      'role' => 'admin'
    ]);

    User::create([
      'name' => 'Test DJ',
      'first_name' => 'Test',
      'last_name' => 'DJ',
      'email' => 'test-dj@gmail.com',
      'password' => Hash::make('i6a8uejKJc!'),
      'email_verified_at' => now(),
      'role' => 'dj'
    ]);

    User::create([
      'name' => 'Client User',
      'first_name' => 'Client',
      'last_name' => 'Tester',
      'email' => 'test-client@gmail.com',
      'password' => Hash::make('i6a8uejKJc!'),
      'email_verified_at' => now(),
      'role' => 'client'
    ]);

    $clientCount = rand(50, 100);
    $djCount = 10;

    User::factory()->count($clientCount)->create([
      'role' => 'client',
    ]);

    User::factory()->count($djCount)->dj()->create();
  }
}

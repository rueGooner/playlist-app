<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class EventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();

    $users = User::where('role', 'client')->get();
      foreach ($users as $user) {
        $eventCount = rand(1, 2);

        for ($index = 0; $index < $eventCount; $index++) {
          $eventDate  = $faker->dateTimeThisYear();
          $startTime  = $faker->dateTimeBetween('10:00:00', '21:00:00');
          $endTime    = $faker->dateTimeBetween($startTime, '23:59:00');

          DB::table('events')->insert([
            'user_id' => $user->id,
            'title' => $faker->sentence(4),
            'event_date' => $eventDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'address' => $faker->address,
            'created_at' => now(),
            'updated_at' => now()
          ]);
        }
      }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get user IDs for students (where role_id is 3)
        $studentUserIds = DB::table('users')->where('role_id', 3)->pluck('id');

        foreach ($studentUserIds as $userId) {
            DB::table('payments')->insert([
                'user_id' => $userId,
                'amount' => 5000,
                'date' => $faker->date,
                'status' => $faker->randomElement(['pending', 'completed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

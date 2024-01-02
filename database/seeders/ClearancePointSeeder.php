<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClearancePointSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clearance_points')->insert([
            [
                'user_id' => 71,
                'unit_id' => 1,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 2,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 3,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 4,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 5,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 6,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 71,
                'unit_id' => 7,
                'date_cleared' => null,
                'cleared_by' => null,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

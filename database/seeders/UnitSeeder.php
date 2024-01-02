<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Get all admins (users with role_id = 2)
        $admins = User::where('role_id', 2)->get();

        // Define unit names
        $unitNames = ['Department', 'Library', 'ICT Center', 'Guidance and Counselling', 'Student Affairs', 'Bursary', 'Records unit'];

        // Iterate through unit names and assign a random admin to each unit
        foreach ($unitNames as $unitName) {
            // Get a random admin and associate them with the unit
            $admin = $admins->random();
            
            // Create the unit
            Unit::create([
                'name' => $unitName,
                'clearance_officer' => $admin->id,
            ]);
        }
    }
}

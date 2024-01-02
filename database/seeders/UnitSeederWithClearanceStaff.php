<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeederWithClearanceStaff extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Get user IDs for staff (where role_id is 2)
        $staffUserIds = DB::table('users')->where('role_id', 2)->pluck('id');

        // Update the existing units with clearance_staff data
        DB::table('units')
            ->where('name', 'Department')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'Library')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'ICT Center')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'Guidance and Counselling')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'Student Affairs')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'Bursary')
            ->update(['clearance_staff' => $staffUserIds->random()]);

        DB::table('units')
            ->where('name', 'Records unit')
            ->update(['clearance_staff' => $staffUserIds->random()]);
    }
}

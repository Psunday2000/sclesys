<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programmes')->insert([
            'name' => 'National Diploma',
            'slug' => 'ND',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('programmes')->insert([
            'name' => 'Higher National Diploma',
            'slug' => 'HND',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

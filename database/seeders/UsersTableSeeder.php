<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_NG'); // Set the locale to en_NG

        // Super Admin
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('supAdmin22##'),
            'role_id' => 1, // Super Admin role
            'department_id' => 27,
        ]);

        // Admins (7 units)
        for ($i = 1; $i <= 7; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => "admin{$i}@outlook.com",
                'password' => Hash::make('passadmin22'),
                'role_id' => 2, // Admin role
                'department_id' => 27,
            ]);
        }

        // Staff (26 departments)
        for ($i = 1; $i <= 26; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => "staff{$i}@outlook.com",
                'password' => Hash::make('passstaff22'),
                'role_id' => 3, // Staff role
                'department_id' => $i,
            ]);
        }

        // Students (26 departments)
        for ($i = 1; $i <= 26; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => "student{$i}@gmail.com",
                'password' => Hash::make('password'),
                'role_id' => 4, // Student role
                'department_id' => $i,
            ]);
        }
    }
}

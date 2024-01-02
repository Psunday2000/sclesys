<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ClearanceDataSeeder extends Seeder
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

        // Sample data for each student using Faker
        foreach ($studentUserIds as $userId) {
            // Fetch the department for the student
            $department = DB::table('users')->where('id', $userId)->value('department_id');
            $departmentSlug = DB::table('departments')->where('id', $department)->value('slug');

            // Fetch the student's name based on user_id
            $studentName = DB::table('users')->where('id', $userId)->value('name');

            // Check if the entry already exists
            $existingData = DB::table('clearance_data')->where('user_id', $userId)->first();

            if (!$existingData) {
                $data = [
                    'user_id' => $userId,
                    'registration_number' => $faker->unique()->regexify("20[2-3][0-9]/(ND|HND)/[0-9]{5}/$departmentSlug"),
                    'name_of_student' => $studentName,
                    'programme' => $faker->randomElement(['ND', 'HND']),
                    'library_card_image' => $this->uploadImage($faker),
                    'id_card_image' => $this->uploadImage($faker),
                    'convocation_fee_rrr' => $faker->regexify('[0-9]{4}-[0-9]{4}-[0-9]{4}'),
                    'first_year_school_fees_image' => $this->uploadImage($faker),
                    'second_year_school_fees_image' => $this->uploadImage($faker),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('clearance_data')->insert($data);
            }
        }
    }

    /**
     * Upload an image and return the path.
     *
     * @param  \Faker\Generator  $faker
     * @return string
     */
    private function uploadImage($faker)
    {
        $imagePath = 'upload/image/' . uniqid() . '.jpg'; // Adjust the file extension if needed
        $imageContent = file_get_contents($faker->imageUrl()); // Generate a random image URL with Faker
        Storage::put($imagePath, $imageContent);

        return $imagePath;
    }
}

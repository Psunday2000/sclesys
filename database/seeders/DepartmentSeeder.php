<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $departments = [
            'ACCOUNTANCY' => 'ACC',
            'AGRICULTURAL TECHNOLOGY' => 'AGT',
            'ARCHITECTURAL TECHNOLOGY' => 'ARC',
            'BUILDING TECHNOLOGY' => 'BUT',
            'BUSINESS ADMINISTRATION & MANAGEMENT' => 'BAM',
            'CERAMICS TECHNOLOGY' => 'CER',
            'CIVIL ENGINEERING TECHNOLOGY' => 'CET',
            'COMPUTER ENGINEERING' => 'CEN',
            'COMPUTER SCIENCE' => 'CSC',
            'ELECTRICAL/ELECTRONIC ENGINEERING TECHNOLOGY' => 'EET',
            'ESTATE MANAGEMENT AND VALUATION' => 'EMV',
            'FOOD TECHNOLOGY' => 'FOT',
            'GLASS/CERAMICS TECHNOLOGY' => 'GCT',
            'HORTICULTURE AND LANDSCAPE TECHNOLOGY' => 'HLT',
            'HOSPITALITY MANAGEMENT' => 'HMT',
            'LIBRARY AND INFORMATION SCIENCE' => 'LIS',
            'MARKETING' => 'MKT',
            'MECHANICAL ENGINEERING TECHNOLOGY' => 'MET',
            'MECHATRONICS ENGINEERING TECHNOLOGY' => 'MCT',
            'OFFICE TECHNOLOGY AND MANAGEMENT' => 'OTM',
            'PUBLIC ADMINISTRATION' => 'PAD',
            'QUANTITY SURVEYING' => 'QSV',
            'SCIENCE LABORATORY TECHNOLOGY' => 'SLT',
            'STATISTICS' => 'STA',
            'SURVEYING AND GEO-INFORMATICS' => 'SGI',
            'URBAN AND REGIONAL PLANNING' => 'URP',
        ];

        foreach ($departments as $name => $abbreviation) {
            DB::table('departments')->insert([
                'name' => $name,
                'slug' => $abbreviation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "Inserted department: {$name} ({$abbreviation})" . PHP_EOL;
        }
    }
}

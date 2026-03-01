<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Truncate before seeding to avoid duplicates without refresh
        DB::table('branches')->truncate();

        $divisions = [
            'Dhaka' => [
                ['name' => 'RMS Dhanmondi Branch', 'area' => 'Dhanmondi', 'address' => 'House #27, Road #16, Dhanmondi'],
                ['name' => 'RMS Uttara Branch', 'area' => 'Uttara', 'address' => 'Uttara Sector 7, Dhaka'],
                ['name' => 'RMS Mirpur Branch', 'area' => 'Mirpur', 'address' => 'Mirpur 10, Dhaka'],
                ['name' => 'RMS Gulshan Branch', 'area' => 'Gulshan', 'address' => 'Gulshan 1, Dhaka'],
                ['name' => 'RMS Banani Branch', 'area' => 'Banani', 'address' => 'Plot #11, Road #11, Banani'],
                ['name' => 'RMS Kaliganj Branch', 'area' => 'Kaliganj', 'address' => 'Kaliganj Main Road, Gazipur'],
            ],
            'Chattogram' => [
                ['name' => 'RMS Agrabad Branch', 'area' => 'Agrabad', 'address' => 'Agrabad C/A, Chattogram'],
                ['name' => 'RMS GEC Branch', 'area' => 'GEC', 'address' => 'GEC Circle, Chattogram'],
                ['name' => 'RMS Cox’s Bazar Branch', 'area' => 'Cox’s Bazar', 'address' => 'Laboni Point Road, Cox’s Bazar'],
            ],
            'Sylhet' => [
                ['name' => 'RMS Zindabazar Branch', 'area' => 'Zindabazar', 'address' => 'Zindabazar, Sylhet'],
                ['name' => 'RMS Court Road Branch', 'area' => 'Court Road', 'address' => 'Court Road, Moulvibazar'],
            ],
            'Rajshahi' => [
                ['name' => 'RMS Shaheb Bazar Branch', 'area' => 'Shaheb Bazar', 'address' => 'Shaheb Bazar, Rajshahi'],
                ['name' => 'RMS Satmatha Branch', 'area' => 'Satmatha', 'address' => 'Satmatha, Bogura'],
            ],
            'Khulna' => [
                ['name' => 'RMS KDA Avenue Branch', 'area' => 'KDA Avenue', 'address' => 'KDA Avenue, Khulna'],
                ['name' => 'RMS Monihar Branch', 'area' => 'Monihar', 'address' => 'Monihar, Jessore'],
            ]
        ];

        $branches = [];
        $i = 1;
        foreach ($divisions as $city => $data) {
            foreach ($data as $item) {
                $branches[] = [
                    'name' => $item['name'],
                    'city' => $city,
                    'area' => $item['area'],
                    'address' => $item['address'],
                    'phone' => '017' . str_pad($i, 8, '0', STR_PAD_LEFT),
                    'opening_time' => '10:00:00',
                    'closing_time' => '22:00:00',
                    'map_link' => 'https://goo.gl/maps/example' . $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $i++;
            }
        }

        DB::table('branches')->insert($branches);
    }
}

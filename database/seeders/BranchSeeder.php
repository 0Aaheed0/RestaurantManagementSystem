<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('branches')->insert([
        [
            'name' => 'RMS Kaliganj Branch',
            'location' => 'Kaliganj Main Road',
            'phone' => '01700000000',
        ],
        [
            'name' => 'RMS Dhaka Branch',
            'location' => 'Dhanmondi',
            'phone' => '01800000000',
        ]
    ]);
}
}

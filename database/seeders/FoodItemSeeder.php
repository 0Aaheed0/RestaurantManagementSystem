<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('food_items')->insert([
        [
            'name' => 'Chicken Burger',
            'description' => 'Crispy chicken with cheese',
            'price' => 250.00,
            'is_available' => true,
        ],
        [
            'name' => 'Beef Pizza',
            'description' => 'Cheesy beef pizza',
            'price' => 450.00,
            'is_available' => true,
        ]
    ]);
}
}

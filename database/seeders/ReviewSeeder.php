<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Optional: Clear table before seeding
        DB::table('reviews')->truncate();

        DB::table('reviews')->insert([
            [
                'food_item_id' => 1,
                'user_id' => 1,
                'rating' => 5,
                'review' => 'Amazing burger, very juicy!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'food_item_id' => 1,
                'user_id' => 2,
                'rating' => 4,
                'review' => 'Really good, but a bit salty.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'food_item_id' => 2,
                'user_id' => 1,
                'rating' => 5,
                'review' => 'Pizza was perfect, thin crust and tasty.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'food_item_id' => 3,
                'user_id' => 3,
                'rating' => 3,
                'review' => 'Pasta was okay, could be better.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'food_item_id' => 4,
                'user_id' => 2,
                'rating' => 5,
                'review' => 'Fried chicken was crispy and delicious!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add as many as you want manually
        ]);
    }
}
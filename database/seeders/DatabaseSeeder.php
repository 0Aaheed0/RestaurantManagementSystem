<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create 10 users so the ReviewSeeder has something to point to
        \App\Models\User::factory(10)->create();

        $this->call([
            FoodItemSeeder::class,
            BranchSeeder::class,
            FaqSeeder::class,
            VoucherSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}

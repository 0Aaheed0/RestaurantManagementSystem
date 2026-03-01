<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('food_items')->truncate();

        DB::table('food_items')->insert([
            [
                'name' => 'Classic Chicken Burger',
                'description' => 'Crispy golden chicken patty with melted cheddar cheese, fresh lettuce, and our secret sauce.',
                'price' => 250.00,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&auto=format&fit=crop&q=60',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pepperoni Feast Pizza',
                'description' => 'Loaded with premium pepperoni, mozzarella cheese, and signature tomato sauce on a hand-tossed crust.',
                'price' => 850.00,
                'image' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=500&auto=format&fit=crop&q=60',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Royal Mutton Kacchi',
                'description' => 'Traditional Bashmati rice cooked with tender mutton chunks and aromatic spices, served with borhani.',
                'price' => 450.00,
                'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=500&auto=format&fit=crop&q=60',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grilled Salmon Steak',
                'description' => 'Perfectly seared Atlantic salmon served with roasted vegetables and lemon butter sauce.',
                'price' => 1250.00,
                'image' => 'https://images.unsplash.com/photo-1485921325833-c519f76c4927?w=500&auto=format&fit=crop&q=60',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasta Carbonara',
                'description' => 'Creamy spaghetti with crispy turkey bacon, parmesan cheese, and freshly cracked black pepper.',
                'price' => 380.00,
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=500&auto=format&fit=crop&q=60',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

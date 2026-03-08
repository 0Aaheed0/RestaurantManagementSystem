<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodItemSeeder extends Seeder
{
    public function run()
    {
        // Remove truncate() to keep old foods

        DB::table('food_items')->insert([

            // ====== PIZZA ======
            ['name'=>'Margherita Pizza','category'=>'Pizza','description'=>'Classic pizza with mozzarella cheese and tomato sauce.','price'=>800.00,'image'=>'https://images.unsplash.com/photo-1603073798031-d4c7c89c6f8c?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BBQ Chicken Pizza','category'=>'Pizza','description'=>'Grilled chicken with smoky BBQ sauce and cheese.','price'=>900.00,'image'=>'https://images.unsplash.com/photo-1627981321581-c64c0b0b2de8?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Veggie Supreme Pizza','category'=>'Pizza','description'=>'Loaded with fresh vegetables and mozzarella cheese.','price'=>750.00,'image'=>'https://images.unsplash.com/photo-1603073781255-7f627e164c71?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Meat Lovers Pizza','category'=>'Pizza','description'=>'Pepperoni, sausage, and beef with melted cheese.','price'=>950.00,'image'=>'https://images.unsplash.com/photo-1603073781234-5a1d8d6b2a9c?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mushroom Delight Pizza','category'=>'Pizza','description'=>'Fresh mushrooms with creamy garlic sauce and cheese.','price'=>780.00,'image'=>'https://images.unsplash.com/photo-1603073781250-94f5b11b9f6d?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== BURGER ======
            ['name'=>'Cheese Burger','category'=>'Burger','description'=>'Juicy beef patty with cheddar cheese and lettuce.','price'=>300.00,'image'=>'https://images.unsplash.com/photo-1550547660-d9450f859349?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Double Beef Burger','category'=>'Burger','description'=>'Two beef patties with cheese and special sauce.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1617196039737-2e66f380e5a5?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Spicy Chicken Burger','category'=>'Burger','description'=>'Crispy chicken fillet with spicy sauce.','price'=>270.00,'image'=>'https://images.unsplash.com/photo-1617196039738-3c6f5c6b6c7e?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Veggie Burger','category'=>'Burger','description'=>'Healthy vegetable patty with fresh veggies.','price'=>220.00,'image'=>'https://images.unsplash.com/photo-1617196039739-4d7f5c7b7d8f?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BBQ Beef Burger','category'=>'Burger','description'=>'Beef patty with BBQ sauce and caramelized onions.','price'=>320.00,'image'=>'https://images.unsplash.com/photo-1617196039740-5e8f5d8c8f9a?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== KACCHI/RICE ======
            ['name'=>'Chicken Kacchi','category'=>'Kacchi/Rice','description'=>'Tender chicken with aromatic rice and spices.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1617196039741-6f9f6e9d9f0b?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Beef Tehari','category'=>'Kacchi/Rice','description'=>'Spicy beef rice with flavorful herbs.','price'=>350.00,'image'=>'https://images.unsplash.com/photo-1617196039742-7f0f7f0f7f1c?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Chicken Biryani','category'=>'Kacchi/Rice','description'=>'Fragrant basmati rice with spiced chicken.','price'=>300.00,'image'=>'https://images.unsplash.com/photo-1617196039743-8f1f8f1f8f2d?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Beef Biryani','category'=>'Kacchi/Rice','description'=>'Tender beef chunks with aromatic rice.','price'=>400.00,'image'=>'https://images.unsplash.com/photo-1617196039744-9f2f9f2f9f3e?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mutton Kacchi','category'=>'Kacchi/Rice','description'=>'Traditional mutton kacchi with flavorful spices.','price'=>450.00,'image'=>'https://images.unsplash.com/photo-1617196039745-af3faf3faf4f?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== SPECIAL ======
            ['name'=>'Grilled Salmon Steak','category'=>'Special','description'=>'Perfectly seared salmon with roasted veggies and lemon butter sauce.','price'=>1250.00,'image'=>'https://images.unsplash.com/photo-1485921325833-c519f76c4927?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Pasta Carbonara','category'=>'Special','description'=>'Creamy spaghetti with crispy turkey bacon and parmesan.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Steak with Mushroom Sauce','category'=>'Special','description'=>'Juicy beef steak with mushroom sauce.','price'=>1400.00,'image'=>'https://images.unsplash.com/photo-1562967916-eb82221dfb6b?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Seafood Platter','category'=>'Special','description'=>'Grilled prawns, fish, and calamari with herbs.','price'=>1800.00,'image'=>'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Stuffed Chicken Breast','category'=>'Special','description'=>'Chicken breast stuffed with cheese and spinach.','price'=>600.00,'image'=>'https://images.unsplash.com/photo-1601050690917-7c6237d0b62c?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== BEVERAGE ======
            ['name'=>'Coca Cola','category'=>'Beverage','description'=>'Chilled classic Coke.','price'=>50.00,'image'=>'https://images.unsplash.com/photo-1598511725549-1b55b23f69e0?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Pepsi','category'=>'Beverage','description'=>'Refreshing Pepsi drink.','price'=>50.00,'image'=>'https://images.unsplash.com/photo-1598511725548-0b44b23f68d0?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Orange Juice','category'=>'Beverage','description'=>'Freshly squeezed orange juice.','price'=>80.00,'image'=>'https://images.unsplash.com/photo-1560807707-8cc77767d783?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Lemonade','category'=>'Beverage','description'=>'Fresh lemonade with ice cubes.','price'=>60.00,'image'=>'https://images.unsplash.com/photo-1560807707-8cc77767d784?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mango Smoothie','category'=>'Beverage','description'=>'Creamy mango smoothie.','price'=>120.00,'image'=>'https://images.unsplash.com/photo-1580800935554-bc0d2f0f0a0d?w=500&auto=format&fit=crop&q=60','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

        ]);
    }
}
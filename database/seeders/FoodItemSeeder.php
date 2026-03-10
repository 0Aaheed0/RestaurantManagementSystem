<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodItemSeeder extends Seeder
{
    public function run()
    {
        // Prevent duplicate data
        //DB::table('food_items')->truncate();

        DB::table('food_items')->insert([

            // ====== PIZZA ======
            ['name'=>'Margherita Pizza','category'=>'Pizza','description'=>'Classic pizza with mozzarella cheese and tomato sauce.','price'=>800.00,'image'=>'https://images.unsplash.com/photo-1600891964599-f61ba0e24092','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BBQ Chicken Pizza','category'=>'Pizza','description'=>'Grilled chicken with smoky BBQ sauce and cheese.','price'=>900.00,'image'=>'https://images.unsplash.com/photo-1548365328-9f547fb0953c','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Veggie Supreme Pizza','category'=>'Pizza','description'=>'Loaded with fresh vegetables and mozzarella cheese.','price'=>750.00,'image'=>'https://images.unsplash.com/photo-1593560708920-61dd98c46a4e','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Meat Lovers Pizza','category'=>'Pizza','description'=>'Pepperoni, sausage, and beef with melted cheese.','price'=>950.00,'image'=>'https://images.unsplash.com/photo-1513104890138-7c749659a591','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mushroom Delight Pizza','category'=>'Pizza','description'=>'Fresh mushrooms with creamy garlic sauce and cheese.','price'=>780.00,'image'=>'https://images.unsplash.com/photo-1528137871618-79d2761e3fd5','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== BURGER ======
            ['name'=>'Cheese Burger','category'=>'Burger','description'=>'Juicy beef patty with cheddar cheese and lettuce.','price'=>300.00,'image'=>'https://images.unsplash.com/photo-1606755962773-d324e0a13086','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Double Beef Burger','category'=>'Burger','description'=>'Two beef patties with cheese and special sauce.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1568901346375-23c9450c58cd','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Spicy Chicken Burger','category'=>'Burger','description'=>'Crispy chicken fillet with spicy sauce.','price'=>270.00,'image'=> 'https://images.unsplash.com/photo-1550547660-d9450f859349','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Veggie Burger','category'=>'Burger','description'=>'Healthy vegetable patty with fresh veggies.','price'=>220.00,'image'=>'https://images.unsplash.com/photo-1520072959219-c595dc870360','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'BBQ Beef Burger','category'=>'Burger','description'=>'Beef patty with BBQ sauce and caramelized onions.','price'=>320.00,'image'=>'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== KACCHI/RICE ======
            ['name'=>'Chicken Kacchi','category'=>'Kacchi/Rice','description'=>'Tender chicken with aromatic rice and spices.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1604908176997-431c6a03b1a0','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Beef Tehari','category'=>'Kacchi/Rice','description'=>'Spicy beef rice with flavorful herbs.','price'=>350.00,'image'=>'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Chicken Biryani','category'=>'Kacchi/Rice','description'=>'Fragrant basmati rice with spiced chicken.','price'=>300.00,'image'=>'https://images.unsplash.com/photo-1563379091339-03246963d96c','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Beef Biryani','category'=>'Kacchi/Rice','description'=>'Tender beef chunks with aromatic rice.','price'=>400.00,'image'=>'https://images.unsplash.com/photo-1631452180519-c014fe946bc7','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mutton Kacchi','category'=>'Kacchi/Rice','description'=>'Traditional mutton kacchi with flavorful spices.','price'=>450.00,'image'=>'https://images.unsplash.com/photo-1589302168068-964664d93dc0','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== SPECIAL ======
            ['name'=>'Grilled Salmon Steak','category'=>'Special','description'=>'Perfectly seared salmon with roasted veggies and lemon butter sauce.','price'=>1250.00,'image'=>'https://images.unsplash.com/photo-1467003909585-2f8a72700288','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Pasta Carbonara','category'=>'Special','description'=>'Creamy spaghetti with crispy turkey bacon and parmesan.','price'=>380.00,'image'=>'https://images.unsplash.com/photo-1612874742237-6526221588e3','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Steak with Mushroom Sauce','category'=>'Special','description'=>'Juicy beef steak with mushroom sauce.','price'=>1400.00,'image'=>'https://images.unsplash.com/photo-1551183053-bf91a1d81141','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Seafood Platter','category'=>'Special','description'=>'Grilled prawns, fish, and calamari with herbs.','price'=>1800.00,'image'=>'https://images.unsplash.com/photo-1559847844-5315695dadae','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Stuffed Chicken Breast','category'=>'Special','description'=>'Chicken breast stuffed with cheese and spinach.','price'=>600.00,'image'=>'https://images.unsplash.com/photo-1604908177522-4025c7b7e0a3','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],

            // ====== BEVERAGE ======
            ['name'=>'Coca Cola','category'=>'Beverage','description'=>'Chilled classic Coke.','price'=>50.00,'image'=>'https://images.unsplash.com/photo-1629203432180-71e9b3b0bde3','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Pepsi','category'=>'Beverage','description'=>'Refreshing Pepsi drink.','price'=>50.00,'image'=>'https://images.unsplash.com/photo-1581006852262-e4307cf6283a','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Orange Juice','category'=>'Beverage','description'=>'Freshly squeezed orange juice.','price'=>80.00,'image'=>'https://images.unsplash.com/photo-1600271886742-f049cd451bba','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Lemonade','category'=>'Beverage','description'=>'Fresh lemonade with ice cubes.','price'=>60.00,'image'=>'https://images.unsplash.com/photo-1556679343-c7306c1976bc','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Mango Smoothie','category'=>'Beverage','description'=>'Creamy mango smoothie.','price'=>120.00,'image'=>'https://images.unsplash.com/photo-1589733955941-5eeaf752f6dd','is_available'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
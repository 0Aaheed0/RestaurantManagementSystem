<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    /**
     * Display a listing of the food items grouped by category.
     */
    public function index()
    {
        // Fetch all food items (including unavailable ones)
        $items = FoodItem::all();

        // Group them by their 'category' column, with a smart fallback based on name
        $categories = $items->groupBy(function($item) {
            if ($item->category) {
                return $item->category;
            }

            $name = strtolower($item->name);
            if (Str::contains($name, 'burger')) return 'Burger';
            if (Str::contains($name, 'pizza')) return 'Pizza';
            if (Str::contains($name, 'biryani') || Str::contains($name, 'kacchi')) return 'Biryani';
            if (Str::contains($name, 'rice')) return 'Chinese';
            if (Str::contains($name, 'cake')) return 'Dessert';
            if (Str::contains($name, 'juice') || Str::contains($name, 'lemon')) return 'Drinks';
            
            return 'General';
        });

        return view('food.index', compact('categories'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\FoodItem;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'food_item_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required'
        ]);

        Review::create([
            'food_item_id' => $request->food_item_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Review submitted successfully!']);
        }

        return back()->with('success', 'Review submitted successfully!');
    }

    public function index()
    {
        $foods = FoodItem::orderBy('name')->get();
        return view('review', compact('foods'));
    }
}
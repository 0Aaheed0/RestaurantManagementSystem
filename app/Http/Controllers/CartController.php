<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\FoodItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'food_item_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = CartItem::updateOrCreate(
            ['user_id'=>auth()->id(),'food_item_id'=>$request->food_item_id],
            ['quantity'=>$request->quantity]
        );

        return back()->with('success','Added to cart!');
    }

    public function index()
    {
        $cartItems = CartItem::with('food')->where('user_id', auth()->id())->get();
        return view('cart', compact('cartItems'));
    }

    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();
        return back()->with('success','Item removed from cart!');
    }
}
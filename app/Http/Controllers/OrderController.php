<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $cartItems = CartItem::with('food')->where('user_id',$user->id)->get();

        $total = $cartItems->sum(fn($item)=> $item->food->price * $item->quantity);

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach($cartItems as $item)
        {
            OrderItem::create([
                'order_id'=>$order->id,
                'food_item_id'=>$item->food_id,
                'quantity'=>$item->quantity,
                'price'=>$item->food->price * $item->quantity
            ]);
        }

        CartItem::where('user_id',$user->id)->delete();

        return redirect()->route('orders.history')->with('success','Order placed successfully!');
    }

    public function history()
    {
        $orders = Order::with('items.food')->where('user_id', auth()->id())->orderBy('created_at','desc')->get();
        return view('orders_history', compact('orders'));
    }
}
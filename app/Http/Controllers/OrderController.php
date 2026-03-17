<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Voucher;

class OrderController extends Controller
{
    // Show checkout page with cart summary
    public function showCheckout()
    {
        $user = auth()->user();
        $cartItems = CartItem::with('food')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->food->price * $item->quantity);
        $appliedVoucher = null;
        $discountAmount = 0;
        $finalAmount = $subtotal;

        // Check if voucher is in session
        if (session('applied_voucher_id')) {
            $appliedVoucher = Voucher::find(session('applied_voucher_id'));
            if ($appliedVoucher && $this->isVoucherValid($appliedVoucher)) {
                $discountAmount = $this->calculateDiscount($subtotal, $appliedVoucher);
                $finalAmount = $subtotal - $discountAmount;
            } else {
                session()->forget('applied_voucher_id');
            }
        }

        return view('checkout', compact('cartItems', 'subtotal', 'discountAmount', 'finalAmount', 'appliedVoucher'));
    }

    // Apply voucher
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string|max:50'
        ]);

        $voucher = Voucher::where('code', strtoupper($request->voucher_code))->first();

        if (!$voucher) {
            return back()->withErrors(['voucher_code' => 'Invalid voucher code.']);
        }

        if (!$this->isVoucherValid($voucher)) {
            return back()->withErrors(['voucher_code' => 'This voucher is expired or has reached its usage limit.']);
        }

        session(['applied_voucher_id' => $voucher->id]);
        return back()->with('success', 'Voucher applied successfully!');
    }

    // Remove voucher
    public function removeVoucher()
    {
        session()->forget('applied_voucher_id');
        return back()->with('success', 'Voucher removed.');
    }

    // Process payment and create order
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:card,mobile_banking,cash',
            'delivery_address' => 'required|string|max:500',
            'delivery_city' => 'required|string|max:100',
            'delivery_postal_code' => 'required|string|max:20',
            'delivery_phone' => 'required|string|max:20'
        ], [
            'delivery_address.required' => 'Delivery address is required',
            'delivery_city.required' => 'City is required',
            'delivery_postal_code.required' => 'Postal code is required',
            'delivery_phone.required' => 'Phone number is required'
        ]);

        try {
            $user = auth()->user();
            $cartItems = CartItem::with('food')->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return back()->withErrors(['cart' => 'Your cart is empty!']);
            }

            $subtotal = $cartItems->sum(fn($item) => $item->food->price * $item->quantity);
            $voucherId = null;
            $discountAmount = 0;

            // Check and apply voucher if exists
            if (session('applied_voucher_id')) {
                $voucher = Voucher::find(session('applied_voucher_id'));
                if ($voucher && $this->isVoucherValid($voucher)) {
                    $voucherId = $voucher->id;
                    $discountAmount = $this->calculateDiscount($subtotal, $voucher);
                    $voucher->increment('uses');
                }
            }

            $finalPrice = $subtotal - $discountAmount;

            // Create order with delivery address
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $subtotal,
                'voucher_id' => $voucherId,
                'discount_amount' => $discountAmount,
                'final_price' => $finalPrice,
                'status' => $request->payment_method === 'cash' ? 'pending' : 'completed',
                'delivery_address' => $request->delivery_address,
                'delivery_city' => $request->delivery_city,
                'delivery_postal_code' => $request->delivery_postal_code,
                'delivery_phone' => $request->delivery_phone
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_item_id' => $item->food_id,
                    'quantity' => $item->quantity,
                    'price' => $item->food->price * $item->quantity
                ]);
            }

            // Clear cart and session
            CartItem::where('user_id', $user->id)->delete();
            session()->forget('applied_voucher_id');

            return view('payment_success', [
                'order' => $order,
                'paymentMethod' => $request->payment_method
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['payment' => 'Payment processing failed. Please try again.']);
        }
    }

    // Validate voucher
    private function isVoucherValid(Voucher $voucher)
    {
        return $voucher->valid_until >= now() && $voucher->uses < $voucher->max_uses;
    }

    // Calculate discount amount
    private function calculateDiscount($subtotal, Voucher $voucher)
    {
        if ($voucher->type === 'percentage') {
            return ($subtotal * $voucher->discount) / 100;
        } else {
            return min($voucher->discount, $subtotal);
        }
    }

    // View order history
    public function history()
    {
        $orders = Order::with('items.food', 'voucher')->where('user_id', auth()->id())->orderBy('created_at','desc')->get();
        return view('orders_history', compact('orders'));
    }

    // Old checkout method (deprecated - kept for compatibility)
    public function checkout()
    {
        return $this->showCheckout();
    }
}
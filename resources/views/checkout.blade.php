<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .checkout-container {
            font-family: 'Poppins', sans-serif;
            min-height: calc(100vh - 96px);
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            padding: 40px 20px;
        }

        .checkout-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .checkout-wrapper {
                grid-template-columns: 1fr;
            }
        }

        .checkout-section {
            background: rgba(255,255,255,0.15);
            padding: 40px;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .section-title {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            font-size: 28px;
        }

        .cart-items-list {
            margin-bottom: 30px;
        }

        .cart-item {
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-qty {
            font-size: 13px;
            opacity: 0.8;
        }

        .item-price {
            font-weight: 700;
            font-size: 16px;
            text-align: right;
        }

        .divider {
            height: 1px;
            background: rgba(255,255,255,0.2);
            margin: 20px 0;
        }

        .price-summary {
            color: white;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .price-row.subtotal {
            font-weight: 600;
        }

        .price-row.discount {
            color: #4ade80;
            font-weight: 600;
        }

        .price-row.total {
            font-size: 20px;
            font-weight: 700;
            border-top: 2px solid rgba(255,255,255,0.2);
            padding-top: 12px;
            margin-top: 12px;
        }

        .voucher-section {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid rgba(255,255,255,0.2);
        }

        .voucher-label {
            color: white;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .voucher-input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .voucher-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
        }

        .voucher-input::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .voucher-apply-btn {
            padding: 12px 25px;
            background: #4ade80;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .voucher-apply-btn:hover {
            background: #22c55e;
            transform: translateY(-2px);
        }

        .voucher-applied {
            background: rgba(74, 222, 128, 0.2);
            border: 1px solid rgba(74, 222, 128, 0.5);
            padding: 12px;
            border-radius: 10px;
            color: #4ade80;
            font-size: 13px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .voucher-remove-btn {
            background: transparent;
            border: none;
            color: #4ade80;
            cursor: pointer;
            font-size: 12px;
            text-decoration: underline;
            padding: 0;
        }

        .payment-btn {
            width: 100%;
            padding: 14px;
            background: white;
            color: #5f0f9c;
            border-radius: 12px;
            border: none;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            font-size: 16px;
        }

        .payment-btn:hover {
            background: #5f0f9c;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .payment-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .back-btn:hover {
            transform: translateX(-5px);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #fca5a5;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .success-message {
            background: rgba(74, 222, 128, 0.2);
            border: 1px solid rgba(74, 222, 128, 0.5);
            color: #4ade80;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .payment-methods {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid rgba(255,255,255,0.2);
        }

        .payment-method-label {
            color: white;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            color: white;
        }

        .payment-option:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.4);
        }

        .payment-option input[type="radio"] {
            margin-right: 12px;
            cursor: pointer;
            accent-color: white;
        }

        .payment-option label {
            cursor: pointer;
            flex: 1;
            font-weight: 500;
            margin: 0;
        }

        .payment-option i {
            margin-right: 8px;
            font-size: 18px;
        }
    </style>

    <div class="checkout-container">
        <a href="{{ route('cart.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back to Cart
        </a>

        <div class="checkout-wrapper">
            <!-- Order Summary -->
            <div class="checkout-section">
                <div class="section-title">
                    <i class="fa-solid fa-receipt"></i> Order Summary
                </div>

                <div class="cart-items-list">
                    @foreach($cartItems as $item)
                        <div class="cart-item">
                            <div class="item-details">
                                <div class="item-name">{{ $item->food->name }}</div>
                                <div class="item-qty">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="item-price">৳{{ number_format($item->food->price * $item->quantity, 0) }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="divider"></div>

                <div class="price-summary">
                    <div class="price-row subtotal">
                        <span>Subtotal:</span>
                        <span>৳{{ number_format($subtotal, 0) }}</span>
                    </div>
                    @if($discountAmount > 0)
                        <div class="price-row discount">
                            <span>Discount:</span>
                            <span>-৳{{ number_format($discountAmount, 0) }}</span>
                        </div>
                        <div class="price-row total">
                            <span>Total:</span>
                            <span>৳{{ number_format($finalAmount, 0) }}</span>
                        </div>
                    @else
                        <div class="price-row total">
                            <span>Total:</span>
                            <span>৳{{ number_format($subtotal, 0) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment & Voucher -->
            <div class="checkout-section">
                <div class="section-title">
                    <i class="fa-solid fa-credit-card"></i> Payment
                </div>

                @if($errors->any())
                    <div class="error-message">
                        <strong>⚠️ Please fix the following errors:</strong>
                        <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: 4px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Voucher Section -->
                <div class="voucher-section">
                    <label class="voucher-label">Apply Voucher Code (Optional)</label>
                    
                    @if($appliedVoucher)
                        <div class="voucher-applied">
                            <div>
                                <strong>{{ $appliedVoucher->code }}</strong> - 
                                @if($appliedVoucher->type === 'percentage')
                                    {{ $appliedVoucher->discount }}% Off
                                @else
                                    ৳{{ number_format($appliedVoucher->discount, 0) }} Off
                                @endif
                            </div>
                            <form method="POST" action="{{ route('checkout.remove-voucher') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="voucher-remove-btn">Remove</button>
                            </form>
                        </div>
                    @else
                        <form method="POST" action="{{ route('checkout.apply-voucher') }}" class="voucher-input-group">
                            @csrf
                            <input type="text" name="voucher_code" class="voucher-input" placeholder="Enter voucher code" />
                            <button type="submit" class="voucher-apply-btn">Apply</button>
                        </form>
                        <small style="color: rgba(255,255,255,0.6); display: block; margin-top: 8px;">
                            Available: WELCOME10, FLAT50, SPRING20
                        </small>
                    @endif
                </div>

                <!-- Payment Methods -->
                <div class="payment-methods">
                    <label class="payment-method-label">Delivery Address</label>
                    <form method="POST" action="{{ route('checkout.process') }}" id="paymentForm">
                        @csrf
                        
                        <!-- Address Section -->
                        <div style="margin-bottom: 20px; padding: 20px; background: rgba(255,255,255,0.1); border-radius: 12px;">
                            <div style="margin-bottom: 15px;">
                                <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                    <i class="fa-solid fa-location-dot"></i> Delivery Address *
                                </label>
                                <textarea name="delivery_address" class="voucher-input" placeholder="Enter your full delivery address" required style="resize: vertical; min-height: 80px; padding: 12px 15px; font-family: inherit;">{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                    <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                @enderror
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 15px;">
                                <div>
                                    <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                        <i class="fa-solid fa-city"></i> City *
                                    </label>
                                    <input type="text" name="delivery_city" class="voucher-input" placeholder="e.g., Dhaka" required value="{{ old('delivery_city') }}" />
                                    @error('delivery_city')
                                        <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                        <i class="fa-solid fa-hashtag"></i> Postal Code *
                                    </label>
                                    <input type="text" name="delivery_postal_code" class="voucher-input" placeholder="e.g., 1205" required value="{{ old('delivery_postal_code') }}" />
                                    @error('delivery_postal_code')
                                        <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                    <i class="fa-solid fa-phone"></i> Delivery Phone Number *
                                </label>
                                <input type="tel" name="delivery_phone" class="voucher-input" placeholder="e.g., 01700000000" required value="{{ old('delivery_phone') }}" />
                                @error('delivery_phone')
                                    <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <label class="payment-method-label" style="margin-top: 0;">Payment Method</label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="card" checked required />
                                <i class="fa-solid fa-credit-card"></i>
                                <span>Credit/Debit Card</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="mobile_banking" />
                                <i class="fa-solid fa-mobile"></i>
                                <span>Mobile Banking (bKash/Nagad)</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="cash" />
                                <i class="fa-solid fa-wallet"></i>
                                <span>Cash on Delivery</span>
                            </label>
                        </div>

                        <button type="submit" class="payment-btn">
                            <i class="fa-solid fa-lock"></i> Complete Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

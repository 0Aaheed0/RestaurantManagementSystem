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
                            <select name="voucher_code" class="voucher-input" style="appearance: auto; cursor: pointer; background: rgba(95, 15, 156, 0.4); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                <option value="" disabled selected>Select voucher code</option>
                                <option value="WELCOME10" style="background: #5f0f9c;">WELCOME10 (10% Off)</option>
                                <option value="FLAT50" style="background: #5f0f9c;">FLAT50 (৳50 Off)</option>
                                <option value="SPRING20" style="background: #5f0f9c;">SPRING20 (20% Off)</option>
                            </select>
                            <button type="submit" class="voucher-apply-btn">Apply</button>
                        </form>
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
                                <textarea name="delivery_address" class="voucher-input" placeholder="Enter your full delivery address" required style="resize: vertical; min-height: 80px; padding: 12px 15px; font-family: inherit; background: rgba(95, 15, 156, 0.2);">{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                    <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                @enderror
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 15px;">
                                <div>
                                    <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                        <i class="fa-solid fa-city"></i> City *
                                    </label>
                                    <select name="delivery_city" id="delivery_city" class="voucher-input" required style="width: 100%; cursor: pointer; appearance: auto; background: rgba(95, 15, 156, 0.4); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="" disabled selected style="background: #5f0f9c;">Select City</option>
                                        @foreach($branches->pluck('city')->unique() as $city)
                                            <option value="{{ $city }}" {{ old('delivery_city') == $city ? 'selected' : '' }} style="background: #5f0f9c;">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery_city')
                                        <small style="color: #fca5a5; display: block; margin-top: 5px;"><i class="fa-solid fa-exclamation-circle"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <label style="color: white; font-weight: 600; display: block; margin-bottom: 8px;">
                                        <i class="fa-solid fa-shop"></i> Branch *
                                    </label>
                                    <select name="branch_address" id="branch_id" class="voucher-input" required style="width: 100%; cursor: pointer; appearance: auto; background: rgba(95, 15, 156, 0.4); color: white; border: 1px solid rgba(255,255,255,0.2);">
                                        <option value="" disabled selected style="background: #5f0f9c;">Select Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->name }}" data-city="{{ $branch->city }}" class="branch-option" style="display: none; background: #5f0f9c;">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_address')
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

                        <button type="submit" id="submitBtn" class="payment-btn">
                            <i class="fa-solid fa-lock"></i> Complete Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Success Notification Modal -->
    <div id="successModal" class="premium-modal-overlay" style="display: none;">
        <div class="premium-modal">
            <div class="premium-checkmark">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="premium-title" id="modalTitle">payment completed</h2>
            <p class="premium-text" id="modalText">Your order is being processed. Please wait...</p>
            <div class="premium-loader" id="modalLoader"></div>
        </div>
    </div>

    <style>
        .premium-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.4s ease;
        }

        .premium-modal {
            background: white;
            padding: 50px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
            animation: slideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .premium-checkmark {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 40px;
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3);
            animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .premium-title {
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .premium-text {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .premium-loader {
            width: 40px;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .premium-loader::after {
            content: '';
            position: absolute;
            width: 40%;
            height: 100%;
            background: #5f0f9c;
            animation: loading 1.5s infinite ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }

        @keyframes loading {
            from { left: -40%; }
            to { left: 100%; }
        }
    </style>

    <script>
        const citySelect = document.getElementById('delivery_city');
        const branchSelect = document.getElementById('branch_id');
        const allBranchOptions = Array.from(branchSelect.querySelectorAll('.branch-option'));
        const defaultBranchOption = branchSelect.querySelector('option[value=""]');

        citySelect.addEventListener('change', function() {
            const selectedCity = this.value;
            
            // Clear current options except the default one
            branchSelect.innerHTML = "";
            branchSelect.appendChild(defaultBranchOption);
            
            // Filter and add only relevant branches
            allBranchOptions.forEach(option => {
                if (option.getAttribute('data-city') === selectedCity) {
                    const newOption = option.cloneNode(true);
                    newOption.style.display = 'block';
                    branchSelect.appendChild(newOption);
                }
            });

            branchSelect.value = "";
            branchSelect.disabled = false;
        });

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            
            // Check if form is valid before showing modal
            if (!form.checkValidity()) {
                return; // Let browser handle validation messages
            }
            
            e.preventDefault(); // Stop immediate submission
            
            const modal = document.getElementById('successModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalText = document.getElementById('modalText');
            
            modal.style.display = 'flex';
            
            // Send request via AJAX
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update modal for success state
                    modalTitle.innerText = "payment completed";
                    modalText.innerText = "Thank you! Your order has been placed.";
                    
                    // Stay for 3 seconds then hide modal and update button
                    setTimeout(function() {
                        modal.style.display = 'none';
                        submitBtn.innerHTML = '<i class="fa-solid fa-check-circle"></i> Payment completed';
                        submitBtn.disabled = true;
                        submitBtn.style.background = '#22c55e';
                        submitBtn.style.color = 'white';
                        submitBtn.style.cursor = 'default';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                let errorMessage = 'Payment processing failed. Please try again.';
                if (error.errors) {
                    errorMessage = Object.values(error.errors).flat().join('\n');
                } else if (error.message) {
                    errorMessage = error.message;
                }
                alert(errorMessage);
                modal.style.display = 'none';
            });
        });
    </script>
</x-app-layout>

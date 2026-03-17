<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .cart-container-root {
            font-family: 'Poppins', sans-serif;
            min-height: calc(100vh - 96px);
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 40px 20px;
        }

        .cart-container-root .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float-cart 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: 0;
        }
        .cart-container-root .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .cart-container-root .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .cart-container-root .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }

        @keyframes float-cart { from{transform:translateY(0);} to{transform:translateY(25px);} }

        .glass-card {
            background: rgba(255,255,255,0.15);
            padding: 50px 40px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: fadeInCart 1s ease forwards;
            width: 100%;
            max-width: 800px;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInCart { to { opacity:1; transform: translateY(0); } }

        .logo-icon { font-size: 50px; margin-bottom: 15px; color: white; }

        h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; color: white !important; }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            color: white;
        }

        .cart-table th {
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
        }

        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }

        .remove-btn {
            background: rgba(255, 0, 0, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
        }

        .remove-btn:hover {
            background: rgba(255, 0, 0, 0.4);
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            background: #5f0f9c;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .empty-cart {
            margin-bottom: 30px;
            font-style: italic;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>

    <div class="cart-container-root">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>

        <div class="glass-card">
            <div class="logo-icon"><i class="fa-solid fa-cart-shopping"></i></div>
            <h2>Your Shopping Cart</h2>

            @if(session('success'))
                <div class="mb-6 bg-emerald-500/20 border border-emerald-500/50 text-white px-6 py-3 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($cartItems) > 0)
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Food Item</th>
                            <th>Qty</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalAmount = 0; @endphp
                        @foreach($cartItems as $item)
                            @php $itemTotal = $item->food->price * $item->quantity; @endphp
                            @php $totalAmount += $itemTotal; @endphp
                            <tr>
                                <td>{{ $item->food->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>৳{{ number_format($itemTotal, 0) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove',$item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right; font-weight: 700; padding-top: 30px;">GRAND TOTAL:</td>
                            <td colspan="2" style="font-weight: 900; font-size: 20px; color: white; padding-top: 30px;">৳{{ number_format($totalAmount, 0) }}</td>
                        </tr>
                    </tbody>
                </table>

                <form method="GET" action="{{ route('checkout') }}">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            @else
                <div class="empty-cart">
                    <p>Your cart is empty. Start adding some delicious food!</p>
                </div>
                <a href="{{ route('food.index') }}" class="checkout-btn no-underline inline-block">Browse Menu</a>
            @endif
        </div>
    </div>
</x-app-layout>
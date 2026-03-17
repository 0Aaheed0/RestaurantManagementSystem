<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .order-history-container {
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

        .order-history-container .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float-orders 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: 0;
        }
        .order-history-container .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .order-history-container .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .order-history-container .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }

        @keyframes float-orders { from{transform:translateY(0);} to{transform:translateY(25px);} }

        .glass-card {
            background: rgba(255,255,255,0.15);
            padding: 50px 40px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: fadeInOrders 1s ease forwards;
            width: 100%;
            max-width: 900px;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInOrders { to { opacity:1; transform: translateY(0); } }

        .logo-icon { font-size: 50px; margin-bottom: 15px; color: white; }

        h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; color: white !important; }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            color: white;
            text-align: left;
        }

        .orders-table th {
            padding: 15px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
        }

        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 500;
            vertical-align: top;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }

        .status-pending { background: rgba(255, 193, 7, 0.3); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.5); }
        .status-completed { background: rgba(40, 167, 69, 0.3); color: #28a745; border: 1px solid rgba(40, 167, 69, 0.5); }

        .items-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 12px;
            opacity: 0.9;
        }

        .items-list li {
            margin-bottom: 4px;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 30px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #5f0f9c;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .order-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 12px;
            opacity: 0.9;
        }

        .order-detail-label {
            font-weight: 600;
        }

        .address-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.5);
            color: #60a5fa;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            cursor: pointer;
            transition: 0.3s;
        }

        .address-badge:hover {
            background: rgba(59, 130, 246, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: rgba(31, 41, 55, 0.95);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.2);
            max-width: 500px;
            width: 90%;
            color: white;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
        }

        .modal-address-info {
            line-height: 1.8;
        }

        .modal-address-info div {
            margin-bottom: 10px;
        }

        .modal-address-label {
            font-weight: 600;
            opacity: 0.8;
            font-size: 12px;
            text-transform: uppercase;
        }
    </style>

    <div class="order-history-container">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>

        <div class="glass-card">
            <div class="logo-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <h2>Order History</h2>

            @if(session('success'))
                <div class="mb-6 bg-emerald-500/20 border border-emerald-500/50 text-white px-6 py-3 rounded-xl font-bold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($orders) > 0)
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Delivery</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ 1000 + $order->id }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}<br><small style="opacity:0.6">{{ $order->created_at->format('h:i A') }}</small></td>
                                <td>
                                    <ul class="items-list">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->quantity }}x {{ $item->food->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div style="font-weight: 700;">৳{{ number_format($order->total_price, 0) }}</div>
                                    @if($order->discount_amount > 0)
                                        <div style="font-size: 12px; opacity: 0.8; margin-top: 2px;">
                                            <span style="color: #4ade80;">-৳{{ number_format($order->discount_amount, 0) }}</span>
                                            @if($order->voucher)
                                                <br>{{ $order->voucher->code }}
                                            @endif
                                        </div>
                                        <div style="font-size: 12px; font-weight: 600; margin-top: 4px;">Final: ৳{{ number_format($order->final_price, 0) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <button class="address-badge" onclick="openAddressModal({{ $order->id }})">
                                        <i class="fa-solid fa-map-marker-alt"></i> View Address
                                    </button>
                                    <!-- Hidden address data -->
                                    <div id="address-{{ $order->id }}" style="display:none;">
                                        <div class="modal-address-info">
                                            <div>
                                                <div class="modal-address-label">📍 Street Address</div>
                                                <div>{{ $order->delivery_address }}</div>
                                            </div>
                                            <div>
                                                <div class="modal-address-label">🏙️ City</div>
                                                <div>{{ $order->delivery_city }}, {{ $order->delivery_postal_code }}</div>
                                            </div>
                                            <div>
                                                <div class="modal-address-label">📞 Phone Number</div>
                                                <div>{{ $order->delivery_phone }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $order->status == 'pending' ? 'status-pending' : 'status-completed' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="margin-bottom: 30px; opacity: 0.7; font-style: italic;">
                    <p>You haven't placed any orders yet.</p>
                </div>
            @endif

            <a href="{{ route('food.index') }}" class="back-btn">Order New Food</a>
        </div>
    </div>

    <!-- Address Modal -->
    <div id="addressModal" class="modal" onclick="if(event.target === this) closeAddressModal()">
        <div class="modal-content">
            <div class="modal-header">
                <span>📍 Delivery Address</span>
                <button class="modal-close" onclick="closeAddressModal()">&times;</button>
            </div>
            <div id="modalAddressContent"></div>
        </div>
    </div>

    <script>
        function openAddressModal(orderId) {
            const addressData = document.getElementById('address-' + orderId);
            const content = document.getElementById('modalAddressContent');
            content.innerHTML = addressData.innerHTML;
            document.getElementById('addressModal').classList.add('active');
        }

        function closeAddressModal() {
            document.getElementById('addressModal').classList.remove('active');
        }

        // Close modal when pressing Escape
        document.addEventListener('keydown', function(event) {
            if(event.key === 'Escape') {
                closeAddressModal();
            }
        });
    </script>
</x-app-layout>
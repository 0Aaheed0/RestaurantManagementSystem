<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        .page-background {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            z-index: 1;
        }

        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            backdrop-filter: blur(8px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .success-modal {
            background: white;
            border-radius: 25px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .checkmark-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: white;
            box-shadow: 0 15px 35px rgba(74, 222, 128, 0.3);
            animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0) rotate(-45deg);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1) rotate(0);
            }
        }

        .success-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
            animation: fadeInDown 0.6s ease 0.2s backwards;
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.6;
            animation: fadeInDown 0.6s ease 0.3s backwards;
        }

        .order-info {
            background: linear-gradient(135deg, #f0f4ff, #f9fafb);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
            animation: fadeInDown 0.6s ease 0.4s backwards;
        }

        .info-label {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 28px;
            font-weight: 700;
            color: #5f0f9c;
            font-family: 'Courier New', monospace;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            animation: fadeInDown 0.6s ease 0.5s backwards;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5f0f9c, #9d4edd);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(95, 15, 156, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        .progress-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #4ade80, #22c55e);
            border-radius: 0 0 25px 0;
            animation: progressBar 5s linear forwards;
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }
            to {
                width: 0;
            }
        }
    </style>

    <div class="page-background"></div>

    <div class="success-overlay">
        <div class="success-modal">
            <div class="checkmark-circle">
                ✓
            </div>

            <h1 class="success-title">Order Successful!</h1>
            <p class="success-message">
                Your payment has been processed successfully.<br>
                Your delicious food will be prepared and delivered soon!
            </p>

            <div class="order-info">
                <div class="info-label">{{ ucwords(str_replace('_', ' ', $paymentMethod)) }} Payment</div>
                <div class="info-label" style="margin-bottom: 15px;">Order Confirmation ID</div>
                <div class="info-value">#{{ 1000 + $order->id }}</div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('orders.history') }}" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i> View Orders
                </a>
                <a href="{{ route('food.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-utensils"></i> Order More
                </a>
            </div>

            <div class="progress-indicator"></div>
        </div>
    </div>

    <script>
        // Auto-redirect after 5 seconds
        setTimeout(function() {
            window.location.href = '{{ route("orders.history") }}';
        }, 5000);
    </script>
</x-app-layout>

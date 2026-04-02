<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management | Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            background: linear-gradient(135deg, #2d004d, #5f0f9c, #9d4edd) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
        }

        .table-header {
            background: rgba(255, 255, 255, 0.1);
        }

        .status-badge {
            @apply px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border;
        }

        .status-pending { @apply bg-yellow-500/20 text-yellow-300 border-yellow-500/30; }
        .status-completed { @apply bg-green-500/20 text-green-300 border-green-500/30; }
        .status-cancelled { @apply bg-red-500/20 text-red-300 border-red-500/30; }

        select {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            font-size: 0.75rem !important;
        }
    </style>
</head>
<body class="font-sans antialiased text-white">
    <!-- Header -->
    <header class="bg-white/5 border-b border-white/10 sticky top-0 z-50 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="h-10 w-10 bg-white/10 hover:bg-white/20 flex items-center justify-center rounded-xl transition-all">
                        <i class="fas fa-chevron-left text-xs text-white"></i>
                    </a>
                    <span class="font-black tracking-widest uppercase text-lg">Order Management</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black uppercase tracking-widest opacity-60">Admin Access</span>
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-purple-500 to-pink-500 p-[2px]">
                        <div class="h-full w-full bg-[#2d004d] rounded-[10px] flex items-center justify-center font-black text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Status Messages -->
        @if(session('success'))
            <div class="mb-8 bg-green-500/20 border border-green-500/50 text-green-200 px-6 py-4 rounded-2xl flex items-center gap-4">
                <i class="fas fa-check-circle"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <div class="p-8 border-b border-white/10 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black">All Orders</h2>
                    <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Track and manage customer food orders</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="text-2xl font-black">{{ count($orders) }}</div>
                        <div class="text-[9px] font-black uppercase tracking-widest opacity-40">Total Orders</div>
                    </div>
                    <i class="fas fa-box-open text-4xl opacity-20"></i>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                            <th class="px-8 py-5">Order ID</th>
                            <th class="px-8 py-5">Customer</th>
                            <th class="px-8 py-5">Amount</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5">Date</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($orders as $order)
                        <tr class="hover:bg-white/5 transition-colors group" x-data="{ open: false }">
                            <td class="px-8 py-6">
                                <div class="font-black text-white">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <button @click="open = !open" class="text-[9px] font-black uppercase text-purple-400 hover:text-white transition-all mt-1">
                                    <i class="fas" :class="open ? 'fa-eye-slash' : 'fa-eye'"></i> <span x-text="open ? 'Hide Details' : 'View Details'"></span>
                                </button>
                            </td>
                            <td class="px-8 py-6">
                                <div class="font-bold text-white">{{ $order->user_name }}</div>
                                <div class="text-[10px] text-white/40 uppercase tracking-widest">{{ $order->user_email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="font-black text-purple-300">৳{{ number_format($order->final_price ?? $order->total_price, 2) }}</div>
                                @if($order->discount_amount > 0)
                                    <div class="text-[9px] text-green-400 font-bold uppercase">Disc: -৳{{ number_format($order->discount_amount, 2) }}</div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm">
                                {{ date('M d, Y', strtotime($order->created_at)) }}<br>
                                <span class="opacity-40 text-[10px]">{{ date('h:i A', strtotime($order->created_at)) }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center justify-end gap-2">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="px-3 py-1.5 rounded-lg outline-none cursor-pointer">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Expanded Details Row -->
                            <template x-if="open">
                                <tr class="bg-white/[0.02]">
                                    <td colspan="6" class="px-8 py-8">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <!-- Items List -->
                                            <div>
                                                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-purple-300 mb-4">Order Items</h4>
                                                <div class="space-y-3">
                                                    @foreach($order->items as $item)
                                                    <div class="flex items-center justify-between bg-white/5 p-3 rounded-2xl border border-white/5">
                                                        <div class="flex items-center gap-3">
                                                            <div class="h-10 w-10 rounded-xl bg-white/10 overflow-hidden">
                                                                @if($item->food_image)
                                                                    <img src="{{ asset($item->food_image) }}" class="h-full w-full object-cover">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div class="text-xs font-bold">{{ $item->food_name }}</div>
                                                                <div class="text-[10px] opacity-50">Qty: {{ $item->quantity }} x ৳{{ number_format($item->price, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="text-xs font-black text-purple-200">৳{{ number_format($item->quantity * $item->price, 2) }}</div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Delivery Details -->
                                            <div>
                                                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-purple-300 mb-4">Delivery Information</h4>
                                                <div class="bg-white/5 p-6 rounded-[2rem] border border-white/5 space-y-4">
                                                    <div>
                                                        <div class="text-[9px] font-black uppercase opacity-40 mb-1">Address</div>
                                                        <div class="text-xs leading-relaxed">{{ $order->delivery_address ?? 'N/A' }}</div>
                                                        <div class="text-xs">{{ $order->delivery_city ?? '' }} {{ $order->delivery_postal_code ?? '' }}</div>
                                                    </div>
                                                    <div>
                                                        <div class="text-[9px] font-black uppercase opacity-40 mb-1">Phone</div>
                                                        <div class="text-xs font-bold">{{ $order->delivery_phone ?? 'N/A' }}</div>
                                                    </div>
                                                    @if($order->voucher_code)
                                                    <div>
                                                        <div class="text-[9px] font-black uppercase opacity-40 mb-1">Voucher Applied</div>
                                                        <span class="bg-purple-500/20 text-purple-300 px-2 py-1 rounded-md text-[9px] font-black uppercase border border-purple-500/30">
                                                            {{ $order->voucher_code }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="text-4xl mb-4 opacity-20">🚚</div>
                                <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No orders placed yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

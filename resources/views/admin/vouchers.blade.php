<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management | Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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

        input, select {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
        }

        input:focus, select:focus {
            border-color: #9d4edd !important;
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(157, 78, 221, 0.2) !important;
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
                    <span class="font-black tracking-widest uppercase text-lg">Voucher Management</span>
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

        @if($errors->any())
            <div class="mb-8 bg-red-500/20 border border-red-500/50 text-red-200 px-6 py-4 rounded-2xl">
                <ul class="list-disc list-inside font-bold text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add New Voucher Form -->
            <div class="lg:col-span-1">
                <div class="glass-card p-8 sticky top-32">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-10 w-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-300">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h2 class="text-xl font-black">Create Voucher</h2>
                    </div>

                    <form action="{{ route('admin.vouchers.add') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Voucher Code</label>
                            <input type="text" name="code" placeholder="e.g. SUMMER50" required class="w-full px-5 py-3 rounded-xl">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Discount</label>
                                <input type="number" step="0.01" name="discount" placeholder="Value" required class="w-full px-5 py-3 rounded-xl">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Type</label>
                                <select name="type" required class="w-full px-5 py-3 rounded-xl">
                                    <option value="percentage">Percent (%)</option>
                                    <option value="fixed">Fixed ($)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Max Uses</label>
                            <input type="number" name="max_uses" placeholder="e.g. 100" required class="w-full px-5 py-3 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Expiry Date</label>
                            <input type="date" name="valid_until" required class="w-full px-5 py-3 rounded-xl">
                        </div>

                        <button type="submit" class="w-full bg-white text-purple-700 font-black uppercase tracking-widest py-4 rounded-xl shadow-xl hover:bg-purple-50 transition-all active:scale-95">
                            Generate Voucher
                        </button>
                    </form>
                </div>
            </div>

            <!-- Vouchers List -->
            <div class="lg:col-span-2">
                <div class="glass-card overflow-hidden">
                    <div class="p-8 border-b border-white/10 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-black">Existing Vouchers</h2>
                            <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Active and upcoming promotions</p>
                        </div>
                        <i class="fas fa-ticket-alt text-4xl opacity-20"></i>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                                    <th class="px-8 py-5">Code</th>
                                    <th class="px-8 py-5">Discount</th>
                                    <th class="px-8 py-5">Usage</th>
                                    <th class="px-8 py-5">Expiry</th>
                                    <th class="px-8 py-5 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($vouchers as $voucher)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-lg tracking-wider text-purple-300">{{ $voucher->code }}</div>
                                        <div class="text-[9px] text-white/40 uppercase tracking-tighter">ID: #VCH-{{ str_pad($voucher->id, 4, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl font-bold">
                                                {{ $voucher->type == 'fixed' ? '$' : '' }}{{ number_format($voucher->discount, 0) }}{{ $voucher->type == 'percentage' ? '%' : '' }}
                                            </span>
                                            <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded-md bg-white/5 border border-white/10 opacity-60">
                                                {{ $voucher->type }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="w-full max-w-[100px] h-1.5 bg-white/5 rounded-full overflow-hidden mb-1.5">
                                            @php 
                                                $percent = ($voucher->uses / $voucher->max_uses) * 100;
                                                $color = $percent > 90 ? 'bg-red-500' : ($percent > 70 ? 'bg-yellow-500' : 'bg-green-500');
                                            @endphp
                                            <div class="h-full {{ $color }} transition-all" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="text-[10px] font-bold text-white/60">
                                            {{ $voucher->uses }} / {{ $voucher->max_uses }} Used
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @php 
                                            $isExpired = \Carbon\Carbon::parse($voucher->valid_until)->isPast();
                                        @endphp
                                        <div class="text-sm font-medium {{ $isExpired ? 'text-red-400' : 'text-white' }}">
                                            {{ date('M d, Y', strtotime($voucher->valid_until)) }}
                                        </div>
                                        @if($isExpired)
                                            <div class="text-[9px] font-black uppercase text-red-500 tracking-widest mt-0.5">Expired</div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <form action="{{ route('admin.vouchers.delete', $voucher->id) }}" method="POST" onsubmit="return confirm('Delete this voucher?')">
                                            @csrf
                                            <button type="submit" class="h-10 w-10 rounded-xl bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 transition-all flex items-center justify-center">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="text-4xl mb-4 opacity-20">🎟️</div>
                                        <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No vouchers created yet</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

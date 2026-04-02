<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Management | Admin Panel</title>
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

        .status-badge {
            @apply px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border;
        }

        .status-pending {
            @apply bg-yellow-500/20 text-yellow-300 border-yellow-500/30;
        }

        .status-solved {
            @apply bg-green-500/20 text-green-300 border-green-500/30;
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
                    <span class="font-black tracking-widest uppercase text-lg">Customer Reports</span>
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
                    <h2 class="text-2xl font-black">Reported Issues</h2>
                    <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Monitor and resolve customer complaints</p>
                </div>
                <i class="fas fa-flag text-4xl opacity-20"></i>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                            <th class="px-8 py-5">Customer</th>
                            <th class="px-8 py-5">Issue Details</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($reports as $report)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="font-bold text-white">{{ $report->customer_name }}</div>
                                <div class="text-[10px] text-purple-300/60 uppercase font-black tracking-widest">{{ $report->email ?? 'No Email' }}</div>
                                <div class="text-[9px] text-white/40 mt-1">{{ $report->phone ?? 'No Phone' }}</div>
                            </td>
                            <td class="px-8 py-6 max-w-md">
                                <div class="font-black text-purple-200 uppercase tracking-tighter text-xs mb-1">{{ $report->title }}</div>
                                <div class="text-sm text-white/70 line-clamp-2" title="{{ $report->description }}">
                                    {{ $report->description }}
                                </div>
                                <div class="text-[9px] text-white/30 mt-2 uppercase tracking-widest">Received: {{ date('M d, Y H:i', strtotime($report->created_at)) }}</div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="status-badge {{ $report->status == 'solved' ? 'status-solved' : 'status-pending' }}">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($report->status != 'solved')
                                <form action="{{ route('admin.reports.solve', $report->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all active:scale-95 flex items-center gap-2 ml-auto">
                                        <i class="fas fa-check"></i> Mark Solved
                                    </button>
                                </form>
                                @else
                                <div class="text-green-400 text-[10px] font-black uppercase tracking-widest flex items-center justify-end gap-2">
                                    <i class="fas fa-check-double"></i> Resolved
                                </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="text-4xl mb-4 opacity-20">🎉</div>
                                <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">Zero pending issues. Good job!</p>
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

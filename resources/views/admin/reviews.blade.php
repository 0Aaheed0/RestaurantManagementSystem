<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Management | Admin Panel</title>
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

        .star-active {
            color: #fbbf24; /* Yellow-400 */
        }

        .star-inactive {
            color: rgba(255, 255, 255, 0.1);
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
                    <span class="font-black tracking-widest uppercase text-lg">Customer Reviews</span>
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
                    <h2 class="text-2xl font-black">Food Reviews</h2>
                    <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Monitor customer feedback and ratings</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="text-2xl font-black">{{ count($reviews) }}</div>
                        <div class="text-[9px] font-black uppercase tracking-widest opacity-40">Total Reviews</div>
                    </div>
                    <i class="fas fa-star text-4xl opacity-20 text-yellow-400"></i>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                            <th class="px-8 py-5">User</th>
                            <th class="px-8 py-5">Food Item</th>
                            <th class="px-8 py-5">Rating</th>
                            <th class="px-8 py-5">Review</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($reviews as $review)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-white/10 flex items-center justify-center text-[10px] font-black">
                                        {{ strtoupper(substr($review->user_name ?? 'G', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">{{ $review->user_name ?? 'Guest User' }}</div>
                                        <div class="text-[9px] text-white/30 uppercase tracking-widest">{{ date('M d, Y', strtotime($review->created_at)) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="bg-purple-500/20 text-purple-300 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-purple-500/30">
                                    {{ $review->food_name ?? 'Unknown Item' }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-[10px] {{ $i <= $review->rating ? 'star-active' : 'star-inactive' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm text-white/70 italic leading-relaxed max-w-xs line-clamp-2" title="{{ $review->review }}">
                                    "{{ $review->review }}"
                                </p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Permanently delete this review?')">
                                    @csrf
                                    <button type="submit" class="h-9 w-9 rounded-xl bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 transition-all flex items-center justify-center ml-auto group">
                                        <i class="fas fa-trash-alt text-xs transition-transform group-hover:scale-110"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="text-4xl mb-4 opacity-20">💬</div>
                                <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No reviews have been submitted yet</p>
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

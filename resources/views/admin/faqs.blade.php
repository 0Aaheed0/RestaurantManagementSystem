<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Management | Admin Panel</title>
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

        input, textarea {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
        }

        input:focus, textarea:focus {
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
                    <span class="font-black tracking-widest uppercase text-lg">FAQ Management</span>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Add New FAQ Form -->
            <div class="lg:col-span-1">
                <div class="glass-card p-8 sticky top-32">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-10 w-10 bg-purple-500/20 rounded-xl flex items-center justify-center text-purple-300">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2 class="text-xl font-black">Add New FAQ</h2>
                    </div>

                    <form action="{{ route('admin.faqs.add') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Question</label>
                            <input type="text" name="question" placeholder="Enter question..." required class="w-full px-5 py-3 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-purple-200 mb-2">Answer</label>
                            <textarea name="answer" rows="4" placeholder="Enter answer..." required class="w-full px-5 py-3 rounded-xl resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-white text-purple-700 font-black uppercase tracking-widest py-4 rounded-xl shadow-xl hover:bg-purple-50 transition-all active:scale-95">
                            Publish FAQ
                        </button>
                    </form>
                </div>
            </div>

            <!-- FAQs List -->
            <div class="lg:col-span-2">
                <div class="glass-card overflow-hidden">
                    <div class="p-8 border-b border-white/10 flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-black">Published FAQs</h2>
                            <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Current help center content</p>
                        </div>
                        <i class="fas fa-list-ul text-4xl opacity-20"></i>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        @forelse($faqs as $faq)
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 group hover:bg-white/10 transition-all">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <h3 class="font-black text-purple-200 uppercase tracking-tighter text-sm mb-3">Q: {{ $faq->question }}</h3>
                                    <p class="text-sm text-white/70 leading-relaxed">
                                        {{ $faq->answer }}
                                    </p>
                                    <div class="text-[9px] text-white/30 mt-4 uppercase tracking-widest">Added: {{ date('M d, Y', strtotime($faq->created_at)) }}</div>
                                </div>
                                <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
                                    @csrf
                                    <button type="submit" class="h-10 w-10 rounded-xl bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 transition-all flex items-center justify-center">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="py-20 text-center">
                            <div class="text-4xl mb-4 opacity-20">❓</div>
                            <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No FAQs published yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

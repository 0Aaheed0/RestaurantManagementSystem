<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management | Admin Panel</title>
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

        .nav-link-active {
            background: white;
            color: #5f0f9c;
        }

        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
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
                    <span class="font-black tracking-widest uppercase text-lg">Staff Management</span>
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

        <!-- Tab Navigation -->
        <div class="flex gap-4 mb-10">
            <button onclick="switchTab('staff-list')" id="btn-staff-list" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all bg-white text-purple-700 shadow-xl">
                Active Staff ({{ count($staffs) }})
            </button>
            <button onclick="switchTab('applications')" id="btn-applications" class="tab-btn px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all bg-white/10 text-white border border-white/10 hover:bg-white/20">
                Applications ({{ count($applications) }})
            </button>
        </div>

        <!-- Staff List Section -->
        <section id="staff-list" class="tab-content active">
            <div class="glass-card overflow-hidden">
                <div class="p-8 border-b border-white/10 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-black">Employee Directory</h2>
                        <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Current active staff members</p>
                    </div>
                    <i class="fas fa-users text-4xl opacity-20"></i>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                                <th class="px-8 py-5">Staff Member</th>
                                <th class="px-8 py-5">Position</th>
                                <th class="px-8 py-5">Contact</th>
                                <th class="px-8 py-5">Joined Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($staffs as $staff)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-300 font-bold border border-purple-500/30">
                                            {{ strtoupper(substr($staff->full_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white">{{ $staff->full_name }}</div>
                                            <div class="text-[10px] text-purple-300/60 uppercase font-black tracking-tighter">ID: #STF-{{ str_pad($staff->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="bg-blue-500/20 text-blue-300 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-blue-500/30">
                                        {{ $staff->position }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-medium">{{ $staff->email }}</div>
                                    <div class="text-[10px] text-white/50">{{ $staff->phone ?? 'No phone' }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-medium">{{ date('M d, Y', strtotime($staff->joined_at)) }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="text-4xl mb-4 opacity-20">📭</div>
                                    <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">No active staff members found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Applications Section -->
        <section id="applications" class="tab-content">
            <div class="glass-card overflow-hidden">
                <div class="p-8 border-b border-white/10 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-black">Hiring Queue</h2>
                        <p class="text-purple-200 text-xs font-bold uppercase tracking-widest mt-1 opacity-70">Review and approve new applications</p>
                    </div>
                    <i class="fas fa-file-signature text-4xl opacity-20"></i>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="table-header text-[10px] font-black uppercase tracking-[0.2em] text-purple-200">
                                <th class="px-8 py-5">Applicant</th>
                                <th class="px-8 py-5">Desired Role</th>
                                <th class="px-8 py-5">Application Info</th>
                                <th class="px-8 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($applications as $app)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-white">{{ $app->full_name }}</div>
                                    <div class="text-[10px] text-purple-300/60 uppercase font-black tracking-widest">{{ $app->email }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="bg-purple-500/20 text-purple-300 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-purple-500/30">
                                        {{ $app->position }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-xs text-white/70 max-w-xs truncate" title="{{ $app->experience }}">
                                        {{ $app->experience ?? 'No experience provided' }}
                                    </div>
                                    <div class="text-[10px] text-white/40 mt-1 uppercase tracking-widest">Phone: {{ $app->phone ?? 'N/A' }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end gap-3">
                                        <form action="{{ route('admin.staffs.approve', $app->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all active:scale-95 flex items-center gap-2">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.staffs.decline', $app->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-white/10 hover:bg-red-500 text-white px-5 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all border border-white/20 active:scale-95 flex items-center gap-2">
                                                <i class="fas fa-times"></i> Decline
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="text-4xl mb-4 opacity-20">✨</div>
                                    <p class="text-purple-200/50 font-bold uppercase tracking-widest text-xs">Queue is clear! No pending applications.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        function switchTab(tabId) {
            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Deactivate all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-purple-700', 'shadow-xl');
                btn.classList.add('bg-white/10', 'text-white', 'border', 'border-white/10');
            });

            // Show selected content
            document.getElementById(tabId).classList.add('active');
            
            // Activate selected button
            const activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.add('bg-white', 'text-purple-700', 'shadow-xl');
            activeBtn.classList.remove('bg-white/10', 'text-white', 'border', 'border-white/10');
        }
    </script>
</body>
</html>

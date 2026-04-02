<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Restaurant Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2d004d, #5f0f9c, #9d4edd) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
        }

        /* Decorative Background Shapes */
        .shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            animation: float 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: -1;
            pointer-events: none;
        }
        .shape1 { width: 450px; height: 450px; top: -150px; left: -150px; }
        .shape2 { width: 350px; height: 350px; bottom: -80px; right: -80px; animation-delay: 2s; }
        .shape3 { width: 250px; height: 250px; top: 15%; right: 10%; animation-delay: 4s; }
        @keyframes float { from { transform: translateY(0px) rotate(0deg); } to { transform: translateY(40px) rotate(10deg); } }

        .admin-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            backdrop-blur: 20px;
        }

        .nav-card {
            @apply bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 transition-all duration-300 flex flex-col items-center text-center no-underline hover:scale-105 hover:shadow-2xl;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800">
    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <!-- Header -->
    <header class="admin-header sticky top-0 z-50 text-white shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-5">
                    <div class="bg-white p-2 rounded-2xl shadow-xl transform hover:rotate-6 transition">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
                    </div>
                    <span class="block font-black tracking-[0.25em] uppercase text-xl">ADMIN PANEL</span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3 bg-white/10 px-4 py-1.5 rounded-2xl border border-white/10">
                        <div class="h-8 w-8 rounded-lg bg-white text-purple-700 flex items-center justify-center font-black text-xs shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:block font-black text-[10px] uppercase tracking-widest">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white/10 hover:bg-red-500 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all border border-white/20 active:scale-95">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-black text-white mb-4 tracking-tight">Main Dashboard</h1>
            <p class="text-purple-100 font-bold uppercase tracking-[0.3em] opacity-80 text-xs">Select a management module</p>
        </div>

        <!-- Navigation Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Foods -->
            <a href="{{ route('admin.foods') }}" class="nav-card">
                <span class="text-7xl mb-6">🍕</span>
                <h3 class="text-2xl font-black text-white mb-2">Foods</h3>
                <p class="text-white/75 font-medium text-sm leading-relaxed">Manage your restaurant's menu, categories, and inventory</p>
            </a>

            <!-- Vouchers -->
            <a href="{{ route('admin.vouchers') }}" class="nav-card">
                <span class="text-7xl mb-6">🎟️</span>
                <h3 class="text-2xl font-black text-white mb-2">Vouchers</h3>
                <p class="text-white/75 font-medium text-sm leading-relaxed">Create and track promotional codes and discounts</p>
            </a>

            <!-- Reviews -->
            <a href="{{ route('admin.reviews') }}" class="nav-card">
                <span class="text-7xl mb-6">⭐</span>
                <h3 class="text-2xl font-black text-white mb-2">Reviews</h3>
                <p class="text-white/75 font-medium text-sm leading-relaxed">Monitor customer feedback and star ratings</p>
            </a>

            <!-- Reports -->
            <a href="{{ route('admin.reports') }}" class="nav-card">
                <span class="text-7xl mb-6">📊</span>
                <h3 class="text-2xl font-black text-white mb-2">Reports</h3>
                <p class="text-white/75 font-medium text-sm leading-relaxed">View sales analytics, trends, and performance reports</p>
            </a>

            <!-- Staffs -->
            <a href="{{ route('admin.staffs') }}" class="nav-card">
                <span class="text-7xl mb-6">👥</span>
                <h3 class="text-2xl font-black text-white mb-2">Staffs</h3>
                <p class="text-white/75 font-medium text-sm leading-relaxed">Manage employee records, roles, and branch assignments</p>
            </a>
        </div>
    </main>
</body>
</html>

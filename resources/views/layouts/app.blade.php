<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ sidebarOpen: false }" @open-menu.window="sidebarOpen = true" class="min-h-screen relative overflow-x-hidden">
            <!-- SIDEBAR BACKDROP -->
            <div x-show="sidebarOpen" style="display:none" @click="sidebarOpen=false"
                 x-transition.opacity
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[60]"></div>

            <!-- SIDEBAR CONTENT -->
            <div x-show="sidebarOpen" style="display:none"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="fixed inset-y-0 left-0 w-80 bg-white border-r border-slate-200 z-[70] p-6 shadow-2xl flex flex-col h-full">

                <div class="flex items-center justify-between mb-8 border-b border-slate-50 pb-4">
                    <span class="text-purple-600 font-black tracking-widest text-sm uppercase">Main Menu</span>
                    <button @click="sidebarOpen=false" class="text-slate-400 hover:text-purple-600">✕</button>
                </div>

                <nav class="flex flex-col gap-3 overflow-y-auto pr-2 flex-1">
                    <a href="{{ route('dashboard') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Home</a>
                    <a href="{{ route('food.index') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Food</a>
                    <a href="{{ route('cart.index') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Cart</a>
                    <a href="{{ route('orders.history') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Order History</a>
                    <a href="{{ route('branches.index') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Branch</a>
                    <a href="{{ route('staff.apply') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Staff Application</a>
                    <a href="{{ route('report.create') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Reports</a>
                    <a href="{{ route('review.index') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Reviews</a>
                    <a href="{{ route('faq') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">FAQ</a>
                </nav>
            </div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

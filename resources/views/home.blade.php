<x-app-layout>
    <style>
        a { text-decoration: none !important; }
        body {
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff) !important;
            background-attachment: fixed !important;
        }
        .shape {
            position: fixed;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: -1;
            pointer-events: none;
        }
        .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }
        @keyframes float { from { transform: translateY(0px); } to { transform: translateY(30px); } }
    </style>

    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <div x-data="{ sidebarOpen: false }" class="min-h-screen relative overflow-x-hidden">
        
        <!-- BACKDROP -->
        <div x-show="sidebarOpen" style="display:none" @click="sidebarOpen=false"
             x-transition.opacity
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40"></div>

        <!-- SIDEBAR (UNCHANGED) -->
        <div x-show="sidebarOpen" style="display:none"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-80 bg-white border-r border-slate-200 z-50 p-6 shadow-2xl flex flex-col h-full">

            <div class="flex items-center justify-between mb-8 border-b border-slate-50 pb-4">
                <span class="text-purple-600 font-black tracking-widest text-sm uppercase">Main Menu</span>
                <button @click="sidebarOpen=false" class="text-slate-400 hover:text-purple-600">
                    ✕
                </button>
            </div>

            <nav class="flex flex-col gap-3 overflow-y-auto pr-2 flex-1">
                <a href="{{ route('dashboard') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Home</a>
                <a href="/food" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Food</a>
                <a href="/orders" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Orders</a>
                <a href="{{ route('branches.index') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Branch</a>
                <a href="{{ route('staff.apply') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Staff Application</a>
                <a href="{{ route('report.create') }}" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Reports</a>
                <a href="/reviews" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">Reviews</a>
                <a href="/faq" class="px-6 py-5 bg-purple-50 hover:bg-purple-600 hover:text-white rounded-2xl font-black text-lg transition-all duration-300 no-underline">FAQ</a>
            </nav>
        </div>

        <!-- MAIN CONTENT -->
        <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 relative z-10">

            <!-- TOP BAR -->
            <div class="flex justify-between items-center mb-10">
                <button @click="sidebarOpen=true"
                        class="bg-purple-600 text-white px-8 py-3 rounded-2xl flex items-center shadow-lg">
                    ☰ <span class="ml-3 font-bold tracking-widest text-sm">Menu</span>
                </button>

                <div class="text-slate-500 font-bold text-sm bg-white px-6 py-3 rounded-full border shadow-sm">
                    {{ now()->format('l, F jS') }}
                </div>
            </div>

          <!-- ================= PREMIUM DISCOUNT PANEL ================= -->
<div
    x-data="{
        active: 0,
        hover: false,
        slides: [
            {
                title: 'Juicy Burger 50% OFF',
                desc: 'Special weekend deal on all classic burgers',
                grad: 'from-orange-500 via-red-500 to-rose-600',
                img: 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=500&auto=format&fit=crop&q=60'
            },
            {
                title: 'BOGO Pizza Feast',
                desc: 'Buy 1 Get 1 FREE on all large pizzas',
                grad: 'from-amber-400 via-orange-500 to-red-500',
                img: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&auto=format&fit=crop&q=60'
            },
            {
                title: '20% OFF Everything',
                desc: 'Enjoy a flat discount across our entire menu',
                grad: 'from-purple-600 via-indigo-600 to-blue-600',
                img: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&auto=format&fit=crop&q=60'
            }
        ],
        start() {
            setInterval(() => {
                if (!this.hover) {
                    this.active = (this.active + 1) % this.slides.length
                }
            }, 4500)
        }
    }"
    x-init="start()"
    class="mb-16 flex justify-center"
>
    <div
        class="relative w-full max-w-5xl h-64 overflow-hidden rounded-[2.5rem] shadow-2xl"
        @mouseenter="hover = true"
        @mouseleave="hover = false"
    >

        <!-- SLIDES -->
        <div
            class="flex h-full transition-transform duration-700 ease-out"
            :style="`transform: translateX(-${active * 100}%);`"
        >
            <template x-for="(slide, i) in slides" :key="i">
                <div
                    class="min-w-full h-full bg-gradient-to-br text-white flex items-center justify-between relative"
                    :class="slide.grad"
                >
                    <!-- soft animated glow -->
                    <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>

                    <!-- LEFT CONTENT -->
                    <div class="pl-20 pr-8 max-w-md relative z-10">
                        <h2 class="text-4xl font-black mb-3" x-text="slide.title"></h2>
                        <p class="text-lg opacity-90 mb-6" x-text="slide.desc"></p>

                        <!-- CTA -->
                        <button
                            class="bg-white text-slate-800 px-8 py-3 rounded-xl font-black uppercase text-sm shadow-lg
                                   hover:bg-slate-100 transition active:scale-95"
                        >
                            View Offer →
                        </button>
                    </div>

                    <!-- RIGHT VISUAL -->
                    <div class="pr-16 relative z-10">
                        <img
                            :src="slide.img"
                            alt="Offer Visual"
                            class="w-56 h-40 rounded-3xl object-cover border-4 border-white/20 shadow-2xl animate-float"
                        >
                    </div>
                </div>
            </template>
        </div>

        <!-- CONTROLS -->
        <button
            @click="active = active === 0 ? slides.length - 1 : active - 1"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 w-11 h-11 rounded-full shadow font-black text-xl"
        >‹</button>

        <button
            @click="active = active === slides.length - 1 ? 0 : active + 1"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 w-11 h-11 rounded-full shadow font-black text-xl"
        >›</button>
    </div>
</div>
<!-- ================= END PREMIUM PANEL ================= -->

            <!-- POPULAR BRANCHES -->
            <div class="mb-16">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-3xl font-black text-slate-800 flex items-center mb-0">
                        <span class="w-10 h-1 bg-purple-600 rounded-full mr-4"></span>
                        Popular Branches
                    </h2>
                    <a href="{{ route('branches.index') }}" class="bg-white text-purple-600 px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:shadow-md transition border border-purple-100 no-underline hover:no-underline">
                        See More →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($branches as $branch)
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Branch" class="w-16 h-16 object-contain mb-4">
                            <h4 class="text-lg font-black text-slate-800 mb-1 leading-tight">{{ $branch->name }}</h4>
                            <p class="text-slate-500 font-medium text-xs mb-3">{{ $branch->area }}, {{ $branch->city }}</p>
                            <span class="mt-auto text-purple-600 font-bold text-[10px] uppercase tracking-widest">Open Now</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- POPULAR FOOD -->
            <div class="mb-16">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-3xl font-black text-slate-800 flex items-center mb-0">
                        <span class="w-10 h-1 bg-orange-500 rounded-full mr-4"></span>
                        Popular Food
                    </h2>
                    <a href="#" class="bg-white text-orange-500 px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:shadow-md transition border border-orange-100 no-underline hover:no-underline">
                        See More →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($foodItems as $food)
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            <div class="w-full aspect-square rounded-2xl overflow-hidden mb-4 bg-slate-100">
                                @if($food->image)
                                    <img src="{{ $food->image }}" alt="{{ $food->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="fas fa-utensils text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h4 class="text-lg font-black text-slate-800 mb-1 leading-tight">{{ $food->name }}</h4>
                            <p class="text-slate-500 font-medium text-xs mb-4 line-clamp-2">{{ Str::limit($food->description, 40) }}</p>
                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-orange-500 font-black text-lg">৳{{ number_format($food->price, 0) }}</span>
                                <span class="bg-orange-50 text-orange-600 text-[10px] font-black px-2 py-1 rounded-full">HOT</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <h2 class="text-3xl font-black text-slate-800 mb-8 flex items-center justify-center">Live Order Feed</h2>
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 transform -rotate-1">
                    <div class="bg-blue-600 text-white p-4 rounded-2xl rounded-tr-none mb-3 text-sm font-bold shadow-md">Table 4: 2x Pasta, 1x Coke confirmed.</div>
                    <div class="bg-white text-slate-600 p-3 rounded-2xl rounded-tl-none text-xs shadow-sm border border-slate-100 italic">"Chef: Preparing now. ETA 15 mins."</div>
                    <p class="text-[10px] font-black text-slate-300 mt-3 uppercase tracking-widest text-right">Just Now</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 transform rotate-1">
                    <div class="bg-purple-600 text-white p-4 rounded-2xl rounded-tr-none mb-3 text-sm font-bold shadow-md">Inventory Alert: Tomato Sauce Low!</div>
                    <div class="bg-white text-slate-600 p-3 rounded-2xl rounded-tl-none text-xs shadow-sm border border-slate-100 italic">"Manager: Order more from Supplier A."</div>
                    <p class="text-[10px] font-black text-slate-300 mt-3 uppercase tracking-widest text-right">2 Mins Ago</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 transform -rotate-1">
                    <div class="bg-emerald-600 text-white p-4 rounded-2xl rounded-tr-none mb-3 text-sm font-bold shadow-md">Payment: Table 12 settled ৳2,450.</div>
                    <div class="bg-white text-slate-600 p-3 rounded-2xl rounded-tl-none text-xs shadow-sm border border-slate-100 italic">"Staff: Table is now available."</div>
                    <p class="text-[10px] font-black text-slate-300 mt-3 uppercase tracking-widest text-right">5 Mins Ago</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-20 flex justify-center">
                @csrf
                <button type="button" onclick="confirmLogout(event, this.closest('form'))" class="bg-white border border-slate-200 text-slate-400 px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:text-red-500 hover:border-red-100 transition shadow-sm active:scale-95">
                    End Administrative Session
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
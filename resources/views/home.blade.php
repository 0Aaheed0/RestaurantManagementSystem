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

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 relative z-10">

            <div class="flex justify-end items-center mb-10">
                <div class="text-slate-500 font-bold text-sm bg-white px-6 py-3 rounded-full border shadow-sm">
                    {{ now()->format('l, F jS') }}
                </div>
            </div>

            <div x-data="{
                active: 0,
                hover: false,
                slides: [
                    { title: 'Juicy Burger 50% OFF', desc: 'Special weekend deal on all classic burgers', grad: 'from-orange-500 via-red-500 to-rose-600', img: 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=500&auto=format&fit=crop&q=60' },
                    { title: 'BOGO Pizza Feast', desc: 'Buy 1 Get 1 FREE on all large pizzas', grad: 'from-amber-400 via-orange-500 to-red-500', img: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&auto=format&fit=crop&q=60' },
                    { title: '20% OFF Everything', desc: 'Enjoy a flat discount across our entire menu', grad: 'from-purple-600 via-indigo-600 to-blue-600', img: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&auto=format&fit=crop&q=60' }
                ],
                start() { setInterval(() => { if (!this.hover) { this.active = (this.active + 1) % this.slides.length } }, 4500) }
            }" x-init="start()" class="mb-16 flex justify-center">
                <div class="relative w-full max-w-5xl h-64 overflow-hidden rounded-[2.5rem] shadow-2xl" @mouseenter="hover = true" @mouseleave="hover = false">
                    <div class="flex h-full transition-transform duration-700 ease-out" :style="`transform: translateX(-${active * 100}%);`" >
                        <template x-for="(slide, i) in slides" :key="i">
                            <div class="min-w-full h-full bg-gradient-to-br text-white flex items-center justify-between relative" :class="slide.grad">
                                <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                                <div class="pl-20 pr-8 max-w-md relative z-10">
                                    <h2 class="text-4xl font-black mb-3" x-text="slide.title"></h2>
                                    <p class="text-lg opacity-90 mb-6" x-text="slide.desc"></p>
                                    <button class="bg-white text-slate-800 px-8 py-3 rounded-xl font-black uppercase text-sm shadow-lg hover:bg-slate-100 transition active:scale-95">View Offer →</button>
                                </div>
                                <div class="pr-16 relative z-10">
                                    <img :src="slide.img" alt="Offer Visual" class="w-56 h-40 rounded-3xl object-cover border-4 border-white/20 shadow-2xl">
                                </div>
                            </div>
                        </template>
                    </div>
                    <button @click="active = active === 0 ? slides.length - 1 : active - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 w-11 h-11 rounded-full shadow font-black text-xl">‹</button>
                    <button @click="active = active === slides.length - 1 ? 0 : active + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 w-11 h-11 rounded-full shadow font-black text-xl">›</button>
                </div>
            </div>

            <div class="mb-16">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-3xl font-black text-slate-800 flex items-center mb-0">
                        <span class="w-10 h-1 bg-purple-600 rounded-full mr-4"></span> Popular Branches
                    </h2>
                    <a href="{{ route('branches.index') }}" class="bg-white text-purple-600 px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:shadow-md transition border border-purple-100 no-underline">See More →</a>
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

            <div class="mb-16">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-3xl font-black text-slate-800 flex items-center mb-0">
                        <span class="w-10 h-1 bg-orange-500 rounded-full mr-4"></span> Popular Food
                    </h2>
                    <a href="#" class="bg-white text-orange-500 px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:shadow-md transition border border-orange-100 no-underline">See More →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($foodItems as $food)
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            <div class="w-full aspect-square rounded-2xl overflow-hidden mb-4 bg-slate-100">
                                @if($food->image) <img src="{{ $food->image }}" alt="{{ $food->name }}" class="w-full h-full object-cover">
                                @else <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fas fa-utensils text-2xl"></i></div>
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
            <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100 grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
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

            <div class="mt-32 pb-20 border-t border-white/10 pt-20">
                <style>
                    @keyframes fadeInUp {
                        from { opacity: 0; transform: translateY(40px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .animate-reveal {
                        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                        opacity: 0;
                    }
                </style>

                <div class="text-center mb-20 animate-reveal">
                    <h2 class="text-6xl font-black text-white mb-6 drop-shadow-2xl tracking-tight">Get In Touch</h2>
                    <div class="flex items-center justify-center gap-6 opacity-60">
                        <span class="h-px w-16 bg-gradient-to-r from-transparent to-white"></span>
                        <p class="text-white font-bold tracking-[0.5em] uppercase text-xs">AUST CSE DEPARTMENT</p>
                        <span class="h-px w-16 bg-gradient-to-l from-transparent to-white"></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1: Yousha -->
                    <div class="group relative bg-white/5 backdrop-blur-2xl p-8 rounded-[3.5rem] border border-white/10 shadow-2xl hover:bg-white/10 hover:border-purple-500/50 transition-all duration-500 hover:-translate-y-3 animate-reveal" style="animation-delay: 0.1s">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[3.5rem]"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-8 shadow-[0_15px_30px_rgba(147,51,234,0.4)] group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">Y</div>
                            <h4 class="font-black text-white text-2xl mb-6 tracking-tight">Yousha</h4>
                            <div class="space-y-4">
                                <a href="mailto:yousha.cse.20230104097@aust.edu" class="flex items-center text-[11px] font-bold text-purple-200 hover:text-white transition-all duration-300">
                                    <div class="w-10 h-10 rounded-xl bg-purple-600/20 flex items-center justify-center mr-4 group-hover:bg-purple-600/40 transition-colors">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </div>
                                    <span class="truncate">yousha.cse.20230104097@aust.edu</span>
                                </a>
                                <div class="flex items-center text-sm font-bold text-white/90">
                                    <div class="w-10 h-10 rounded-xl bg-purple-600/20 flex items-center justify-center mr-4 group-hover:bg-purple-600/40 transition-colors">
                                        <i class="fas fa-phone text-xs"></i>
                                    </div>
                                    01621922735
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Aaheed -->
                    <div class="group relative bg-white/5 backdrop-blur-2xl p-8 rounded-[3.5rem] border border-white/10 shadow-2xl hover:bg-white/10 hover:border-orange-500/50 transition-all duration-500 hover:-translate-y-3 animate-reveal" style="animation-delay: 0.2s">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[3.5rem]"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-8 shadow-[0_15px_30px_rgba(249,115,22,0.4)] group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">A</div>
                            <h4 class="font-black text-white text-2xl mb-6 tracking-tight">Aaheed</h4>
                            <div class="space-y-4">
                                <a href="mailto:aaheed.cse.20230104092@aust.edu" class="flex items-center text-[11px] font-bold text-orange-200 hover:text-white transition-all duration-300">
                                    <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center mr-4 group-hover:bg-orange-500/40 transition-colors">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </div>
                                    <span class="truncate">aaheed.cse.20230104092@aust.edu</span>
                                </a>
                                <div class="flex items-center text-sm font-bold text-white/90">
                                    <div class="w-10 h-10 rounded-xl bg-orange-500/20 flex items-center justify-center mr-4 group-hover:bg-orange-500/40 transition-colors">
                                        <i class="fas fa-phone text-xs"></i>
                                    </div>
                                    01762533535
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Noman -->
                    <div class="group relative bg-white/5 backdrop-blur-2xl p-8 rounded-[3.5rem] border border-white/10 shadow-2xl hover:bg-white/10 hover:border-indigo-500/50 transition-all duration-500 hover:-translate-y-3 animate-reveal" style="animation-delay: 0.3s">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[3.5rem]"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-8 shadow-[0_15px_30px_rgba(79,70,229,0.4)] group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">N</div>
                            <h4 class="font-black text-white text-2xl mb-6 tracking-tight">Noman</h4>
                            <div class="space-y-4">
                                <a href="mailto:noman.cse.20230104097@aust.edu" class="flex items-center text-[11px] font-bold text-indigo-200 hover:text-white transition-all duration-300">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-600/20 flex items-center justify-center mr-4 group-hover:bg-indigo-600/40 transition-colors">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </div>
                                    <span class="truncate">noman.cse.20230104097@aust.edu</span>
                                </a>
                                <div class="flex items-center text-sm font-bold text-white/90">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-600/20 flex items-center justify-center mr-4 group-hover:bg-indigo-600/40 transition-colors">
                                        <i class="fas fa-phone text-xs"></i>
                                    </div>
                                    01748606355
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Miraz -->
                    <div class="group relative bg-white/5 backdrop-blur-2xl p-8 rounded-[3.5rem] border border-white/10 shadow-2xl hover:bg-white/10 hover:border-rose-500/50 transition-all duration-500 hover:-translate-y-3 animate-reveal" style="animation-delay: 0.4s">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[3.5rem]"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-rose-500 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-8 shadow-[0_15px_30px_rgba(244,63,94,0.4)] group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">M</div>
                            <h4 class="font-black text-white text-2xl mb-6 tracking-tight">Miraz</h4>
                            <div class="space-y-4">
                                <a href="mailto:miraz.cse.20230104092@aust.edu" class="flex items-center text-[11px] font-bold text-rose-200 hover:text-white transition-all duration-300">
                                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 flex items-center justify-center mr-4 group-hover:bg-rose-500/40 transition-colors">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </div>
                                    <span class="truncate">miraz.cse.20230104092@aust.edu</span>
                                </a>
                                <div class="flex items-center text-sm font-bold text-white/90">
                                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 flex items-center justify-center mr-4 group-hover:bg-rose-500/40 transition-colors">
                                        <i class="fas fa-phone text-xs"></i>
                                    </div>
                                    01616561269
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-24 flex justify-center animate-reveal" style="animation-delay: 0.6s">
                @csrf
                <button type="button" onclick="confirmLogout(event, this.closest('form'))" 
                    class="group relative px-12 py-5 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl font-black text-xs uppercase tracking-[0.4em] text-white overflow-hidden transition-all duration-500 hover:border-white/40 hover:shadow-[0_0_50px_rgba(255,255,255,0.1)] active:scale-95">
                    <span class="relative z-10 group-hover:tracking-[0.5em] transition-all duration-500">End Administrative Session</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
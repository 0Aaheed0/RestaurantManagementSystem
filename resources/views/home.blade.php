<x-app-layout>
    <div x-data="{ sidebarOpen: false }" class="min-h-screen relative overflow-x-hidden">
        
        <div x-show="sidebarOpen" 
             style="display: none;" 
             @click="sidebarOpen = false" 
             x-transition.opacity 
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40">
        </div>

        <div x-show="sidebarOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-80 bg-white border-r border-slate-200 z-50 p-6 shadow-2xl flex flex-col h-full">
            
            <div class="flex items-center justify-between mb-8 border-b border-slate-50 pb-4 shrink-0">
                <span class="text-purple-600 font-black tracking-widest text-sm uppercase">Main Menu</span>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-purple-600 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col gap-3 overflow-y-auto pr-2 custom-scrollbar flex-1">
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Dashboard</a>
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Orders</a>
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Kitchen</a>
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Inventory</a>
                <a href="/apply-staff" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Staff</a>
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Menu Items</a>
                <a href="#" class="px-6 py-5 text-slate-700 bg-purple-50/50 hover:bg-purple-600 hover:text-white rounded-2xl transition-all font-black text-lg border-2 border-transparent hover:border-purple-400">Reports</a>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 relative z-10">
            
            <div class="flex justify-between items-center mb-10">
                <button @click="sidebarOpen = true" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-2xl flex items-center shadow-lg shadow-purple-200 transition active:scale-95 group">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-bold uppercase tracking-widest text-sm">Menu</span>
                </button>
                
                <div class="text-slate-500 font-bold text-sm bg-white px-6 py-3 rounded-full border border-slate-100 shadow-sm">
                    Sunday, February 15th
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <div class="lg:col-span-2 relative h-80 rounded-[2.5rem] bg-gradient-to-br from-purple-600 to-indigo-700 overflow-hidden shadow-2xl flex items-center p-12">
                    <div class="relative z-10 max-w-md">
                        <h2 class="text-white text-4xl font-black mb-4 tracking-tight">Streamline Your Kitchen.</h2>
                        <p class="text-purple-100 text-lg font-medium mb-6">Manage orders, staff, and inventory from one unified workspace.</p>
                        <button class="bg-white text-purple-600 px-8 py-3 rounded-xl font-black uppercase text-sm shadow-lg hover:bg-purple-50 transition">View Live Orders →</button>
                    </div>
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl flex flex-col justify-between border border-slate-800">
                    <div class="flex justify-between items-start">
                        <h3 class="text-white font-bold text-xl tracking-tighter uppercase">Today's Revenue</h3>
                        <span class="bg-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-xs font-black">+12%</span>
                    </div>
                    <div class="my-6">
                        <span class="text-white text-5xl font-black tracking-tighter">₹42,500</span>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-slate-800 p-4 rounded-2xl flex items-center justify-between border border-slate-700">
                            <span class="text-slate-400 font-bold text-sm">Active Tables</span>
                            <span class="text-white font-black text-lg">14/20</span>
                        </div>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-black text-sm transition shadow-lg">PRINT DAILY REPORT</button>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-black text-slate-800 mb-8 flex items-center">
                <span class="w-10 h-1 bg-purple-600 rounded-full mr-4"></span>
                System Modules
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-800 mb-2">POS System</h4>
                    <p class="text-slate-500 font-medium text-sm mb-6">Manage all point-of-sale operations efficiently.</p>
                    <a href="#" class="text-blue-600 font-bold text-xs uppercase tracking-widest">Open Module →</a>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-800 mb-2">Kitchen Hub</h4>
                    <p class="text-slate-500 font-medium text-sm mb-6">Manage all kitchen workflows efficiently.</p>
                    <a href="#" class="text-purple-600 font-bold text-xs uppercase tracking-widest">Open Module →</a>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-800 mb-2">Inventory</h4>
                    <p class="text-slate-500 font-medium text-sm mb-6">Manage all stock and inventory efficiently.</p>
                    <a href="#" class="text-orange-600 font-bold text-xs uppercase tracking-widest">Open Module →</a>
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
                    <div class="bg-emerald-600 text-white p-4 rounded-2xl rounded-tr-none mb-3 text-sm font-bold shadow-md">Payment: Table 12 settled ₹2,450.</div>
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
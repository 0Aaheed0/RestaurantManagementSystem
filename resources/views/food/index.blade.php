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
            backdrop-filter: blur(10px);
            z-index: -1;
            pointer-events: none;
            will-change: transform;
            transform: translateZ(0);
        }
        .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }
        @keyframes float { from { transform: translateY(0px); } to { transform: translateY(30px); } }

        .food-card {
            border: none;
            border-radius: 2rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            background: #fff;
        }
        .food-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .category-header {
            padding: 3rem 0 2rem;
            display: flex;
            align-items: center;
        }
        .category-header h2 {
            font-weight: 900;
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 0;
        }
        .category-line {
            flex: 1;
            height: 2px;
            background: rgba(124, 58, 237, 0.2);
            margin-left: 1.5rem;
        }
        .price-tag {
            color: #7c3aed;
            font-weight: 900;
            font-size: 1.25rem;
        }
    </style>

    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <!-- Notification Toast -->
    <div 
        x-data="{ 
            show: false, 
            message: '', 
            type: 'success',
            timeout: null,
            init() {
                window.addEventListener('notify', (e) => {
                    this.message = e.detail.message;
                    this.type = e.detail.type || 'success';
                    this.show = true;
                    if (this.timeout) clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => { this.show = false }, 3000);
                });
            }
        }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="fixed top-24 right-6 z-[100] pointer-events-none"
        style="display: none;"
    >
        <div 
            :class="type === 'success' ? 'border-purple-600' : 'border-red-600'"
            class="bg-white border-l-4 shadow-2xl rounded-2xl p-6 flex items-center gap-4 min-w-[300px] pointer-events-auto"
        >
            <div 
                :class="type === 'success' ? 'bg-purple-100 text-purple-600' : 'bg-red-100 text-red-600'"
                class="w-12 h-12 rounded-xl flex items-center justify-center"
            >
                <svg x-show="type === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg x-show="type === 'error'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div>
                <h4 x-text="type === 'success' ? 'Success!' : 'Not Available'" class="font-black text-slate-800 text-sm uppercase tracking-wider"></h4>
                <p x-text="message" class="text-slate-500 font-medium text-xs mt-0.5"></p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 relative z-10" x-data="{ selectedCategory: 'All' }">
        <div class="mb-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Filter Box -->
                <div class="w-full md:w-64">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-black text-sm uppercase tracking-widest hover:border-purple-600 transition-all duration-300 shadow-sm">
                            <span x-text="selectedCategory === 'All' ? 'Filter Menu' : selectedCategory"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                                                <div x-show="open" @click.away="open = false" 
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-95"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="absolute top-full left-0 w-full mt-2 bg-white rounded-2xl shadow-2xl border border-slate-100 z-[110] overflow-hidden"
                                                     style="display: none;">
                                                    <button @click="selectedCategory = 'All'; open = false" 
                                                            class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors"
                                                            :class="selectedCategory === 'All' ? 'bg-purple-50 text-purple-600' : ''">All</button>
                                                    <button @click="selectedCategory = 'Available'; open = false" 
                                                            class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors"
                                                            :class="selectedCategory === 'Available' ? 'bg-purple-50 text-purple-600' : ''">Available</button>
                                                    @foreach($categories as $categoryName => $items)
                                                        <button @click="selectedCategory = '{{ $categoryName ?: 'General' }}'; open = false" 
                                                                class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors"
                                                                :class="selectedCategory === '{{ $categoryName ?: 'General' }}' ? 'bg-purple-50 text-purple-600' : ''"
                                                                x-text="'{{ $categoryName ?: 'General' }}'"></button>
                                                    @endforeach
                                                </div>                                            </div>
                                        </div>
                                        
                                        <h1 class="text-5xl font-black text-slate-800 tracking-tight text-center">Our Menu</h1>
                                        
                                        <a href="{{ route('cart.index') }}" class="w-full md:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-white border-2 border-purple-600 text-purple-600 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-purple-600 hover:text-white transition-all duration-500 shadow-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            View Your Cart
                                        </a>
                                    </div>
                                    <div class="text-center mt-4">
                                        <p class="text-white/90 font-bold text-xl drop-shadow-md italic tracking-wide">Taste the difference with our authentic flavors.</p>
                                    </div>
                                </div>
                        
                                @foreach($categories as $categoryName => $items)
                                    <div x-show="selectedCategory === 'All' || selectedCategory === 'Available' || selectedCategory === '{{ $categoryName ?: 'General' }}'" 
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 translate-y-4"
                                         x-transition:enter-end="opacity-100 translate-y-0">
                                        <div class="category-header">
                                            <h2>{{ $categoryName ?: 'General' }}</h2>
                                            <div class="category-line"></div>
                                        </div>
                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                                            @foreach($items as $item)
                                                <div class="food-card" 
                                                     x-show="selectedCategory !== 'Available' || {{ $item->is_available ? 'true' : 'false' }}"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-95"
                                                     x-transition:enter-end="opacity-100 scale-100">
                                                    <div class="relative overflow-hidden aspect-[4/3]">                            @php
                                // Intelligent Fallback for Images without changing the DB
                                $name = strtolower($item->name);
                                $img = $item->image;
                                
                                if (!$img) {
                                    if (str_contains($name, 'burger')) $img = 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&auto=format&fit=crop&q=60';
                                    elseif (str_contains($name, 'pizza')) $img = 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&auto=format&fit=crop&q=60';
                                    elseif (str_contains($name, 'biryani') || str_contains($name, 'kacchi')) $img = 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=500&auto=format&fit=crop&q=60';
                                    elseif (str_contains($name, 'rice')) $img = 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=500&auto=format&fit=crop&q=60';
                                    elseif (str_contains($name, 'cake')) $img = 'https://images.unsplash.com/photo-1624353365286-3f8d62adda51?w=500&auto=format&fit=crop&q=60';
                                    elseif (str_contains($name, 'juice') || str_contains($name, 'lemon')) $img = 'https://images.unsplash.com/photo-1536716029108-04245647565c?w=500&auto=format&fit=crop&q=60';
                                    else $img = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&auto=format&fit=crop&q=60';
                                }
                            @endphp
                            <img 
                                src="{{ asset($img) }}" 
                                alt="{{ $item->name }}" 
                                class="w-full h-full transition-transform duration-500 hover:scale-110"
                                style="object-fit: cover;"
                                loading="lazy"
                            >
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-xl font-black text-slate-800 leading-tight">{{ $item->name }}</h4>
                                <span class="price-tag">৳{{ number_format($item->price, 0) }}</span>
                            </div>
                            <p class="text-slate-500 text-sm font-medium mb-4 line-clamp-3">{{ $item->description }}</p>
                            <div class="flex items-center gap-2 mb-6">
                                @if($item->is_available)
                                    <span class="bg-purple-50 text-purple-600 text-[10px] font-black px-2 py-1 rounded-full uppercase tracking-tighter">Available</span>
                                @else
                                    <span class="bg-red-50 text-red-600 text-[10px] font-black px-2 py-1 rounded-full uppercase tracking-tighter">Unavailable</span>
                                @endif
                                <span class="bg-orange-50 text-orange-600 text-[10px] font-black px-2 py-1 rounded-full uppercase tracking-tighter">Fresh</span>
                            </div>

                            <div x-data="{ 
                                quantity: 1,
                                isAdding: false,
                                addToCart() {
                                    if (!{{ $item->is_available ? 'true' : 'false' }}) {
                                        window.dispatchEvent(new CustomEvent('notify', { 
                                            detail: { 
                                                message: 'Sorry, {{ $item->name }} is currently unavailable.',
                                                type: 'error'
                                            } 
                                        }));
                                        return;
                                    }
                                    
                                    this.isAdding = true;
                                    const formData = new FormData();
                                    formData.append('food_item_id', '{{ $item->id }}');
                                    formData.append('quantity', this.quantity);
                                    formData.append('_token', '{{ csrf_token() }}');

                                    fetch('{{ route('cart.add') }}', {
                                        method: 'POST',
                                        body: formData,
                                        headers: { 'Accept': 'application/json' }
                                    })
                                    .then(response => {
                                        window.dispatchEvent(new CustomEvent('notify', { 
                                            detail: { message: '{{ $item->name }} added to your cart!' } 
                                        }));
                                    })
                                    .finally(() => {
                                        this.isAdding = false;
                                    });
                                }
                            }">
                                <form @submit.prevent="addToCart()">
                                    <div class="flex items-center justify-between mb-4 bg-slate-50 p-1.5 rounded-2xl gap-2">
                                        <div class="flex items-center bg-white rounded-xl shadow-sm px-1 py-1 border border-slate-100">
                                            <button type="button" @click="if(quantity > 1) quantity--" class="w-8 h-8 rounded-lg flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <input type="number" name="quantity" x-model="quantity" class="w-10 text-center bg-transparent border-none focus:ring-0 font-black text-slate-700 text-base p-0" readonly>
                                            <button type="button" @click="quantity++" class="w-8 h-8 rounded-lg flex items-center justify-center text-purple-600 hover:bg-purple-600 hover:text-white transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        <button type="submit" :disabled="isAdding" 
                                            class="flex-[2] py-3 text-white rounded-xl font-black text-[10px] uppercase tracking-widest transition-all shadow-lg disabled:opacity-50
                                            {{ $item->is_available ? 'bg-purple-600 hover:bg-purple-700 shadow-purple-200' : 'bg-red-400 hover:bg-red-500 shadow-red-100' }}">
                                            <span x-show="!isAdding">{{ $item->is_available ? 'Add to Cart' : 'Unavailable' }}</span>
                                            <span x-show="isAdding">Adding...</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>

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

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 relative z-10">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-slate-800 tracking-tight mb-4">Our Menu</h1>
            <p class="text-slate-500 font-medium text-lg">Taste the difference with our authentic flavors.</p>
        </div>

        @foreach($categories as $categoryName => $items)
            <div class="category-header">
                <h2>{{ $categoryName ?: 'General' }}</h2>
                <div class="category-line"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($items as $item)
                    <div class="food-card">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            @php
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
                                src="{{ $img }}" 
                                alt="{{ $item->name }}" 
                                class="w-full h-full transition-transform duration-500 hover:scale-110"
                                style="object-fit: cover;"
                            >
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-xl font-black text-slate-800 leading-tight">{{ $item->name }}</h4>
                                <span class="price-tag">৳{{ number_format($item->price, 0) }}</span>
                            </div>
                            <p class="text-slate-500 text-sm font-medium mb-4 line-clamp-3">{{ $item->description }}</p>
                            <div class="flex items-center gap-2">
                                <span class="bg-purple-50 text-purple-600 text-[10px] font-black px-2 py-1 rounded-full uppercase tracking-tighter">Available</span>
                                <span class="bg-orange-50 text-orange-600 text-[10px] font-black px-2 py-1 rounded-full uppercase tracking-tighter">Fresh</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>

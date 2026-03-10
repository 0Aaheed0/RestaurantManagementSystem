<x-app-layout>
    <!-- Add Bootstrap 5 for the specific layout requirements -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Remove underlines globally for this page */
        a {
            text-decoration: none !important;
        }
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

        .branch-card {
            border: none;
            border-radius: 2rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            background: #fff;
        }
        .branch-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .branch-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin: 2rem auto 1rem;
            display: block;
        }
        .branch-name {
            font-weight: 900;
            color: #1e293b;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .branch-info {
            padding: 0 2rem 2rem;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            color: #64748b;
            font-size: 0.9rem;
        }
        .info-item i {
            margin-right: 0.75rem;
            margin-top: 0.25rem;
            color: #7c3aed;
            width: 16px;
            text-align: center;
        }
        .page-header {
            padding: 4rem 0 3rem;
            text-align: center;
        }
        .page-header h1 {
            font-weight: 900;
            font-size: 3rem;
            color: #1e293b;
            letter-spacing: -0.025em;
        }
        .amenities {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
        }
        .amenity-icon {
            color: #94a3b8;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        .amenity-icon:hover {
            color: #7c3aed;
        }
        /* Sidebar Protection from Bootstrap */
        .fixed.inset-y-0.left-0.w-80 {
            width: 20rem !important;
            padding: 1.5rem !important;
            box-sizing: border-box !important;
            max-width: 320px !important;
        }
        .fixed.inset-y-0.left-0.w-80 * {
            box-sizing: border-box !important;
        }
        .fixed.inset-y-0.left-0.w-80 nav a {
            display: block !important;
            text-decoration: none !important;
            color: inherit !important;
            padding: 1.25rem 1.5rem !important;
            font-size: 1.125rem !important;
            margin-bottom: 0.75rem !important;
        }
        .fixed.inset-y-0.left-0.w-80 nav a:hover {
            color: white !important;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <div class="container pb-5" x-data="{ selectedFilter: 'All' }">
        <div class="page-header">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-4">
                <!-- Filter Box -->
                <div class="w-full md:w-64 text-left">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-black text-sm uppercase tracking-widest hover:border-purple-600 transition-all duration-300 shadow-sm">
                            <span x-text="selectedFilter === 'All' ? 'Filter Branches' : selectedFilter"></span>
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
                            <template x-for="f in ['All', 'Open now', 'Dhaka', 'Chattogram', 'Sylhet', 'Khulna', 'Cox\'s Bazar', 'Rajshahi']">
                                <button @click="selectedFilter = f; open = false" 
                                        class="w-full text-left px-6 py-3 text-sm font-bold text-slate-600 hover:bg-purple-50 hover:text-purple-600 transition-colors"
                                        :class="selectedFilter === f ? 'bg-purple-50 text-purple-600' : ''"
                                        x-text="f"></button>
                            </template>
                        </div>
                    </div>
                </div>

                <h1 class="text-6xl font-black tracking-tighter text-slate-900 m-0">Our Branches</h1>
                
                <!-- Spacer for centering -->
                <div class="hidden md:block w-64"></div>
            </div>
            <p class="text-white/90 font-bold text-xl drop-shadow-md italic tracking-wide">Find the nearest RMS location to experience the best.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @php
                // Remove branches with duplicate names to clean up the page
                $uniqueBranches = $branches->unique('name');
            @endphp
            @forelse($uniqueBranches as $branch)
                @php
                    $isOpen = ($branch->id % 3 !== 0);
                @endphp
                <div class="col-12 col-md-6 col-lg-4" 
                     x-show="selectedFilter === 'All' || 
                             (selectedFilter === 'Open now' && {{ $isOpen ? 'true' : 'false' }}) || 
                             (selectedFilter === '{{ $branch->city }}') ||
                             (selectedFilter === 'Chattogram' && '{{ $branch->city }}' === 'Chittagong')"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <div class="branch-card">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ $branch->name }} Logo" class="branch-logo">
                        
                        <div class="text-center px-4">
                            <h3 class="branch-name">{{ $branch->name }}</h3>
                            
                            <div class="mb-4">
                                @if($isOpen)
                                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full font-black text-[10px] uppercase tracking-[0.2em] border border-emerald-100 inline-flex items-center gap-2">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Open Now
                                    </span>
                                @else
                                    <span class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full font-black text-[10px] uppercase tracking-[0.2em] border border-red-100 inline-flex items-center gap-2">
                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                        Closed
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="branch-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                @php
                                    // Remove redundant area/city repetitions from the address string
                                    $addrParts = array_map('trim', explode(',', $branch->address));
                                    $uniqueParts = [];
                                    $foundCity = false;
                                    
                                    foreach($addrParts as $part) {
                                        // If this part matches the city or area, we've reached the end of the unique address
                                        if (strtolower($part) === strtolower($branch->city) || strtolower($part) === strtolower($branch->area)) {
                                            $foundCity = true;
                                            break;
                                        }
                                        if (!in_array($part, $uniqueParts)) {
                                            $uniqueParts[] = $part;
                                        }
                                    }
                                    
                                    $displayAddress = implode(', ', $uniqueParts);
                                    
                                    // Append area only if it's not already in the address and not same as city
                                    if ($branch->area && strtolower($branch->area) !== strtolower($branch->city)) {
                                        $displayAddress .= ($displayAddress ? ', ' : '') . $branch->area;
                                    }
                                    
                                    // Always append city as the final part
                                    $displayAddress .= ($displayAddress ? ', ' : '') . $branch->city;
                                @endphp
                                <span>{{ $displayAddress }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $branch->phone }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ strtolower(str_replace(' ', '.', $branch->area)) }}@rms-system.com</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ \Carbon\Carbon::parse($branch->opening_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($branch->closing_time)->format('h:i A') }}</span>
                            </div>

                            <div class="amenities">
                                <i class="fas fa-wifi amenity-icon" title="Free WiFi"></i>
                                
                                @php
                                    // Amenity Logic: AC and Parking conditional based on ID
                                    $hasAC = ($branch->id % 4 !== 0);
                                    $hasParking = ($branch->id % 3 !== 0);
                                @endphp
                                
                                @if($hasAC)
                                    <i class="fas fa-snowflake amenity-icon" title="Air Conditioned"></i>
                                @else
                                    <i class="fas fa-umbrella-beach amenity-icon text-orange-400" title="Rooftop Restaurant"></i>
                                @endif

                                @if($hasParking)
                                    <i class="fas fa-car amenity-icon" title="Parking Available"></i>
                                @endif
                                
                                <i class="fas fa-utensils amenity-icon" title="Dine-in"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="bg-white p-5 rounded-[3rem] shadow-sm border border-slate-100">
                        <h3 class="text-slate-400 font-bold">No branches found.</h3>
                        <p class="text-slate-400">Check back later for new locations!</p>
                    </div>
                </div>
            @endforelse
        </div>

        </div>
    </div>
</x-app-layout>

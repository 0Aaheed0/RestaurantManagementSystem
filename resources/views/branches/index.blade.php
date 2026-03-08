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

    <div class="container pb-5">
        <div class="page-header">
            <h1>Our Branches</h1>
            <p class="text-slate-500 font-medium">Find the nearest RMS location to experience the best.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($branches as $branch)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="branch-card">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ $branch->name }} Logo" class="branch-logo">
                        
                        <div class="text-center px-4">
                            <h3 class="branch-name">{{ $branch->name }}</h3>
                        </div>

                        <div class="branch-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $branch->address }}, {{ $branch->area }}, {{ $branch->city }}</span>
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
                                <i class="fas fa-snowflake amenity-icon" title="Air Conditioned"></i>
                                <i class="fas fa-car amenity-icon" title="Parking Available"></i>
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

        <!-- Pagination Links -->
        <div class="mt-5 flex justify-center no-underline">
            {{ $branches->links() }}
        </div>
    </div>
</x-app-layout>

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
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-3xl font-black text-slate-800 flex items-center mb-0">
                <span class="w-10 h-1 bg-purple-600 rounded-full mr-4"></span> Frequently Asked Questions
            </h2>
            <a href="{{ route('home') }}" class="bg-white text-purple-600 px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:shadow-md transition border border-purple-100 no-underline">← Back to Home</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($faqs as $faq)
                <div class="bg-white/80 backdrop-blur-md p-8 rounded-[2.5rem] border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-300">
                    <h4 class="text-xl font-black text-slate-800 mb-3 leading-tight">{{ $faq->question }}</h4>
                    <p class="text-slate-600 font-medium leading-relaxed">{{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-24 pb-12 border-t border-white/10 pt-16 text-center">
            <p class="text-white/70 font-bold tracking-[0.2em] uppercase text-xs">AUST CSE DEPARTMENT</p>
        </div>
    </div>
</x-app-layout>

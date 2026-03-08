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

        .glass-card, .bg-white.rounded-lg.overflow-hidden.shadow-xl {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2) !important;
            color: white !important;
            width: 500px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        .glass-card h2, .glass-card p, .glass-card label, 
        .bg-white.rounded-lg.overflow-hidden.shadow-xl h2, 
        .bg-white.rounded-lg.overflow-hidden.shadow-xl p, 
        .bg-white.rounded-lg.overflow-hidden.shadow-xl label {
            color: white !important;
        }
        .glass-card input, .bg-white.rounded-lg.overflow-hidden.shadow-xl input {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.4) !important;
            color: white !important;
            border-radius: 12px !important;
        }
        .glass-card input::placeholder, .bg-white.rounded-lg.overflow-hidden.shadow-xl input::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        /* Style primary and secondary buttons */
        .glass-card button:not(.bg-red-600):not(.text-red-600):not(.bg-red-500),
        .bg-white.rounded-lg.overflow-hidden.shadow-xl button:not(.bg-red-600):not(.text-red-600):not(.bg-red-500) {
            background: white !important;
            color: #5f0f9c !important;
            font-weight: 600 !important;
            border-radius: 30px !important;
            border: none !important;
            transition: 0.3s ease !important;
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }
        .glass-card button:not(.bg-red-600):not(.text-red-600):not(.bg-red-500):hover,
        .bg-white.rounded-lg.overflow-hidden.shadow-xl button:not(.bg-red-600):not(.text-red-600):not(.bg-red-500):hover {
            background: #5f0f9c !important;
            color: white !important;
        }
        .glass-card .text-gray-600, .bg-white.rounded-lg.overflow-hidden.shadow-xl .text-gray-600 {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        /* Keep danger buttons red but modern */
        .bg-red-600, .bg-red-500 {
            border-radius: 30px !important;
            font-weight: 600 !important;
        }
        /* Password Box Styling */
        .password-box { position: relative; }
        .password-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: white;
            opacity: 0.7;
            z-index: 20;
        }
        .password-box i:hover { opacity: 1; }
    </style>

    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            if (field) {
                field.type = field.type === 'password' ? 'text' : 'password';
            }
        }
    </script>

    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="shape shape3"></div>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-white uppercase tracking-widest">Account Settings</h1>
            </div>
            <div class="p-4 sm:p-8 glass-card sm:rounded-2xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 glass-card sm:rounded-2xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 glass-card sm:rounded-2xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

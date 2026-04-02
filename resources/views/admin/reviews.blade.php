<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews Management | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #2d004d, #5f0f9c, #9d4edd) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="font-sans antialiased text-white">
    <h1 class="text-6xl font-black mb-12 tracking-tight">Reviews Management</h1>
    <a href="{{ route('admin.dashboard') }}" class="bg-white text-purple-700 px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-2xl hover:bg-purple-50 transition-all active:scale-95 no-underline">
        Back to Dashboard
    </a>
</body>
</html>

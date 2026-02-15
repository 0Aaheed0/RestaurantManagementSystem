<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Restaurant Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            overflow-x: hidden;
        }

        /* Floating Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: 1;
        }

        .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }

        @keyframes float { from { transform: translateY(0px); } to { transform: translateY(30px); } }

        /* Glass Card */
        .glass-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 60px 80px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            margin: 50px auto 80px auto;
            max-width: 600px;
            position: relative;
            z-index: 2;
        }

        .logo { font-size: 50px; margin-bottom: 20px; color: white; }
        .big-title { font-size: 45px; font-weight: 800; letter-spacing: 2px; }
        .normal-text { font-size: 20px; margin: 10px 0; }
        .btn {
            margin-top: 40px;
            padding: 14px 40px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .btn:hover { background: #5f0f9c; color: white; }

        /* Modal */
        .modal {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0; pointer-events: none;
            transition: 0.3s ease;
            z-index: 999;
        }
        .modal.active { opacity: 1; pointer-events: auto; }
        .modal-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transform: scale(0.8);
            transition: 0.3s ease;
            width: 300px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .modal.active .modal-box { transform: scale(1); }
        .modal-box a {
            display: block; margin: 15px 0; padding: 12px;
            background: white; color: #5f0f9c;
            border-radius: 30px; text-decoration: none;
            font-weight: 600; transition: 0.3s ease;
        }
        .modal-box a:hover { background: #5f0f9c; color: white; }
        .close { margin-top: 15px; cursor: pointer; color: white; }
        .close:hover { opacity: 0.7; }

        /* About Section */
        #about {
            text-align: center;
            padding: 60px 20px;
            color: #5f0f9c;
        }
        #about h2 { font-size: 40px; margin-bottom: 20px; }
        #about p { font-size: 18px; max-width: 700px; margin: 0 auto; line-height: 1.6; }

        /* Features Section */
        #features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 60px 20px;
            background: #f7f7f7;
        }
        .feature-card {
            background: white;
            color: #5f0f9c;
            border-radius: 20px;
            padding: 30px 20px;
            width: 250px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .feature-card i { font-size: 40px; margin-bottom: 15px; }

        /* Footer */
        footer {
            text-align: center;
            padding: 40px 20px;
            background: #5f0f9c;
            color: white;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<!-- Main Glass Hero -->
<div class="glass-container">
    <div class="logo">
        <i class="fa-solid fa-utensils"></i>
    </div>
    <div class="big-title">WELCOME TO OUR WORLD</div>
    <div class="normal-text">EXPERIENCE THE BEST</div>
    <div class="big-title">RESTAURANT MANAGEMENT SYSTEM</div>
    <p style="margin-top: 15px; font-size: 18px; font-weight: 500;">
        Simplify your restaurant operations, delight your customers, and make every meal memorable.
    </p>
    <button class="btn" onclick="openModal()">Get Started</button>
</div>

<!-- Modal -->
<div class="modal" id="modal">
    <div class="modal-box">
        <a href="{{ route('login') }}">LOGIN</a>
        <a href="{{ route('register') }}">SIGN UP</a>
        <div class="close" onclick="closeModal()">Cancel</div>
    </div>
</div>

<!-- About Section -->
<section id="about">
    <h2>About Us</h2>
    <p>
        Our Restaurant Management System helps you manage your orders, tables, and menu with ease.
        Enjoy a seamless experience for both staff and customers. Fast, simple, and reliable.
    </p>
</section>

<!-- Features Section -->
<section id="features">
    <div class="feature-card">
        <i class="fa-solid fa-bell-concierge"></i>
        <h3>Order Management</h3>
        <p>Track and manage customer orders efficiently.</p>
    </div>
    <div class="feature-card">
        <i class="fa-solid fa-table"></i>
        <h3>Table Reservation</h3>
        <p>Reserve tables quickly and avoid conflicts.</p>
    </div>
    <div class="feature-card">
        <i class="fa-solid fa-utensils"></i>
        <h3>Menu Control</h3>
        <p>Add, edit, or remove menu items with ease.</p>
    </div>
</section>

<!-- Footer -->
<footer>
    &copy; 2026 Restaurant Management System. All rights reserved.
</footer>

<script>
    function openModal() {
        document.getElementById('modal').classList.add('active');
    }
    function closeModal() {
        document.getElementById('modal').classList.remove('active');
    }
</script>

</body>
</html>

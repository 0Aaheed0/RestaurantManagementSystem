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
            height: 100vh;
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Floating Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
        }

        .shape1 {
            width: 300px;
            height: 300px;
            top: -50px;
            left: -50px;
        }

        .shape2 {
            width: 200px;
            height: 200px;
            bottom: -40px;
            right: -40px;
            animation-delay: 2s;
        }

        .shape3 {
            width: 150px;
            height: 150px;
            bottom: 150px;
            left: 200px;
            animation-delay: 4s;
        }

        @keyframes float {
            from { transform: translateY(0px); }
            to { transform: translateY(30px); }
        }

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
            animation: fadeIn 1.5s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            font-size: 50px;
            margin-bottom: 20px;
            color: white;
        }

        .big-title {
            font-size: 45px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .normal-text {
            font-size: 20px;
            margin: 10px 0;
        }

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

        .btn:hover {
            background: #5f0f9c;
            color: white;
        }

        /* Modal */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }

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

        .modal.active .modal-box {
            transform: scale(1);
        }

        .modal-box a {
            display: block;
            margin: 15px 0;
            padding: 12px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .modal-box a:hover {
            background: #5f0f9c;
            color: white;
        }

        .close {
            margin-top: 15px;
            cursor: pointer;
            color: white;
        }

        .close:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="glass-container">
    <div class="logo">
        <i class="fa-solid fa-utensils"></i>
    </div>

    <div class="big-title">WELCOME</div>
    <div class="normal-text">TO</div>
    <div class="big-title">RESTAURANT MANAGEMENT SYSTEM</div>

    <button class="btn" onclick="openModal()">Get Started</button>
</div>

<div class="modal" id="modal">
    <div class="modal-box">
        <a href="{{ route('login') }}">LOGIN</a>
        <a href="{{ route('register') }}">SIGN UP</a>
        <div class="close" onclick="closeModal()">Cancel</div>
    </div>
</div>

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

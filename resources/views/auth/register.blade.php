<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | Restaurant Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .shape { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.1); animation: float 8s infinite ease-in-out alternate; backdrop-filter: blur(20px); }
        .shape1 { width: 200px; height: 200px; top: -50px; left: -30px; }
        .shape2 { width: 150px; height: 150px; bottom: -40px; right: 50px; animation-delay: 2s; }
        .shape3 { width: 100px; height: 100px; top: 150px; right: 200px; animation-delay: 4s; }

        @keyframes float { from{transform:translateY(0);} to{transform:translateY(25px);} }

        .glass-card {
            background: rgba(255,255,255,0.15);
            padding: 50px 40px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: fadeIn 1.2s ease forwards;
            opacity: 0;
            width: 380px;
        }

        @keyframes fadeIn { to { opacity:1; transform: translateY(0); } }

        .logo { font-size: 50px; margin-bottom: 15px; color: white; }

        h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; }

        input {
            width: 100%;
            padding: 12px 38px 12px 14px;
            margin-bottom: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.1);
            color: white;
            outline: none;
        }
        input::placeholder { color: rgba(255,255,255,0.7); }

        .password-box { position: relative; }
        .password-box i { position: absolute; right: 12px; top: 13px; cursor: pointer; color: white; opacity:0.7; }
        .password-box i:hover { opacity:1; }

        button {
            width: 100%;
            padding: 12px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }
        button:hover { background: #5f0f9c; color: white; }

        .link { margin-top: 15px; font-size: 14px; }
        .link a { color: white; font-weight: 600; text-decoration: none; }
        .link a:hover { opacity: 0.8; }

        .error { background: rgba(255,0,0,0.1); color: #ffcccc; border-radius: 8px; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="glass-card">
    <div class="logo"><i class="fa-solid fa-utensils"></i></div>
    <h2>Create Account</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>

        <div class="password-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class="fas fa-eye" onclick="togglePass('password')"></i>
        </div>

        <div class="password-box">
            <input type="password" id="confirm" name="password_confirmation" placeholder="Confirm Password" required>
            <i class="fas fa-eye" onclick="togglePass('confirm')"></i>
        </div>

        <button type="submit">SIGN UP</button>
    </form>

    <div class="link">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </div>
</div>

<script>
    function togglePass(id) {
        const field = document.getElementById(id);
        field.type = field.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>

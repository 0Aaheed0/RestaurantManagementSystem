<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Report | Restaurant Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            position: relative;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
        }
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
            width: 450px;
            margin: 50px 0;
        }

        @keyframes fadeIn { to { opacity:1; transform: translateY(0); } }

        .logo { font-size: 50px; margin-bottom: 15px; color: white; }

        h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; }

        input, textarea {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.1);
            color: white;
            outline: none;
        }

        input::placeholder, textarea::placeholder { color: rgba(255,255,255,0.7); }
        
        textarea { resize: vertical; }

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
            margin-top: 10px;
        }
        button:hover { background: #5f0f9c; color: white; }
    </style>
</head>
<body>

<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>

<div class="glass-card">
    <div class="logo"><i class="fa-solid fa-file-alt"></i></div>
    <h2>Submit a Report</h2>

    <form id="report-form" method="POST" action="{{ route('report.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Title" required autofocus>
        <textarea name="description" placeholder="Description" rows="4" required></textarea>
        <input type="text" name="customer_name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Email (Optional)">
        <input type="text" name="phone" placeholder="Phone (Optional)">

        <button type="submit">SUBMIT REPORT</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('report-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.success,
                    background: 'rgba(255,255,255,0.95)',
                    confirmButtonColor: '#5f0f9c',
                }).then(() => {
                    window.location.reload();
                });
            } else {
                 Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: 'Something went wrong.',
                    background: 'rgba(255,255,255,0.95)',
                    confirmButtonColor: '#5f0f9c',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Submission Failed',
                text: 'An error occurred. Please try again.',
                background: 'rgba(255,255,255,0.95)',
                confirmButtonColor: '#5f0f9c',
            });
        });
    });
</script>

</body>
</html>

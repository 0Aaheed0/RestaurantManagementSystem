<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .staff-page-root {
            font-family: 'Poppins', sans-serif;
            min-height: calc(100vh - 96px);
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 40px 20px;
        }

        .staff-page-root .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float-staff 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: 0;
        }
        .staff-page-root .shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .staff-page-root .shape2 { width: 200px; height: 200px; bottom: -40px; right: -40px; animation-delay: 2s; }
        .staff-page-root .shape3 { width: 150px; height: 150px; bottom: 150px; left: 200px; animation-delay: 4s; }

        @keyframes float-staff { from{transform:translateY(0);} to{transform:translateY(25px);} }

        .staff-page-root .glass-card {
            background: rgba(255,255,255,0.15);
            padding: 50px 40px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: fadeInStaff 1.2s ease forwards;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInStaff { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }

        .staff-page-root .logo-icon { font-size: 50px; margin-bottom: 15px; color: white; }

        .staff-page-root h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; color: white !important; border:none; }

        .staff-page-root input, .staff-page-root textarea, .staff-page-root select {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.1);
            color: white;
            outline: none;
            appearance: auto;
        }

        .staff-page-root select option {
            background-color: #5f0f9c;
            color: white;
        }

        .staff-page-root input::placeholder, .staff-page-root textarea::placeholder { color: rgba(255,255,255,0.7); }

        .staff-page-root textarea { resize: vertical; }
        
        .staff-page-root button {
            width: 100%;
            padding: 14px;
            background: white;
            color: #5f0f9c;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .staff-page-root button:hover { background: #5f0f9c; color: white; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
    </style>

    <div class="staff-page-root">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>

        <div class="glass-card">
            <div class="logo-icon"><i class="fa-solid fa-user-plus"></i></div>
            <h2>Apply for Staff</h2>

            <form id="staff-application-form" action="/apply-staff" method="POST">
                @csrf
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="phone" placeholder="Phone Number">
                <select name="position" required>
                    <option value="" disabled selected>Position Applied For</option>
                    <option value="Waiter">Waiter</option>
                    <option value="Manager">Manager</option>
                    <option value="Chef">Chef</option>
                    <option value="Cashier">Cashier</option>
                    <option value="Security Guard">Security Guard</option>
                </select>
                <textarea name="experience" placeholder="Relevant Experience" rows="4"></textarea>

                <button type="submit">SUBMIT APPLICATION</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('staff-application-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
</x-app-layout>
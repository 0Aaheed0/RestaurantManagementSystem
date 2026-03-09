<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Scoped to avoid affecting the navbar/sidebar */
        .review-container-root {
            font-family: 'Poppins', sans-serif;
            min-height: calc(100vh - 96px); /* Subtracting navbar height */
            background: linear-gradient(135deg, #5f0f9c, #9d4edd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 40px 20px;
        }

        .review-container-root .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float-review 8s infinite ease-in-out alternate;
            backdrop-filter: blur(20px);
            z-index: 0;
        }
        .review-container-root .shape1 { width: 200px; height: 200px; top: -50px; left: -30px; }
        .review-container-root .shape2 { width: 150px; height: 150px; bottom: -40px; right: 50px; animation-delay: 2s; }
        .review-container-root .shape3 { width: 100px; height: 100px; top: 150px; right: 200px; animation-delay: 4s; }

        @keyframes float-review { from{transform:translateY(0);} to{transform:translateY(25px);} }

        .review-container-root .glass-card {
            background: rgba(255,255,255,0.15);
            padding: 50px 40px;
            border-radius: 25px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            color: white;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: fadeInReview 1.2s ease forwards;
            opacity: 0;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInReview { to { opacity:1; transform: translateY(0); } }

        .review-container-root .logo-icon { font-size: 50px; margin-bottom: 15px; color: white; }

        .review-container-root h2 { font-size: 28px; margin-bottom: 25px; font-weight: 700; color: white !important; }

        .review-container-root label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            padding-left: 5px;
        }

        .review-container-root input, 
        .review-container-root textarea, 
        .review-container-root select {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.1);
            color: white;
            outline: none;
            transition: 0.3s ease;
        }

        .review-container-root select option {
            background: #5f0f9c;
            color: white;
        }

        .review-container-root input::placeholder, 
        .review-container-root textarea::placeholder { 
            color: rgba(255,255,255,0.7); 
        }
        
        .review-container-root textarea { resize: vertical; }

        .review-container-root button {
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
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .review-container-root button:hover { 
            background: #5f0f9c; 
            color: white; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
    </style>

    <div class="review-container-root">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>

        <div class="glass-card">
            <div class="logo-icon"><i class="fa-solid fa-star-half-stroke"></i></div>
            <h2>Leave a Review</h2>

            <form id="review-form" method="POST" action="{{ route('review.store') }}">
                @csrf
                
                <label for="food_item_id">Dish to Review</label>
                <select name="food_item_id" id="food_item_id" required>
                    <option value="" disabled selected>Select a dish...</option>
                    @foreach($foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                    @endforeach
                </select>

                <label for="rating">Rating</label>
                <select name="rating" id="rating" required>
                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4">⭐⭐⭐⭐ (4)</option>
                    <option value="3">⭐⭐⭐ (3)</option>
                    <option value="2">⭐⭐ (2)</option>
                    <option value="1">⭐ (1)</option>
                </select>

                <label for="review">Your Review</label>
                <textarea name="review" id="review" placeholder="How was the food? (Review as: {{ Auth::user()->name }})" rows="4" required></textarea>

                <button type="submit">SUBMIT REVIEW</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('review-form').addEventListener('submit', function(e) {
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
</x-app-layout>
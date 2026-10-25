<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muscle Core Gym</title>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}" />

    <style>
        @keyframes change {
            0% {
                background-image: url('{{ asset('images/GYM.jpg') }}');
            }

            50% {
                background-image: url('{{ asset('images/gym2.jpg') }}');
            }

            100% {
                background-image: url('{{ asset('images/gym3.jpg') }}');
            }
        }

        .middle {
            height: 860px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            animation: change 10s infinite ease-in-out;
        }
    </style>
</head>

<body>
    <nav class="nav">
        <div class="navbar-container">
            <div class="navl">
                <img class="logo" src="images/mcg.jpg" alt="Logo" />
                <ul class="menu">
                    <li><a href="/account/dashboard">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="/whyus">Why us</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="navr">
                <ul class="menu">
                    <li><a href="/login">Logout</a></li>
                    <!-- <li><a href="/register" class="signup">Signup</a></li> -->
                </ul>
            </div>
            <div class="toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="menu-text">Menu</span>
            </div>
        </div>
    </nav>

    <div class="middle" style="background-image: url('images/GYM.jpg')">
        <div class="typing-container">
            <div class="typing-text"></div>
        </div>
    </div>
    <!-- plan Section  -->
    <div class="checkout-container" style="padding: 10px ; margin-top: 30px; margin-bottom: 20px;">
        <h2 style="background-color: white">Confirm Your Subscription</h2>
        <form action="{{ route('subscription.store') }}" method="POST" style="padding: 10px 10px">
    @csrf

    <label style="color: white" for="name">Full Name</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required />

    <label style="color: white" for="contact">Contact Number</label>
    <input type="text" id="contact" name="contact" placeholder="Contact Number" required />

    <label style="color: white" for="email">Email Address</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required />

    <label style="color: white" for="plan">
        Choosed Plan: {{ request()->query('plan') }} - RS {{ request()->query('price') }}/month
    </label>

    <!-- ✅ Hidden inputs to send plan and price -->
    <input type="hidden" name="plan" value="{{ request()->query('plan') }}">
    <input type="hidden" name="price" value="{{ request()->query('price') }}">

    <label style="color: white">Payment Method</label>
    <div class="payment-methods">
        <label><input type="radio" name="payment" value="On Hand" checked /> On Hand</label>
        <label><input type="radio" name="payment" value="Easypaisa" /> Easypaisa</label>
    </div>

    <button type="submit" class="btn">Proceed to Payment</button>
</form>

@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

    </div>

    <hr class="line" />
    <!-- Feedback Section -->

    <div class="container">
        <div class="info-section">
            <h2>Muscle Core Gym</h2>
            <p>
                Muscle Core Gym is the best gym for ladies & gents located in
                Rawalpindi, Pakistan...
            </p>
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#"><img src="images/facebook.png" alt="" /></a>
                <a href="#"><img src="images/youtube.png" alt="" /></a>
                <a href="#"><img src="images/insta.png" alt="" /></a>
                <a href="#"><img src="images/linkedin.png" alt="" /></a>
            </div>
        </div>

        <div class="links-section">
            <h2>Useful Links</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Classes</a></li>
                <li><a href="#">Trainers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>

        <div class="hours-section">
            <h2>Opening Hours</h2>
            <div class="branches">
                <span>Rawalpindi</span>
            </div>
            <ul class="timing">
                <li>Monday 06:00 AM - 11:00 PM</li>
                <li>Tuesday 06:00 AM - 11:00 PM</li>
                <li>Wednesday 06:00 AM - 11:00 PM</li>
                <li>Thursday 06:00 AM - 11:00 PM</li>
                <li>Friday 06:00 AM - 11:00 PM</li>
                <li>Saturday 09:00 AM - 10:00 PM</li>
            </ul>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muscle Core Gym</title>
    <link rel="stylesheet" href="{{ asset('css/trainer.css') }}" />

    <style>
        @keyframes change {
            0% {
                background-image: url("images/GYM.jpg");
            }

            50% {
                background-image: url("images/gym2.jpg");
            }

            100% {
                background-image: url("images/gym3.jpg");
            }
        }

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
                <img class="logo" src="{{ asset('images/mcg.jpg') }}" alt="Logo" />
                <ul class="menu">
                    <li><a href="/">Home</a></li>
                                 @auth
    @if(Auth::user()->role === 'customer')
        <li><a href="{{ route('account.dashboard') }}">Dashboard</a></li>
    @endif
@endauth            
                    @auth
    @if(Auth::user()->role === 'trainer')
        <li><a href="{{ route('trainer.dashboard') }}">Dashboard</a></li>
    @endif
@endauth  
                    <li><a href="#">Services</a></li>
                    <li><a href="/whyus">Why us</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="navr">
                <ul class="menu">
                    <li><a href="{{ route('trainer.logout') }}">Logout</a></li>
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
    <!-- Classes Section -->
   @if(Auth::user()->role === 'trainer')
<section>
    <div class="trainer-schedule-container">
        <div class="trainer-schedule-heading">Our Gym Classes</div>

        <div class="trainer-class-block" onclick="toggleClass(this)">
            HIIT Training
            <span class="trainer-arrow">&#9660;</span>
        </div>
        <div class="trainer-class-details">
            <div class="trainer-name">Trainer: {{ Auth::user()->name }}</div>
            <p style="padding: 5px"><strong>Time:</strong> 9:00 AM - 10:00 AM</p>
            <p style="padding: 5px"><strong>Date:</strong> Monday, June 3, 2025</p>
            <button class="trainer-class-button"
                onclick="markAttendance('HIIT Training', '{{ Auth::user()->name }}', '2025-06-03', '09:00:00')">
                Mark Attendance
            </button>
        </div>

        <div class="trainer-class-block" onclick="toggleClass(this)">
            Yoga & Flexibility
            <span class="trainer-arrow">&#9660;</span>
        </div>
        <div class="trainer-class-details">
            <div class="trainer-name">Trainer: {{ Auth::user()->name }}</div>
            <p style="padding: 5px"><strong>Time:</strong> 11:30 AM - 12:30 PM</p>
            <p style="padding: 5px"><strong>Date:</strong> Wednesday, June 5, 2025</p>
            <button class="trainer-class-button"
                onclick="markAttendance('Yoga & Flexibility', '{{ Auth::user()->name }}', '2025-06-05', '11:30:00')">
                Mark Attendance
            </button>
        </div>

        <div class="trainer-class-block" onclick="toggleClass(this)">
            Strength & Conditioning
            <span class="trainer-arrow">&#9660;</span>
        </div>
        <div class="trainer-class-details">
            <div class="trainer-name">Trainer: {{ Auth::user()->name }}</div>
            <p style="padding: 5px"><strong>Time:</strong> 5:00 PM - 6:00 PM</p>
            <p style="padding: 5px"><strong>Date:</strong> Friday, June 7, 2025</p>
            <button class="trainer-class-button"
                onclick="markAttendance('Strength & Conditioning', '{{ Auth::user()->name }}', '2025-06-07', '17:00:00')">
                Mark Attendance
            </button>
        </div>

    </div>
</section>
@endif

    <script>
    function markAttendance(className, trainerName, classDate, classTime) {
        fetch("{{ route('attendance.mark') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                class_name: className,
                trainer_name: trainerName,
                class_date: classDate,
                class_time: classTime
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>


    <!-- Equipment Section -->
    <section class="equipment-section">
        <h2>Our Gym Equipments 🏋️</h2>
        <div class="equipment-grid">
            <div class="equipment-card equipment-card1">
                <img src="{{ asset('images/treadmail-img.avif') }}" alt="Treadmill" />
                <h3>Treadmill</h3>
                <p>
                    Perfect for cardio workouts with adjustable speeds and incline
                    settings.
                </p>
            </div>
            <div class="equipment-card equipment-card2">
                <img src="{{ asset('images/dumbels.avif') }}" alt="Dumbbells" />
                <h3>Dumbbells</h3>
                <p>
                    Ideal for strength training, muscle toning, and resistance workouts.
                </p>
            </div>
            <div class="equipment-card equipment-card3">
                <img src="{{ asset('images/leg-press-img.avif') }}" alt="Leg Press" />

                <h3>Leg Press Machine</h3>
                <p>
                    Targets quads, hamstrings, and glutes effectively with heavy loads.
                </p>
            </div>
            <div class="equipment-card equipment-card4">
                <img src="{{ asset('images/bench-press-img.avif') }}" alt="Bench Press" />

                <h3>Bench Press</h3>
                <p>
                    Strengthen your chest and triceps with flat and incline bench
                    options.
                </p>
            </div>
            <div class="equipment-card equipment-card5">
                <img src="{{ asset('images/rowing-mechine-img.avif') }}" alt="Rowing Machine" />

                <h3>Rowing Machine</h3>
                <p>
                    Great for full-body cardio and endurance training with low impact on
                    joints.
                </p>
            </div>

            <div class="equipment-card equipment-card6">
                <img src="{{ asset('images/kettlebell-img-2.avif') }}" alt="Kettlebell Set" />

                <h3>Kettlebell Set</h3>
                <p>
                    Boost strength, agility, and coordination with versatile functional
                    workouts.
                </p>
            </div>
        </div>
    </section>

    <!-- Members Section -->

    <section>
        <div class="member-section">
            <div class="section-heading" style="margin-top: 3rem">
                Our Gym Members
            </div>

            <div style="background-color: gray; color: white" class="dropdown-card" onclick="toggleMembers()">
                View Members
                <span style="background-color: gray" id="arrow" class="toggle-arrow">▼</span>
            </div>

            <div id="memberList" class="member-list">
                @foreach ($members as $member)
                    <div class="member-item" style="background-color: gray; padding: 8px; margin-bottom: 10px;">
                        <div class="member-name" style="background-color: gray; color: white; font-weight: bold;">
                            {{ $member->name }}
                        </div>
                        <div class="member-details" style="background-color: gray; color: white;">
                            Email: {{ $member->email }} |
                            Phone: {{ $member->contact }} |
                            Joined: {{ $member->created_at->format('M Y') }} |
                            Status: Active
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Feedback Section -->
    <section>
        <div class="user-feedback-section" style="margin-bottom: 4rem">
            <div class="user-feedback-title" style="margin-top: 3rem">
                Users Feedback
            </div>
            <div class="feedback-grid">
                @foreach ($feedbacks as $feedback)
                    <div class="user-feedback-card"
                        style="background-color: white; padding: 15px; margin-bottom: 20px;">
                        <div class="member-name" style="background-color: white; font-size: 30px;">
                            {{ $feedback->name }}
                        </div>
                        <div class="feedback-date" style="background-color: white; font-size: 18px;">
                            Submitted: {{ $feedback->created_at->format('F d, Y') }}
                        </div>
                        <div class="feedback-content" style="background-color: white;">
                            {{ $feedback->message }}
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <div class="container">
        <div class="info-section">
            <h2 style="text-align: start">Muscle Core Gym</h2>
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
            <h2 style="text-align: start">Useful Links</h2>
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
            <h2 style="text-align: start">Opening Hours</h2>
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
    <script>
        function toggleClass(element) {
            element.classList.toggle("active");
        }
    </script>
    <script>
        function toggleMembers() {
            const list = document.getElementById("memberList");
            const arrow = document.getElementById("arrow");
            list.style.display = list.style.display === "block" ? "none" : "block";
            arrow.classList.toggle("rotate");
        }
    </script>
</body>

</html>

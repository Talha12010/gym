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

.faq-container {
    max-width: 95%;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr;
    row-gap: 30px; 
    padding : 10px;
    background: transparent;
  }

  .faq-item {
    background: transparent;;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(255, 215, 0, 0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  .faq-item:hover {
    box-shadow: 0 4px 20px rgba(255, 215, 0, 0.3);
    transform: translateY(-3px);
  }

  .faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 20px 25px;
    font-weight: bold;
    font-size: 1.2em;
    transition: background-color 0.3s ease;
    
  }


  .faq-toggle {
    font-size: 1.5em;
    transition: transform 0.3s ease, color 0.3s ease;
  }

  .faq-answer {
    padding: 0 25px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease, padding 0.3s ease;
    font-size: 1em;
    color: #ccc;
  }

  .faq-item.active .faq-answer {
    max-height: 300px;
    padding: 15px 25px 25px 25px;
  }

  .faq-item.active .faq-toggle {
    transform: rotate(45deg);
    color: gold;
  }
  .class-item {
  border: 1px solid black;
  margin-bottom: 10px;
  border-radius: 5px;
  overflow: hidden;
  width: 600px;
  margin : auto;
  padding : 10px;
  font-size: 25px;
}

.class-item summary {
  background: #333;
  color: #fff;
  padding: 15px;
  cursor: pointer;
  list-style: none; 
  position: relative;
}

.class-item summary::after {
  content: '▼';
  position: absolute;
  right: 20px;
  transition: transform 0.3s ease;
}

.class-item[open] summary::after {
  transform: rotate(180deg);
}

.class-content {
  background: transparent;
  padding: 15px;
}

.book-btn::before  {
  background: transparent;
  color: #fff;
  border: none;
  padding: 10px 15px;
  margin-top: 10px;
  cursor: pointer;
}


    </style>
</head>

<body>
    <nav class="nav">
        <div class="navbar-container">
            <div class="navl">
                <img class="logo" src="{{ asset('images/mcg.jpg') }}" alt="Logo" />
                <ul class="menu">
                    <li><a href="/account/dashboard">Home</a></li>
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
                    <li><a href="/whyus">Why us</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="navr">
                <ul class="menu">
                    <li><a href="{{ route('account.logout') }}">Logout</a></li>

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

    <hr class="line" />

    <!-- Subscription Section -->
    <section class="subscription-section">
        <h2>Subscription Plans</h2>
        <div class="plans-container">
            <!-- Basic Plan -->
            <div class="plan-box">
                <h3>Basic</h3>
                <p class="price">RS 1500/mo</p>
                <ul class="features">
                    <li>Access to gym</li>
                    <li>Free Wi-Fi</li>
                    <li>1 trainer session</li>
                </ul>
                <a href="{{ url('/subscription?plan=Basic&price=1500') }}" class="buy-button">Buy Now</a>
            </div>

            <!-- Medium Plan -->
            <div class="plan-box featured">
                <h3>Medium</h3>
                <p class="price">Rs 2500/mo</p>
                <ul class="features">
                    <li>All Basic features</li>
                    <li>Group classes</li>
                    <li>4 trainer sessions</li>
                </ul>
                <a href="{{ url('/subscription?plan=Medium&price=2500') }}" class="buy-button">Buy Now</a>
            </div>

            <!-- Pro Plan -->
            <div class="plan-box">
                <h3>Pro</h3>
                <p class="price">RS 3500/mo</p>
                <ul class="features">
                    <li>All Medium features</li>
                    <li>Personalized diet plan</li>
                    <li>Unlimited trainer sessions</li>
                </ul>
                <a href="{{ url('/subscription?plan=Pro&price=3500') }}" class="buy-button">Buy Now</a>
            </div>
        </div>
    </section>



    <!-- Subscription Section End -->

    <div class="stats-container">
        <div class="sbox">
            <img class="img1" src="{{ asset('images/branches.png') }}" alt="" />
            <h2>1</h2>
            <p>Branches</p>
        </div>
        <div class="sbox">
            <img class="img1" src="{{ asset('images/branches.png') }}" alt="" />
            <h2>50+</h2>
            <p>Machines</p>
        </div>
        <div class="sbox">
            <img class="img1" src="{{ asset('images/trainer.png') }}" alt="" />
            <h2>4</h2>
            <p>Trainers</p>
        </div>
        <div class="sbox">
            <img class="img1" src="images/clients.png" alt="" />
            <h2>1200+</h2>
            <p>Clients</p>
        </div>
    </div>

    <!-- Classes Section -->
<section class="classes-section">
  <h2>Our Gym Classes</h2>

  <!-- Class 1 -->
  <details class="class-item">
    <summary>
      HIIT Training
    </summary>
    <div class="class-content">
      <p><strong>Description:</strong> High-Intensity Interval Training helps burn fat and build endurance.</p>
      <p><strong>Time:</strong> 6:00 PM - 7:00 PM</p>
      <p><strong>Days:</strong> Monday, Wednesday, Friday</p>
      <button class="book-btn">Book Class Online</button>
    </div>
  </details>

  <!-- Class 2 -->
  <details class="class-item">
    <summary>
      Yoga & Flexibility
    </summary>
    <div class="class-content">
      <p><strong>Description:</strong> Improve posture and flexibility with guided sessions.</p>
      <p><strong>Time:</strong> 7:30 AM - 8:30 AM</p>
      <p><strong>Days:</strong> Tuesday, Thursday</p>
      <button class="book-btn">Book Class Online</button>
    </div>
  </details>

  <!-- Class 3 -->
  <details class="class-item">
    <summary>
      Strength & Conditioning
    </summary>
    <div class="class-content">
      <p><strong>Description:</strong> Build lean muscle with free weights and resistance training.</p>
      <p><strong>Time:</strong> 5:00 PM - 6:00 PM</p>
      <p><strong>Days:</strong> Monday - Friday</p>
      <button class="book-btn">Book Class Online</button>
    </div>
  </details>

</section>


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

     <!-- FAQS Section -->
      <section id="faq" style="padding: 60px 20px; background-color: #111; color: #fff;">
  <h2 style="text-align: center; margin-bottom: 50px; font-size: 2em; font-weight: bold; padding: 10px;">
    Customer Support – FAQs
  </h2>

  <div class="faq-container">
    <div class="faq-item">
      <div class="faq-question">
        What are the gym timings?
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        We are open Monday to Friday from 6:00 AM to 11:00 PM, and Saturday from 9:00 AM to 10:00 PM.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">
        Do you offer personal training?
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        Yes, we offer personal training sessions with our certified trainers.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">
        Are there separate facilities for ladies?
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        Absolutely! We have a dedicated ladies-only section to ensure privacy and comfort.
      </div>
    </div>
  </div>
</section>



    <hr class="line" />
    <!-- Feedback Section -->
    <section class="feedback-section">
        <div class="feedback-container">
            <h2>We’d Love Your Feedback 💬</h2>
            <p>Let us know what you think about Muscle Core Gym!</p>

            @if (session('success'))
                <div style="color: green; margin-bottom: 10px;">
                    {{ session('success') }}
                </div>
            @endif

            <form class="feedback-form" action="{{ route('feedbacknew.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name"
                        required />
                </div>

                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required />
                </div>

                <div class="form-group">
                    <label for="message">Your Feedback</label>
                    <textarea id="message" name="message" placeholder="Write your feedback here..." rows="5" required></textarea>
                </div>

                <button type="submit">Send Feedback</button>
            </form>

        </div>
    </section>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.7328366769557!2d73.05539967613726!3d33.58628527333602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df9386d2613c87%3A0xed75760072633d04!2sMuscle%20Core%20Gym!5e0!3m2!1sen!2s!4v1739956323646!5m2!1sen!2s"
        width="1350" height="450" style="border: 0" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

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
         document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
      const parent = item.parentElement;
      parent.classList.toggle('active');
    });
  });

  const accordionButtons = document.querySelectorAll('.accordion-button');

  accordionButtons.forEach(button => {
    button.addEventListener('click', () => {
      const item = button.parentElement;

      // Close other open accordions if you want only one open at a time
      document.querySelectorAll('.accordion-item').forEach(i => {
        if (i !== item) {
          i.classList.remove('active');
        }
      });

      // Toggle current
      item.classList.toggle('active');
    });
  });

    </script>
</body>

</html>

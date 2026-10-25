<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Muscle Core Gym Rawalpindi's premier fitness club for ladies & gents. Expert trainers, 50+ machines, and a community that pushes you further.">
    <title>Muscle Core Gym Rawalpindi's Premier Fitness Club</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    @include('partials.navbar')

    <!-- ============ HERO ============ -->
    <section class="hero" id="home">
        <div class="hero-slides" aria-hidden="true">
            <img class="hero-slide is-active" src="{{ asset('images/GYM.jpg') }}" alt="">
            <img class="hero-slide" src="{{ asset('images/gym2.jpg') }}" alt="">
            <img class="hero-slide" src="{{ asset('images/gym3.jpg') }}" alt="">
        </div>
        <div class="hero-overlay" aria-hidden="true"></div>

        <div class="hero-content">
            <span class="hero-badge"><span class="dot"></span> Rawalpindi's Premier Fitness Club</span>

            <h1 class="hero-title">
                <span class="typed-line">Forge Your</span>
                <span class="typed-line"><span class="typed-word" id="typed-word">Strength</span><span class="typed-cursor" aria-hidden="true"></span></span>
            </h1>

            <p class="hero-sub">
                Expert trainers, world-class equipment, and a community that refuses to settle.
                Whether you're just starting out or chasing your next peak this is where strong begins.
            </p>

            <div class="hero-actions">
                <a href="{{ route('account.register') }}" class="btn btn-gold">Start Your Journey</a>
                <a href="/services" class="btn btn-ghost">Explore Services</a>
            </div>

            <div class="hero-trust">
                <div class="trust-item"><strong>1200+</strong><span>Members</span></div>
                <div class="trust-item"><strong>50+</strong><span>Machines</span></div>
                <div class="trust-item"><strong>4</strong><span>Expert Trainers</span></div>
            </div>
        </div>

        <a href="#process" class="hero-scroll" aria-label="Scroll to content">
            <span class="mouse" aria-hidden="true"></span>
            Scroll
        </a>
    </section>

    <!-- ============ MARQUEE ============ -->
    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            <div class="marquee-group">
                <span class="marquee-item gold">Strength</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Discipline</span><span class="marquee-sep">✦</span>
                <span class="marquee-item gold">Community</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Results</span><span class="marquee-sep">✦</span>
                <span class="marquee-item gold">No Excuses</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Train Hard</span><span class="marquee-sep">✦</span>
            </div>
            <div class="marquee-group">
                <span class="marquee-item gold">Strength</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Discipline</span><span class="marquee-sep">✦</span>
                <span class="marquee-item gold">Community</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Results</span><span class="marquee-sep">✦</span>
                <span class="marquee-item gold">No Excuses</span><span class="marquee-sep">✦</span>
                <span class="marquee-item">Train Hard</span><span class="marquee-sep">✦</span>
            </div>
        </div>
    </div>

    <!-- ============ PROCESS ============ -->
    <section class="section process" id="process">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">How It Works</span>
                <h2 class="section-title">Our Proven <span class="accent">Process</span></h2>
                <p class="section-sub">Four simple steps between where you are today and the strongest version of yourself.</p>
            </div>

            <div class="process-grid">
                <article class="process-card reveal reveal-delay-1">
                    <span class="process-num">01</span>
                    <div class="process-icon">
                        <img src="{{ asset('images/analysis.png') }}" alt="">
                    </div>
                    <h3>Analyze Your Goal</h3>
                    <p>A personal consultation to understand your body, lifestyle, and exactly what you want to achieve.</p>
                </article>

                <article class="process-card reveal reveal-delay-2">
                    <span class="process-num">02</span>
                    <div class="process-icon">
                        <img src="{{ asset('images/workhard.png') }}" alt="">
                    </div>
                    <h3>Work Hard On It</h3>
                    <p>Follow a structured training plan built by certified trainers and push your limits every session.</p>
                </article>

                <article class="process-card reveal reveal-delay-3">
                    <span class="process-num">03</span>
                    <div class="process-icon">
                        <img src="{{ asset('images/improve.png') }}" alt="">
                    </div>
                    <h3>Improve You</h3>
                    <p>Track real progress with regular assessments, smart adjustments, and honest feedback.</p>
                </article>

                <article class="process-card reveal reveal-delay-4">
                    <span class="process-num">04</span>
                    <div class="process-icon">
                        <img src="{{ asset('images/goals.png') }}" alt="">
                    </div>
                    <h3>Achieve Goals</h3>
                    <p>Hit your targets with consistent support, nutrition guidance, and relentless motivation.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- ============ STATS ============ -->
    <section class="stats" id="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item reveal">
                    <div class="stat-icon"><img src="{{ asset('images/branches.png') }}" alt=""></div>
                    <div class="stat-number" data-target="1">0</div>
                    <div class="stat-label">Branches</div>
                </div>
                <div class="stat-item reveal reveal-delay-1">
                    <div class="stat-icon"><img src="{{ asset('images/machines.png') }}" alt=""></div>
                    <div class="stat-number" data-target="50" data-suffix="+">0</div>
                    <div class="stat-label">Machines</div>
                </div>
                <div class="stat-item reveal reveal-delay-2">
                    <div class="stat-icon"><img src="{{ asset('images/trainer.png') }}" alt=""></div>
                    <div class="stat-number" data-target="4">0</div>
                    <div class="stat-label">Trainers</div>
                </div>
                <div class="stat-item reveal reveal-delay-3">
                    <div class="stat-icon"><img src="{{ asset('images/clients.png') }}" alt=""></div>
                    <div class="stat-number" data-target="1200" data-suffix="+">0</div>
                    <div class="stat-label">Clients</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FEATURES ============ -->
    <section class="section features" id="features">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Why Train With Us</span>
                <h2 class="section-title">More Than A <span class="accent">Gym</span></h2>
                <p class="section-sub">Everything you need to transform under one roof, backed by people who care.</p>
            </div>

            <div class="feature-row">
                <div class="feature-media reveal">
                    <img src="{{ asset('images/bench-press-img.avif') }}" alt="Gym equipment at Muscle Core Gym">
                    <span class="feature-tag">Equipment</span>
                </div>
                <div class="feature-body reveal reveal-delay-1">
                    <span class="section-kicker">World-Class Gear</span>
                    <h3 class="feature-title">Equipment Built For Progress</h3>
                    <p class="feature-text">
                        At Structure Health & Fitness, we turn your fitness aspirations into reality.
                        Our range of fitness equipment is meticulously maintained and designed to serve
                        every level from your very first rep to your heaviest lift.
                    </p>
                    <ul class="feature-points">
                        <li>50+ modern strength & cardio machines</li>
                        <li>Regularly serviced and sanitized daily</li>
                        <li>Free weights zone for serious lifters</li>
                    </ul>
                </div>
            </div>

            <div class="feature-row reverse">
                <div class="feature-media reveal">
                    <img src="{{ asset('images/gym3.jpg') }}" alt="Gym community training together">
                    <span class="feature-tag">Community</span>
                </div>
                <div class="feature-body reveal reveal-delay-1">
                    <span class="section-kicker">Support System</span>
                    <h3 class="feature-title">A Community That Cares</h3>
                    <p class="feature-text">
                        Welcome to a vibrant gym community where support is the foundation of every
                        fitness journey. Train alongside like-minded people who celebrate your wins
                        and push you through the tough days.
                    </p>
                    <ul class="feature-points">
                        <li>Welcoming, judgment-free atmosphere</li>
                        <li>Group classes that keep you accountable</li>
                        <li>Dedicated ladies-only section</li>
                    </ul>
                </div>
            </div>

            <div class="feature-row">
                <div class="feature-media reveal">
                    <img src="{{ asset('images/gym5.jpg') }}" alt="Living the fit life">
                    <span class="feature-tag">Lifestyle</span>
                </div>
                <div class="feature-body reveal reveal-delay-1">
                    <span class="section-kicker">Beyond Workouts</span>
                    <h3 class="feature-title">Live The Fit Life</h3>
                    <p class="feature-text">
                        Discover a lifestyle that goes beyond workouts where health, confidence,
                        and personal growth are part of every rep. Our community inspires lifelong
                        habits through shared commitment and lasting encouragement.
                    </p>
                    <ul class="feature-points">
                        <li>Habit-building routines that stick</li>
                        <li>Confidence that shows outside the gym</li>
                        <li>Expert guidance every step of the way</li>
                    </ul>
                </div>
            </div>

            <div class="feature-row reverse">
                <div class="feature-media reveal">
                    <img src="{{ asset('images/gym4.jpg') }}" alt="Members training harder together">
                    <span class="feature-tag">Motivation</span>
                </div>
                <div class="feature-body reveal reveal-delay-1">
                    <span class="section-kicker">Stronger Together</span>
                    <h3 class="feature-title">Motivation Is Contagious</h3>
                    <p class="feature-text">
                        Step into an environment where progress is celebrated and limits are
                        meant to be broken. Our community thrives on shared goals, uplifting
                        energy, and powerful connections that carry you further than you'd go alone.
                    </p>
                    <ul class="feature-points">
                        <li>Trainers who know you by name</li>
                        <li>A network that keeps you showing up</li>
                        <li>An energy you can't replicate at home</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta" id="join">
        <img class="cta-bg" src="{{ asset('images/gym6.jpg') }}" alt="" aria-hidden="true">
        <div class="cta-overlay" aria-hidden="true"></div>
        <div class="container">
            <div class="cta-content reveal">
                <span class="section-kicker">Your First Step</span>
                <h2 class="section-title">Ready To Get <span class="accent">Started?</span></h2>
                <p class="section-sub">
                    Stop planning and start lifting. Join today and train with a community
                    that treats your goals like their own.
                </p>
                <div class="cta-actions">
                    <a href="{{ route('account.register') }}" class="btn btn-gold">Join Now</a>
                    <a href="/contact" class="btn btn-ghost">Book A Free Trial</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="section faq" id="faq">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Customer Support</span>
                <h2 class="section-title">Frequently Asked <span class="accent">Questions</span></h2>
            </div>

            <div class="faq-list reveal">
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        What are the gym timings?
                        <span class="faq-toggle" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Monday – Friday: 06:00 AM – 11:00 PM<br>
                            Saturday: 09:00 AM – 10:00 PM<br>
                            Sunday: Closed
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Do you offer personal training?
                        <span class="faq-toggle" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Yes, we offer personal training sessions with our certified trainers 
                            tailored programs, one-on-one coaching, and progress tracking included.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        Are there separate facilities for ladies?
                        <span class="faq-toggle" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-inner">
                            Absolutely! We have a dedicated ladies-only section to ensure complete
                            privacy and comfort during your workout.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ MAP ============ -->
    <section class="map" id="location">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Visit Us</span>
                <h2 class="section-title">Find <span class="accent">Us</span></h2>
            </div>
            <div class="map-frame reveal">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.7328366769557!2d73.05539967613726!3d33.58628527333602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38df9386d2613c87%3A0xed75760072633d04!2sMuscle%20Core%20Gym!5e0!3m2!1sen!2s!4v1739956323646!5m2!1sen!2s"
                    title="Muscle Core Gym location on Google Maps"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    @include('partials.footer')

    @include('partials.scripts')

    <script>
    (function () {
        "use strict";

        /* ---------- Hero typing effect ---------- */
        var words = ["Strength", "Confidence", "Endurance", "Best Self"];
        var typedEl = document.getElementById("typed-word");
        var wordIndex = 0, charIndex = words[0].length, deleting = false;

        function typeLoop() {
            var current = words[wordIndex];
            if (!deleting) {
                charIndex++;
                typedEl.textContent = current.slice(0, charIndex);
                if (charIndex >= current.length) {
                    deleting = true;
                    return setTimeout(typeLoop, 2200);
                }
            } else {
                charIndex--;
                typedEl.textContent = current.slice(0, charIndex);
                if (charIndex <= 0) {
                    deleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    return setTimeout(typeLoop, 400);
                }
            }
            setTimeout(typeLoop, deleting ? 45 : 95);
        }
        setTimeout(typeLoop, 2400);

        /* ---------- Hero background crossfade ---------- */
        var slides = document.querySelectorAll(".hero-slide");
        var slideIndex = 0;
        if (slides.length > 1) {
            setInterval(function () {
                slides[slideIndex].classList.remove("is-active");
                slideIndex = (slideIndex + 1) % slides.length;
                slides[slideIndex].classList.add("is-active");
            }, 6000);
        }

        /* ---------- Stat counters ---------- */
        function animateCount(el) {
            var target = parseInt(el.getAttribute("data-target"), 10) || 0;
            var suffix = el.getAttribute("data-suffix") || "";
            var duration = 1800;
            var start = null;

            function step(ts) {
                if (!start) start = ts;
                var progress = Math.min((ts - start) / duration, 1);
                var eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(eased * target) + suffix;
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        var counters = document.querySelectorAll(".stat-number");
        if ("IntersectionObserver" in window) {
            var countObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        animateCount(entry.target);
                        countObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(function (el) { countObserver.observe(el); });
        } else {
            counters.forEach(animateCount);
        }

        /* ---------- FAQ accordion ---------- */
        var faqItems = document.querySelectorAll(".faq-item");
        faqItems.forEach(function (item) {
            var btn = item.querySelector(".faq-question");
            var answer = item.querySelector(".faq-answer");

            btn.addEventListener("click", function () {
                var isOpen = item.classList.contains("active");

                faqItems.forEach(function (other) {
                    other.classList.remove("active");
                    other.querySelector(".faq-question").setAttribute("aria-expanded", "false");
                    other.querySelector(".faq-answer").style.maxHeight = null;
                });

                if (!isOpen) {
                    item.classList.add("active");
                    btn.setAttribute("aria-expanded", "true");
                    answer.style.maxHeight = answer.scrollHeight + "px";
                }
            });
        });
    })();
    </script>
</body>
</html>

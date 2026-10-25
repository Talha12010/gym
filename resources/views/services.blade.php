<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore Muscle Core Gym services strength training, yoga, cross fit, and cardio programs with expert coaches in Rawalpindi.">
    <title>Services Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
</head>
<body>

    @include('partials.navbar')

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
        <img class="page-hero-bg" src="{{ asset('images/gym2.jpg') }}" alt="" aria-hidden="true">
        <div class="page-hero-overlay" aria-hidden="true"></div>
        <div class="page-hero-content">
            <span class="page-hero-kicker">Train Your Way</span>
            <h1>Our <span class="accent">Services</span></h1>
            <div class="page-hero-underline"></div>
            <p class="page-hero-sub">
                From raw strength to mindful movement find the program that matches
                your goals and never train the same way twice.
            </p>
        </div>
    </section>

    <!-- ============ SERVICES ============ -->
    <section class="section services">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">What We Offer</span>
                <h2 class="section-title">Programs Built <span class="accent">For You</span></h2>
                <p class="section-sub">Certified coaches, structured programs, and an atmosphere that keeps you coming back.</p>
            </div>

            <div class="services-grid">
                <article class="service-card reveal">
                    <div class="service-media">
                        <img src="{{ asset('images/bench-press-img.avif') }}" alt="Strength workout">
                        <span class="service-num">01</span>
                        <span class="service-tag">Strength</span>
                    </div>
                    <div class="service-body">
                        <h2>Strength Workout</h2>
                        <p>
                            Strength training is the practice of performing physical exercises
                            intended to increase raw strength and endurance. Frequently associated
                            with weight lifting, our strength program takes you from foundational
                            form to serious personal records.
                        </p>
                        <ul class="service-chips">
                            <li>Free Weights</li>
                            <li>Machine Circuits</li>
                            <li>Progressive Overload</li>
                        </ul>
                    </div>
                </article>

                <article class="service-card reveal reveal-delay-1">
                    <div class="service-media">
                        <img src="{{ asset('images/gym3.jpg') }}" alt="Yoga classes">
                        <span class="service-num">02</span>
                        <span class="service-tag">Mind & Body</span>
                    </div>
                    <div class="service-body">
                        <h2>Yoga Classes</h2>
                        <p>
                            Yoga is a practice that involves both the mind and the body mixing
                            physical postures, breathing techniques, meditation, and relaxation.
                            Movement, meditation, and breathing practices work together to promote
                            mental and physical well-being.
                        </p>
                        <ul class="service-chips">
                            <li>All Levels</li>
                            <li>Breathwork</li>
                            <li>Flexibility</li>
                        </ul>
                    </div>
                </article>

                <article class="service-card reveal">
                    <div class="service-media">
                        <img src="{{ asset('images/kettlebell-img.avif') }}" alt="Cross fit training">
                        <span class="service-num">03</span>
                        <span class="service-tag">High Intensity</span>
                    </div>
                    <div class="service-body">
                        <h2>Cross Fit</h2>
                        <p>
                            Cross Fit is a strength and conditioning workout that consists of
                            functional movement performed at a high intensity level a form of
                            high-intensity interval training based on acts you do in daily life,
                            such as crouching, tugging, and pushing.
                        </p>
                        <ul class="service-chips">
                            <li>Functional Moves</li>
                            <li>WODs</li>
                            <li>Group Energy</li>
                        </ul>
                    </div>
                </article>

                <article class="service-card reveal reveal-delay-1">
                    <div class="service-media">
                        <img src="{{ asset('images/treadmail-img.avif') }}" alt="Cardio training">
                        <span class="service-num">04</span>
                        <span class="service-tag">Endurance</span>
                    </div>
                    <div class="service-body">
                        <h2>Cardio</h2>
                        <p>
                            Cardio is any exercise that raises your heart rate and keeps it elevated.
                            As you begin to breathe faster and deeper, your respiratory system works
                            harder. Jumping rope, running stairs, walking, rowing, cycling, and
                            endurance training are all great ways to burn fat and build stamina.
                        </p>
                        <ul class="service-chips">
                            <li>Treadmills</li>
                            <li>Rowing</li>
                            <li>HIIT Sessions</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta">
        <img class="cta-bg" src="{{ asset('images/gym6.jpg') }}" alt="" aria-hidden="true">
        <div class="cta-overlay" aria-hidden="true"></div>
        <div class="container">
            <div class="cta-content reveal">
                <span class="section-kicker">Find Your Program</span>
                <h2 class="section-title">Not Sure Where <span class="accent">To Start?</span></h2>
                <p class="section-sub">
                    Talk to our coaches and get a free consultation we'll match you
                    with the right program for your body and your goals.
                </p>
                <div class="cta-actions">
                    <a href="{{ route('account.register') }}" class="btn btn-gold">Join Now</a>
                    <a href="/contact" class="btn btn-ghost">Talk To A Coach</a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    @include('partials.scripts')

</body>
</html>

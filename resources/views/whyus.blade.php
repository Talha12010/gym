<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Why train at Muscle Core Gym personalized programs, professional expertise, and a community that treats you like family.">
    <title>Why Us Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/whyus.css') }}">
</head>
<body>

    @include('partials.navbar')

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
        <img class="page-hero-bg" src="{{ asset('images/gym4.jpg') }}" alt="" aria-hidden="true">
        <div class="page-hero-overlay" aria-hidden="true"></div>
        <div class="page-hero-content">
            <span class="page-hero-kicker">The Muscle Core Difference</span>
            <h1>Why <span class="accent">Muscle Core Gym</span></h1>
            <div class="page-hero-underline"></div>
            <p class="page-hero-sub">
                Personalized training, professional expertise, and a community that
                treats you like family not a membership number.
            </p>
        </div>
    </section>

    <!-- ============ INTRO ============ -->
    <section class="section why-intro-section">
        <div class="container">
            <div class="why-intro">
                <div class="why-intro-media reveal">
                    <img src="{{ asset('images/gym5.jpg') }}" alt="Training at Muscle Core Gym">
                    <div class="why-badge">
                        <strong>1200+</strong>
                        <span>Happy<br>Members</span>
                    </div>
                </div>
                <div class="why-intro-body reveal reveal-delay-1">
                    <span class="section-kicker">Who We Are</span>
                    <h2>Pakistan's Fastest-Growing Personalized Gym</h2>
                    <p>
                        Muscle Core Gym was founded on the success of a few clients and built on
                        the successes of countless others. We pioneered a way to provide top-notch
                        professional fitness training with a customized, personal approach for
                        clients ranging from youth to retirees, and fitness novices to professional
                        athletes.
                    </p>
                    <ul class="why-values">
                        <li>Customized programs for every individual</li>
                        <li>Power of small-group community training</li>
                        <li>Coaches who care about your consistency</li>
                        <li>Results-driven, non-judgmental culture</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ ACCORDION ============ -->
    <section class="section why-details">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Our Philosophy</span>
                <h2 class="section-title">What Sets <span class="accent">Us Apart</span></h2>
            </div>

            <div class="accordion reveal">
                <details class="accordion-item" open>
                    <summary>
                        Our Model At Muscle Core Gym
                        <span class="accordion-icon" aria-hidden="true"></span>
                    </summary>
                    <div class="accordion-body">
                        <p>
                            Our model at Muscle Core Gym is anchored around two fundamental concepts.
                            First, that a customized fitness program delivers better results for every
                            individual. Second, that there is power in community when athletes train
                            together in small groups, encouragement and camaraderie build consistency.
                        </p>
                        <p>
                            Our concept is centered around member happiness and results. We are proud
                            to have become Pakistan's fastest-growing personalized training and sports
                            performance gym, serving a wide array of clients from youth to retirees
                            and fitness novices to professional athletes.
                        </p>
                        <p>
                            We hope you'll become a part of our community of fitness enthusiasts and
                            athletes and begin your own journey towards feeling "even better" by
                            experiencing the Muscle Core Gym difference.
                        </p>
                    </div>
                </details>

                <details class="accordion-item">
                    <summary>
                        More Personalized Attention. Better Professional Expertise.
                        <span class="accordion-icon" aria-hidden="true"></span>
                    </summary>
                    <div class="accordion-body">
                        <p>
                            Upon starting your membership, you will have a one-on-one initial training
                            session to assess your movement competency and determine your initial
                            training level. Then we design an effective bespoke fitness program just
                            for you a series of progressive workouts around strength, balance,
                            mobility, and endurance.
                        </p>
                        <p>
                            Even if you have an old injury or chronic condition, not to worry about
                            a quarter of our members are typically in this situation, and we're experts
                            at coaching you on your journey back to health. We also have a longstanding
                            practice working with athletes, from high school to professionals, to
                            improve their competitive fitness levels and up their game.
                        </p>
                    </div>
                </details>

                <details class="accordion-item">
                    <summary>
                        We Believe In People Power. Yours &amp; Ours
                        <span class="accordion-icon" aria-hidden="true"></span>
                    </summary>
                    <div class="accordion-body">
                        <p>
                            We are not just a gym. We are not a club. We are a welcoming community 
                            in the heart, and with the heart of Pakistan. Everyone at Muscle Core Gym
                            knows everyone else on a first-name basis (and we worry about you if you
                            miss your training session). You are not a number. You are a valued member
                            of our family.
                        </p>
                        <p>
                            Whether you are a fitness newbie, a play-hard work-hard busy professional,
                            or a high school athlete, we treat everyone with respect. We are
                            non-judgmental and highly inclusive. From our trainers to our members, we
                            cultivate a positive and supportive culture organized, focused, efficient,
                            high-quality, motivating, encouraging, flexible, caring, and fun.
                        </p>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- ============ CTA ============ -->
    <section class="cta">
        <img class="cta-bg" src="{{ asset('images/gym6.jpg') }}" alt="" aria-hidden="true">
        <div class="cta-overlay" aria-hidden="true"></div>
        <div class="container">
            <div class="cta-content reveal">
                <span class="section-kicker">Join The Family</span>
                <h2 class="section-title">Experience The <span class="accent">Difference</span></h2>
                <p class="section-sub">
                    Your first session is about you your goals, your pace, your program.
                    Come see why members never want to train anywhere else.
                </p>
                <div class="cta-actions">
                    <a href="{{ route('account.register') }}" class="btn btn-gold">Become A Member</a>
                    <a href="/contact" class="btn btn-ghost">Visit The Gym</a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    @include('partials.scripts')

</body>
</html>

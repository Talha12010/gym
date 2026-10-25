<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Muscle Core Gym visit us at 69 A Lalkurti, Rawalpindi, or send a message and our team will get back to you.">
    <title>Contact Us Muscle Core Gym</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>

    @include('partials.navbar')

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
        <img class="page-hero-bg" src="{{ asset('images/GYM.jpg') }}" alt="" aria-hidden="true">
        <div class="page-hero-overlay" aria-hidden="true"></div>
        <div class="page-hero-content">
            <span class="page-hero-kicker">We'd Love To Hear From You</span>
            <h1>Contact <span class="accent">Us</span></h1>
            <div class="page-hero-underline"></div>
            <p class="page-hero-sub">
                Questions about memberships, timings, or personal training?
                Reach out we usually respond the same day.
            </p>
        </div>
    </section>

    <!-- ============ CONTACT ============ -->
    <section class="section contact">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Keep In Touch</span>
                <h2 class="section-title">Send Us A <span class="accent">Message</span></h2>
            </div>

            <div class="contact-grid">
                <div class="contact-form-card reveal">
                    <form action="#" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" id="email" name="email" placeholder="Your Email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="branch">Select Branch</label>
                                <select id="branch" name="branch" required>
                                    <option value="">Select Branch</option>
                                    <option value="Rawalpindi">Rawalpindi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Tell us about your fitness goals..." rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-gold btn-block">Send Message</button>
                    </form>
                </div>

                <div class="contact-info reveal reveal-delay-1">
                    <div class="info-card">
                        <div class="info-icon">
                            <img src="{{ asset('images/location.png') }}" alt="">
                        </div>
                        <div>
                            <h3>Visit Us</h3>
                            <p>69 A Lalkurti<br>Rawalpindi, Pakistan</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <img src="{{ asset('images/phone.png') }}" alt="">
                        </div>
                        <div>
                            <h3>Call Us</h3>
                            <p><a href="tel:03000000000">Rawalpindi 0300 0000000</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <img src="{{ asset('images/email.png') }}" alt="">
                        </div>
                        <div>
                            <h3>Email Us</h3>
                            <p><a href="mailto:info@MCG.com.pk">info@MCG.com.pk</a></p>
                        </div>
                    </div>

                    <div class="info-hours">
                        <h3>Opening Hours</h3>
                        <ul>
                            <li><span>Monday – Friday</span><span>6 AM – 11 PM</span></li>
                            <li><span>Saturday</span><span>9 AM – 10 PM</span></li>
                            <li><span>Sunday</span><span>Closed</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ MAP ============ -->
    <section class="map">
        <div class="container">
            <div class="section-head reveal">
                <span class="section-kicker">Find Us</span>
                <h2 class="section-title">Our <span class="accent">Location</span></h2>
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

</body>
</html>

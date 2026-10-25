<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">
                    <img src="{{ asset('images/mcg.jpg') }}" alt="Muscle Core Gym logo">
                    <span>Muscle Core Gym</span>
                </div>
                <p class="footer-about">
                    Muscle Core Gym is the best gym for ladies &amp; gents located in Rawalpindi,
                    Pakistan. A top-notch health fitness club with experienced trainers &amp;
                    latest gym equipment.
                </p>
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><img src="{{ asset('images/facebook.png') }}" alt=""></a>
                    <a href="#" aria-label="YouTube"><img src="{{ asset('images/youtube.png') }}" alt=""></a>
                    <a href="#" aria-label="Instagram"><img src="{{ asset('images/insta.png') }}" alt=""></a>
                    <a href="#" aria-label="LinkedIn"><img src="{{ asset('images/linkedin.png') }}" alt=""></a>
                </div>
            </div>

            <div>
                <h3>Useful Links</h3>
                <ul class="footer-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/services">Services</a></li>
                    <li><a href="/whyus">Why Us</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="{{ route('account.login') }}">Login</a></li>
                    <li><a href="{{ route('account.register') }}">Sign Up</a></li>
                </ul>
            </div>

            <div>
                <h3>Opening Hours</h3>
                <span class="branch-chip">Rawalpindi</span>
                <ul class="footer-hours">
                    <li><span>Monday – Friday</span><span>6 AM – 11 PM</span></li>
                    <li><span>Saturday</span><span>9 AM – 10 PM</span></li>
                    <li><span>Sunday</span><span>Closed</span></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} <span class="gold">Muscle Core Gym</span>. All rights reserved.
        </div>
    </div>
</footer>

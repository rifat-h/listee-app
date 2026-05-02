<!-- Newsletter Section -->
<section class="newsletter-section bg-danger text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold">Stay Tuned With Us</h2>
        <p>Subcribe to our newletter and never miss our latest news and promotions. Our<br>
        newsletter is sent once a week, every thursday.</p>
        <form action="{{ url('/newsletter/subscribe') }}" method="POST" class="mt-4">
            @csrf
            <div class="d-flex justify-content-center gap-2" style="max-width: 500px; margin: 0 auto;">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-envelope text-danger"></i></span>
                    <input type="email" name="email" class="form-control border-0" placeholder="Enter Email Address" required>
                </div>
                <button type="submit" class="btn btn-outline-light fw-bold px-4">Subscribe</button>
            </div>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Logo & Description -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Listee" height="40">
                </a>
                <p class="mt-3 text-white-50 small">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et magna aliqua.
                </p>
                <div class="social-links d-flex gap-2 mt-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- About Us Links -->
            <div class="col-lg-2 col-md-6 mb-4">
<h6 class="fw-bold mb-3 text-white">About Us</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Our Product</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Our Services</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Get Started</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white-50 text-decoration-none">Contact Us</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-white">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ url('/listings') }}" class="text-white-50 text-decoration-none">Market Place</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Customers</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Carriers</a></li>
                    <li class="mb-2"><a href="{{ url('/blog') }}" class="text-white-50 text-decoration-none">Our Blog</a></li>
                </ul>
            </div>

            <!-- Top Cities -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-white">Top Cities</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Manhattan</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Los Angeles</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Houston</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chicago</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Alabama</a></li>
                </ul>
            </div>

            <!-- Communication -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-bold mb-3 text-white">Communication</h6>
                <div class="mb-3">
                    <p class="text-white-50 mb-0 small"><i class="fas fa-phone text-danger me-2"></i> Call Us</p>
                    <p class="fw-bold small">+017 123 456 78</p>
                </div>
                <div>
                    <p class="text-white-50 mb-0 small"><i class="fas fa-envelope text-danger me-2"></i> Send Message</p>
                    <p class="fw-bold small">listee@example.com</p>
                </div>
            </div>
        </div>

        <hr class="border-secondary">

        <!-- Bottom Footer -->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <p class="text-white-50 mb-0 small">All Copyrights Reserved &copy; {{ date('Y') }} - Listee.</p>
            <div class="d-flex gap-3 align-items-center">
                <a href="{{ url('/privacy') }}" class="text-white-50 text-decoration-none small">Privacy</a>
                <span class="text-white-50">|</span>
                <a href="{{ url('/faq') }}" class="text-white-50 text-decoration-none small">Faq</a>
                <span class="text-white-50">|</span>
                <a href="{{ url('/terms') }}" class="text-white-50 text-decoration-none small">Terms</a>
            </div>
        </div>
    </div>
</footer>

<!-- Newsletter Section -->
<section class="newsletter-section bg-danger text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold">Stay Tuned With Us</h2>
        <p>Subscribe to our newsletter and never miss our latest news and promotions.</p>
        <form action="{{ url('/newsletter/subscribe') }}" method="POST" class="d-flex justify-content-center gap-2 mt-3">
            @csrf
            <div class="input-group" style="max-width: 500px;">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <button type="submit" class="btn btn-light text-danger fw-bold">Subscribe</button>
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
                <p class="mt-3 text-muted">
                    আমাদের প্ল্যাটফর্মে আপনি যেকোনো পণ্য কিনতে ও বিক্রি করতে পারবেন।
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
                <h5 class="fw-bold mb-3">About Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Our Product</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Our Services</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Get Started</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-muted text-decoration-none">Contact Us</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/listings') }}" class="text-muted text-decoration-none">Market Place</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Customers</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Carriers</a></li>
                    <li class="mb-2"><a href="{{ url('/blog') }}" class="text-muted text-decoration-none">Our Blog</a></li>
                </ul>
            </div>

            <!-- Top Cities -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Top Cities</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Dhaka</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Chittagong</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Rajshahi</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Sylhet</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Khulna</a></li>
                </ul>
            </div>

            <!-- Communication -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Communication</h5>
                <div class="mb-3">
                    <p class="text-muted mb-0"><i class="fas fa-phone text-danger me-2"></i> Call Us</p>
                    <p class="fw-bold">+880 1XXX-XXXXXX</p>
                </div>
                <div>
                    <p class="text-muted mb-0"><i class="fas fa-envelope text-danger me-2"></i> Send Message</p>
                    <p class="fw-bold">info@listee.com</p>
                </div>
            </div>
        </div>

        <hr class="border-secondary">

        <!-- Bottom Footer -->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <p class="text-muted mb-0">All Copyrights Reserved &copy; {{ date('Y') }} - Listee.</p>
            <div>
                <a href="{{ url('/privacy') }}" class="text-muted text-decoration-none me-3">Privacy</a>
                <a href="{{ url('/faq') }}" class="text-muted text-decoration-none me-3">FAQ</a>
                <a href="{{ url('/terms') }}" class="text-muted text-decoration-none">Terms</a>
            </div>
        </div>
    </div>
</footer>
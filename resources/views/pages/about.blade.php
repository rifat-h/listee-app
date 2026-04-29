@extends('layouts.app')

@section('title', 'About Us - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'About Us',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'About Us']
    ]
])

{{-- About Hero --}}
<section class="about-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <span class="about-badge">About Listee</span>
                    <h2>The Best Platform for Classified Ads in Bangladesh</h2>
                    <p class="about-lead">
                        Listee is a trusted classified ads platform where you can buy, sell, and discover 
                        amazing deals near you. We connect buyers and sellers across Bangladesh with a 
                        simple, secure, and user-friendly platform.
                    </p>
                    <p>
                        Founded in {{ date('Y') }}, our mission is to create a marketplace that empowers 
                        individuals and businesses to reach their audience effectively. Whether you're 
                        looking to sell your car, find a new apartment, or discover local services — 
                        Listee makes it easy.
                    </p>
                    <div class="about-stats-row">
                        <div class="about-stat">
                            <h3>{{ $totalListings ?? '10K+' }}</h3>
                            <p>Active Listings</p>
                        </div>
                        <div class="about-stat">
                            <h3>{{ $totalUsers ?? '5K+' }}</h3>
                            <p>Happy Users</p>
                        </div>
                        <div class="about-stat">
                            <h3>{{ $totalCategories ?? '50+' }}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="about-stat">
                            <h3>64</h3>
                            <p>Districts Covered</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="About Listee" class="img-fluid rounded-3">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="why-choose py-5 bg-light">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <span class="heading-badge">Why Choose Us</span>
            <h2>Why People Trust Listee</h2>
            <p class="text-muted">We provide the best experience for buying and selling</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Trusted & Secure</h5>
                    <p>All listings are verified and we provide a safe environment for transactions between buyers and sellers.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5>Fast & Easy</h5>
                    <p>Post your ad in minutes and reach thousands of potential buyers instantly. Simple, fast, and effective.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h5>Free to Use</h5>
                    <p>Basic listings are completely free. Reach your audience without spending a single taka.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5>24/7 Support</h5>
                    <p>Our dedicated support team is always ready to help you with any questions or issues.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5>Mobile Friendly</h5>
                    <p>Access Listee from any device. Our responsive design works perfectly on mobile, tablet, and desktop.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h5>Location Based</h5>
                    <p>Find listings near you with our location-based search. Discover deals in your neighborhood.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Our Team --}}
<section class="team-section py-5">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <span class="heading-badge">Our Team</span>
            <h2>Meet Our Team</h2>
            <p class="text-muted">The people behind Listee who make it all happen</p>
        </div>
        <div class="row justify-content-center">
            @php
                $team = [
                    ['name' => 'John Doe', 'role' => 'Founder & CEO', 'image' => 'team-1.jpg'],
                    ['name' => 'Jane Smith', 'role' => 'CTO', 'image' => 'team-2.jpg'],
                    ['name' => 'Mike Johnson', 'role' => 'Head of Marketing', 'image' => 'team-3.jpg'],
                    ['name' => 'Sarah Williams', 'role' => 'Lead Designer', 'image' => 'team-4.jpg'],
                ];
            @endphp
            @foreach($team as $member)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="team-card text-center">
                        <div class="team-img">
                            <img src="{{ asset('images/' . $member['image']) }}" alt="{{ $member['name'] }}">
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <h5>{{ $member['name'] }}</h5>
                        <p>{{ $member['role'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="cta-section py-5">
    <div class="container">
        <div class="cta-box text-center">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of users and start buying & selling today!</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn btn-cta-primary">
                    <i class="fas fa-user-plus me-1"></i> Sign Up Free
                </a>
                <a href="{{ route('listings.index') }}" class="btn btn-cta-outline">
                    <i class="fas fa-search me-1"></i> Browse Listings
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.about-badge, .heading-badge {
    display: inline-block;
    background: #FFF5F5;
    color: #FF3B30;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
}
.about-content h2 {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    line-height: 1.3;
}
.about-lead {
    font-size: 16px;
    color: #555;
    line-height: 1.7;
    margin-bottom: 10px;
}
.about-content p {
    font-size: 14px;
    color: #777;
    line-height: 1.7;
}
.about-stats-row {
    display: flex;
    gap: 30px;
    margin-top: 25px;
    flex-wrap: wrap;
}
.about-stat h3 {
    font-size: 28px;
    font-weight: 700;
    color: #FF3B30;
    margin-bottom: 2px;
}
.about-stat p {
    font-size: 13px;
    color: #888;
    margin: 0;
}
.about-image img {
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}
.section-heading h2 {
    font-size: 28px;
    font-weight: 700;
    color: #333;
}
.feature-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 30px 20px;
    transition: all 0.3s ease;
    height: 100%;
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.feature-icon {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}
.feature-icon i {
    font-size: 24px;
    color: #FF3B30;
}
.feature-card h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
}
.feature-card p {
    font-size: 13px;
    color: #888;
    margin: 0;
    line-height: 1.6;
}
.team-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px;
    transition: all 0.3s;
}
.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.team-img {
    position: relative;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px;
}
.team-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.team-social {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(255,59,48,0.9);
    display: flex;
    justify-content: center;
    gap: 10px;
    padding: 5px 0;
    transform: translateY(100%);
    transition: transform 0.3s;
}
.team-card:hover .team-social {
    transform: translateY(0);
}
.team-social a {
    color: #fff;
    font-size: 13px;
}
.team-card h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 3px;
}
.team-card p {
    font-size: 13px;
    color: #888;
}
.cta-box {
    background: linear-gradient(135deg, #FF3B30, #FF6B5A);
    padding: 50px 30px;
    border-radius: 15px;
    color: #fff;
}
.cta-box h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
}
.cta-box p {
    font-size: 15px;
    opacity: 0.9;
    margin-bottom: 25px;
}
.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}
.btn-cta-primary {
    background: #fff;
    color: #FF3B30;
    padding: 12px 28px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-cta-primary:hover {
    background: #f0f0f0;
    color: #E0352B;
}
.btn-cta-outline {
    border: 2px solid #fff;
    color: #fff;
    padding: 12px 28px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}
.btn-cta-outline:hover {
    background: #fff;
    color: #FF3B30;
}
</style>

@endsection
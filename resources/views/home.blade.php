@extends('layouts.app')

@section('title', 'Listee - Buy, Sell & Find Everything')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        overflow: hidden;
        min-height: 500px;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -60px;
        left: -60px;
        width: 200px;
        height: 200px;
        border: 40px solid #dc3545;
        border-radius: 50%;
        opacity: 0.15;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: 30px;
        left: 30px;
        width: 80px;
        height: 80px;
        background: #dc3545;
        border-radius: 50%;
        opacity: 0.10;
    }
    .hero-deco-curve {
        position: absolute;
        top: 50%;
        left: -30px;
        width: 60px;
        height: 120px;
        border: 4px solid #dc3545;
        border-left: none;
        border-radius: 0 60px 60px 0;
        opacity: 0.18;
    }

    /* Category Card */
    .category-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    .category-card .category-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 10px;
        border: 3px solid #f8f9fa;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .category-card .category-icon-wrap {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        background: #fff5f5;
    }

    /* Listing Card */
    .listing-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .listing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    .listing-card .price-original {
        text-decoration: line-through;
        color: #999;
        font-size: 0.85rem;
        margin-left: 6px;
    }

    /* Popular Locations */
    .popular-locations .card {
        border-radius: 12px;
        transition: transform 0.3s ease;
    }
    .popular-locations .card:hover {
        transform: translateY(-3px);
    }

    /* Earn Cash Section */
    .earn-cash-section {
        position: relative;
    }

    /* Testimonials */
    .testimonials-section .card {
        border-radius: 16px;
    }
    .testimonials-section .testimonial-avatars {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }
    .testimonials-section .testimonial-avatars img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .testimonials-section .testimonial-avatars img:nth-child(2) {
        margin-left: -15px;
    }
    .testimonials-section .testimonial-avatars img:nth-child(3) {
        margin-left: -15px;
    }

    /* Sponsors */
    .sponsors-section .sponsor-logo {
        opacity: 0.5;
        transition: opacity 0.3s ease;
        font-size: 1.1rem;
    }
    .sponsors-section .sponsor-logo:hover {
        opacity: 1;
    }

    /* Pricing Cards */
    .pricing-plan-section .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .pricing-plan-section .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    .pricing-plan-section .pricing-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    /* Blog Card */
    .blog-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-5px);
    }

    /* Section Headings */
    .section-heading .badge {
        font-size: inherit;
        vertical-align: baseline;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Newsletter */
    .newsletter-section .form-control {
        border-radius: 8px;
    }
    .newsletter-section .btn {
        border-radius: 8px;
    }
</style>
@endpush

@section('content')

{{-- SECTION 1: Hero Banner with Search --}}
<section class="hero-section bg-light py-5">
    <div class="hero-deco-curve"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-danger mb-3 p-2 rounded-pill">
                    <i class="fas fa-star me-1"></i> Explore top-rated attractions
                </span>
                <h1 class="display-4 fw-bold">
                    Let us help you <br>
                    <span class="text-danger">Find, Buy</span> & Own Dreams
                </h1>
                <p class="text-muted mt-3">
                    দেশের সবচেয়ে বিশ্বস্ত Classified Ad Listing Website। আপনার কাছাকাছি হাজারো পণ্য ব্রাউজ করুন।
                </p>

                <!-- Search Bar -->
                <form action="{{ url('/listings') }}" method="GET" class="mt-4">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                <input type="text" name="location" class="form-control" placeholder="Choose Location">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="keyword" class="form-control" placeholder="Search keyword...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/hero-banner.png') }}" alt="Hero" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: Our Categories --}}
<section class="categories-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Our <span class="badge bg-danger">Cat</span>egory</h2>
                <p class="text-muted">Buy and Sell Everything from Our Top Category</p>
            </div>
            <a href="{{ url('/categories') }}" class="btn btn-outline-danger btn-sm">View All</a>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <a href="{{ url('/listings?category=' . $category->id) }}" class="text-decoration-none">
                    <div class="card text-center p-3 h-100 border-0 shadow-sm category-card">
                        <div class="card-body p-2">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-img">
                            @else
                                <div class="category-icon-wrap">
                                    <i class="{{ $category->icon ?? 'fas fa-folder' }}" style="font-size: 2rem; color: {{ $category->color ?? '#dc3545' }}"></i>
                                </div>
                            @endif
                            <h6 class="card-title text-dark mt-2 mb-1" style="font-size: 0.85rem;">{{ $category->name }}</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">{{ $category->listings_count ?? 0 }} Ads</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 3: Featured Ads (Carousel) --}}
<section class="featured-ads-section py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Featu<span class="badge bg-danger">red</span> Ads</h2>
                <p class="text-muted">Checkout these latest cool ads from our members</p>
            </div>
            <div>
                <button class="btn btn-outline-secondary btn-sm me-1 rounded-circle" id="featuredPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline-secondary btn-sm rounded-circle" id="featuredNext"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="owl-carousel featured-carousel">
            @foreach($featuredAds as $ad)
            <div class="item">
                @include('listings._card', ['listing' => $ad])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 4: Popular Locations --}}
<section class="popular-locations py-5 bg-danger text-white">
    <div class="container text-center">
        <h2 class="fw-bold">Popular <span class="badge bg-white text-danger">Lo</span>cations</h2>
        <p>Start by selecting your favourite location and explore the goods</p>

        <div class="row g-4 mt-3 justify-content-center">
            @forelse($popularLocations as $location)
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white text-dark border-0 shadow">
                    <div class="card-body d-flex align-items-center p-3">
                        <img src="{{ $location->image ? asset('storage/' . $location->image) : asset('images/default-location.png') }}"
                             alt="{{ $location->name }}" class="rounded me-3" width="80" height="80" style="object-fit: cover;">
                        <div class="text-start">
                            <h5 class="fw-bold mb-1">{{ $location->name }}</h5>
                            <small class="text-muted">{{ $location->listings_count ?? 0 }}+ Ads Posted</small>
                            <br>
                            <a href="{{ url('/listings?location=' . $location->id) }}"
                               class="btn btn-outline-danger btn-sm mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            {{-- Default locations when no data --}}
            @php
                $defaultLocations = [
                    ['name' => 'USA', 'ads' => '120'],
                    ['name' => 'Canada', 'ads' => '85'],
                    ['name' => 'United Kingdom', 'ads' => '95'],
                    ['name' => 'Australia', 'ads' => '73'],
                    ['name' => 'France', 'ads' => '64'],
                ];
            @endphp
            @foreach($defaultLocations as $loc)
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white text-dark border-0 shadow">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; min-width: 80px;">
                            <i class="fas fa-map-marker-alt text-danger fa-2x"></i>
                        </div>
                        <div class="text-start">
                            <h5 class="fw-bold mb-1">{{ $loc['name'] }}</h5>
                            <small class="text-muted">{{ $loc['ads'] }}+ Ads Posted</small>
                            <br>
                            <a href="{{ url('/listings') }}" class="btn btn-outline-danger btn-sm mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        <div class="mt-4">
            <a href="{{ url('/listings') }}" class="btn btn-outline-light px-4">Browse All</a>
        </div>
    </div>
</section>

{{-- SECTION 5: Latest Ads --}}
<section class="latest-ads-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Lat<span class="badge bg-danger">est</span> Ads</h2>
                <p class="text-muted">Checkout these latest cool ads from our members</p>
            </div>
            <a href="{{ url('/listings') }}" class="btn btn-outline-danger btn-sm">View All</a>
        </div>

        <div class="row g-4">
            @foreach($latestAds->take(8) as $ad)
            <div class="col-lg-3 col-md-6">
                @include('listings._card', ['listing' => $ad])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 6: Earn Cash by Selling --}}
<section class="earn-cash-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold">
                    Earn Cash by Selling<br>
                    <span class="text-danger">or Find Anything you desire</span>
                </h2>
                <p class="text-muted mt-3">
                    There are many wonderful of passages of Lorem Ipsum available, but the majority have
                    been altered in some of form injected humour, or Lorem Ipsum.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ url('/user/add-listing') }}" class="btn btn-danger px-4">Post Your Ad</a>
                    <a href="{{ url('/listings') }}" class="btn btn-outline-danger px-4">Browse Ads</a>
                </div>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <img src="{{ asset('images/earn-cash.png') }}" alt="Earn Cash by Selling" class="img-fluid" style="max-height: 350px;">
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7: Client Testimonials --}}
<section class="testimonials-section py-5">
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold">Client<br><span class="badge bg-danger">Test</span>imonials</h2>
        </div>

        <div class="row justify-content-center g-4 align-items-stretch">
            {{-- Left: Avatars --}}
            <div class="col-lg-2 col-md-12 d-flex align-items-center justify-content-center">
                <div class="testimonial-avatars">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="User 1">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="User 2">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="User 3">
                </div>
            </div>

            {{-- Testimonial Card 1 (White) --}}
            <div class="col-lg-5 col-md-6">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle me-3" width="50" height="50" alt="Dev">
                        <div>
                            <h6 class="fw-bold mb-0">Dev</h6>
                            <small class="text-muted">Lead Frontend Developer</small>
                        </div>
                    </div>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-muted small">
                        Saepe noster intellegat aha has tales alias periculis at India.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at
                        magna et nunc dapibus consequat sit amet a felis.
                    </p>
                </div>
            </div>

            {{-- Testimonial Card 2 (Red) --}}
            <div class="col-lg-5 col-md-6">
                <div class="card border-0 shadow p-4 h-100 bg-danger text-white">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle me-3" width="50" height="50" alt="Esther Hills">
                        <div>
                            <h6 class="fw-bold mb-0">Esther Hills</h6>
                            <small>Lead Frontend Developer</small>
                        </div>
                    </div>
                    <div class="text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="small">
                        Vollem meum intellegat delicata has tales alias periculis at India.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at
                        magna et nunc dapibus consequat sit amet a felis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 8: Sponsors --}}
<section class="sponsors-section py-4 bg-light">
    <div class="container text-center">
        <h5 class="fw-bold mb-4">Over 5,26,000+ Sponsors being contact with us</h5>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 gap-lg-5">
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-paint-brush me-1"></i> graphicriver</span>
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-bullseye me-1"></i> videohive</span>
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-music me-1"></i> audiojungle</span>
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-camera me-1"></i> photodune</span>
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-code me-1"></i> codecanyon</span>
            <span class="sponsor-logo text-muted fw-bold"><i class="fas fa-gem me-1"></i> themeforest</span>
        </div>
    </div>
</section>

{{-- SECTION 9: Our Pricing Plan --}}
<section class="pricing-plan-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Pricing <span class="badge bg-danger">Pl</span>an</h2>
            <p class="text-muted">select a plan giving which gives the best for in build features</p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Basic Plan --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="card-body">
                        <div class="pricing-icon bg-light mx-auto">
                            <i class="fas fa-paper-plane text-danger"></i>
                        </div>
                        <span class="badge bg-light text-dark mb-2">Basic</span>
                        <h2 class="fw-bold text-danger">$10<small class="text-muted fs-6 fw-normal">/month</small></h2>
                        <p class="text-muted small">For small business that want to customize website</p>
                        <hr>
                        <ul class="list-unstyled text-start small">
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Basic listing submission</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> 24-hour Availability</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Email support</li>
                            <li class="mb-2"><i class="fas fa-times-circle text-muted me-2"></i> Limited support</li>
                        </ul>
                        <a href="{{ url('/pricing') }}" class="btn btn-outline-danger w-100 mt-2">View details</a>
                    </div>
                </div>
            </div>

            {{-- Standard Plan --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="card-body">
                        <div class="pricing-icon bg-light mx-auto">
                            <i class="fas fa-rocket text-danger"></i>
                        </div>
                        <span class="badge bg-light text-dark mb-2">Standard</span>
                        <h2 class="fw-bold text-danger">$25<small class="text-muted fs-6 fw-normal">/month</small></h2>
                        <p class="text-muted small">For small business that want to customize website</p>
                        <hr>
                        <ul class="list-unstyled text-start small">
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Basic listing submission</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> 24-hour Availability</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Email support</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Limited support</li>
                        </ul>
                        <a href="{{ url('/pricing') }}" class="btn btn-outline-danger w-100 mt-2">View details</a>
                    </div>
                </div>
            </div>

            {{-- Popular Plan --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow text-center p-4 h-100" style="border: 2px solid #dc3545 !important;">
                    <div class="card-body">
                        <div class="pricing-icon bg-danger mx-auto">
                            <i class="fas fa-gem text-white"></i>
                        </div>
                        <span class="badge bg-danger mb-2">Popular</span>
                        <h2 class="fw-bold text-danger">$50<small class="text-muted fs-6 fw-normal">/month</small></h2>
                        <p class="text-muted small">For small business that want to customize website</p>
                        <hr>
                        <ul class="list-unstyled text-start small">
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Basic listing submission</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> 24-hour Availability</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Priority support</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Limited support</li>
                        </ul>
                        <a href="{{ url('/pricing') }}" class="btn btn-outline-danger w-100 mt-2">View details</a>
                    </div>
                </div>
            </div>

            {{-- Enterprise Plan --}}
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="card-body">
                        <div class="pricing-icon bg-light mx-auto">
                            <i class="fas fa-crown text-danger"></i>
                        </div>
                        <span class="badge bg-light text-dark mb-2">Enterprise</span>
                        <h2 class="fw-bold text-danger">$100<small class="text-muted fs-6 fw-normal">/month</small></h2>
                        <p class="text-muted small">For small business that want to customize website</p>
                        <hr>
                        <ul class="list-unstyled text-start small">
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Basic listing submission</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> 24-hour Availability</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Priority support</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-danger me-2"></i> Limited support</li>
                        </ul>
                        <a href="{{ url('/pricing') }}" class="btn btn-danger w-100 mt-2">View details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 10: Latest Blog --}}
<section class="latest-blog py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Lat<span class="badge bg-danger">est</span> Blog</h2>
                <p class="text-muted">People are sharing valuable content, check them out</p>
            </div>
            <a href="{{ url('/blog') }}" class="btn btn-outline-danger btn-sm">View All</a>
        </div>

        <div class="row g-4">
            @foreach($latestBlogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 blog-card">
                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/default-blog.png') }}"
                         class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ $blog->user->avatar ? asset('storage/' . $blog->user->avatar) : asset('images/default-avatar.png') }}"
                                 class="rounded-circle me-2" width="30" height="30" alt="{{ $blog->user->name }}">
                            <small class="text-muted">{{ $blog->user->name }}</small>
                            <small class="text-muted ms-auto">
                                <i class="fas fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        <h6 class="fw-bold">
                            <a href="{{ url('/blog/' . $blog->slug) }}" class="text-dark text-decoration-none">
                                {{ $blog->title }}
                            </a>
                        </h6>
                        <p class="text-muted small">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                        <a href="{{ url('/blog/' . $blog->slug) }}" class="text-danger text-decoration-none small fw-bold">
                            Read Details <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        var owl = $('.featured-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            responsive: {
                0:   { items: 1 },
                576: { items: 2 },
                992: { items: 4 }
            }
        });
        $('#featuredPrev').click(function(){ owl.trigger('prev.owl.carousel'); });
        $('#featuredNext').click(function(){ owl.trigger('next.owl.carousel'); });
    });
</script>
@endpush

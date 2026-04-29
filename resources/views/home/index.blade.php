@extends('layouts.app')

@section('title', 'Listee - Buy, Sell & Find Everything')

@section('content')

{{-- SECTION 1: Hero Banner with Search --}}
<section class="hero-section bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-primary mb-3 p-2">Explore top-rated attractions</span>
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
                        <div class="col-md-4">
                            <select name="category" class="form-select">
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" name="location" class="form-control" placeholder="Choose Location">
                            </div>
                        </div>
                        <div class="col-md-4">
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
            <a href="{{ url('/categories') }}" class="btn btn-outline-danger">View All</a>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <a href="{{ url('/listings?category=' . $category->id) }}" class="text-decoration-none">
                    <div class="card text-center p-3 h-100 border-0 shadow-sm category-card">
                        <div class="card-body">
                            <i class="{{ $category->icon ?? 'fas fa-folder' }}" style="font-size: 2.5rem; color: {{ $category->color ?? '#dc3545' }}"></i>
                            <h6 class="card-title text-dark">{{ $category->name }}</h6>
                            <small class="text-muted">{{ $category->listings_count ?? 0 }} Ads</small>
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
                <button class="btn btn-outline-secondary btn-sm me-1" id="featuredPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline-secondary btn-sm" id="featuredNext"><i class="fas fa-chevron-right"></i></button>
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

{{-- SECTION 4: Latest Ads --}}
<section class="latest-ads-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Lat<span class="badge bg-danger">est</span> Ads</h2>
                <p class="text-muted">Checkout these latest cool ads from our members</p>
            </div>
            <a href="{{ url('/listings') }}" class="btn btn-outline-danger">View All</a>
        </div>

        <div class="row g-4">
            @foreach($latestAds as $ad)
            <div class="col-lg-3 col-md-6">
                @include('listings._card', ['listing' => $ad])
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 5: Popular Locations --}}
<section class="popular-locations py-5 bg-danger text-white">
    <div class="container text-center">
        <h2 class="fw-bold">Popular <span class="badge bg-white text-danger">Lo</span>cations</h2>
        <p>Start by selecting your favourite location and explore the goods</p>

        <div class="row g-4 mt-3">
            @foreach($popularLocations as $location)
            <div class="col-lg-4 col-md-6">
                <div class="card bg-white text-dark">
                    <div class="card-body d-flex align-items-center">
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
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION 6: Latest Blog --}}
<section class="latest-blog py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Lat<span class="badge bg-danger">est</span> Blog</h2>
                <p class="text-muted">People are sharing valuable content, check them out</p>
            </div>
            <a href="{{ url('/blog') }}" class="btn btn-outline-danger">View All</a>
        </div>

        <div class="row g-4">
            @foreach($latestBlogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/default-blog.png') }}"
                         class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ $blog->user->avatar ? asset('storage/' . $blog->user->avatar) : asset('images/default-avatar.png') }}"
                                 class="rounded-circle me-2" width="30" height="30">
                            <small class="text-muted">{{ $blog->user->name }}</small>
                            <small class="text-muted ms-auto">
                                <i class="fas fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}
                            </small>
                        </div>
                        <h5>
                            <a href="{{ url('/blog/' . $blog->slug) }}" class="text-dark text-decoration-none">
                                {{ $blog->title }}
                            </a>
                        </h5>
                        <p class="text-muted">{{ Str::limit($blog->content, 100) }}</p>
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
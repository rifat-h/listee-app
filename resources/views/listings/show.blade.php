@extends('layouts.app')

@section('title', $listing->title . ' - Listee')

@push('styles')
<style>
    .listing-hero {
        position: relative;
        overflow: hidden;
        max-height: 500px;
    }
    .listing-hero img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
    .show-photos-btn {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(255,255,255,0.9);
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .listing-title-section {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }
    .listing-title-section h2 {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .listing-title-section .subtitle {
        color: #777;
        font-size: 14px;
    }
    .listing-title-section .price-tag {
        font-size: 32px;
        font-weight: 700;
        color: #c41040;
    }
    .listing-title-section .price-label {
        font-size: 13px;
        color: #999;
    }
    .listing-action-bar {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
        flex-wrap: wrap;
    }
    .listing-action-bar a {
        font-size: 13px;
        color: #555;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .listing-action-bar a:hover {
        color: #c41040;
    }
    .btn-call-now {
        background: #c41040;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 600;
        margin-left: auto;
    }
    .btn-call-now:hover {
        background: #a00d35;
        color: #fff;
    }
    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-title i {
        color: #c41040;
    }
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }
    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 6px;
    }
    .feature-item .feature-icon {
        width: 40px;
        height: 40px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c41040;
        font-size: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .feature-item span {
        font-size: 13px;
        color: #555;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }
    .gallery-grid img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .gallery-grid img:hover {
        opacity: 0.8;
    }
    .ratings-section .rating-overview {
        display: flex;
        align-items: flex-start;
        gap: 30px;
    }
    .rating-number {
        text-align: center;
    }
    .rating-number .score {
        font-size: 42px;
        font-weight: 700;
        color: #333;
    }
    .rating-bars {
        flex: 1;
    }
    .rating-bar-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
    }
    .rating-bar-row .stars {
        font-size: 11px;
        color: #f5a623;
        min-width: 80px;
    }
    .rating-bar-row .bar {
        flex: 1;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }
    .rating-bar-row .bar-fill {
        height: 100%;
        background: #f5a623;
        border-radius: 4px;
    }
    .rating-bar-row .count {
        font-size: 13px;
        color: #999;
        min-width: 20px;
        text-align: right;
    }
    .review-card {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }
    .review-card:last-child {
        border-bottom: none;
    }
    .review-author-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    .review-images {
        display: flex;
        gap: 8px;
        margin-top: 10px;
    }
    .review-images img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
    }
    .review-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
        font-size: 13px;
        color: #888;
    }
    .review-actions a {
        color: #888;
        text-decoration: none;
    }
    .review-actions a:hover {
        color: #c41040;
    }
    .details-table {
        width: 100%;
    }
    .details-table tr {
        border-bottom: 1px solid #f0f0f0;
    }
    .details-table td {
        padding: 10px 0;
        font-size: 14px;
    }
    .details-table td:first-child {
        color: #555;
        font-weight: 500;
    }
    .details-table td:last-child {
        text-align: right;
        color: #333;
    }
    .business-info-map {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 12px;
    }
    .business-info-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 8px;
        font-size: 13px;
        color: #555;
    }
    .business-info-item i {
        color: #c41040;
        margin-top: 3px;
        min-width: 16px;
    }
    .stat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
    }
    .stat-item:last-child {
        border-bottom: none;
    }
    .stat-item .stat-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #555;
    }
    .stat-item .stat-value {
        font-weight: 600;
        color: #333;
    }
    .author-card {
        text-align: center;
        padding: 15px 0;
    }
    .author-card img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }
    .sidebar-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .sidebar-card .card-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sidebar-card .card-title i {
        color: #c41040;
    }
    .feedback-rating {
        display: flex;
        gap: 3px;
    }
    .feedback-rating i {
        color: #c41040;
        cursor: pointer;
        font-size: 16px;
    }
    .social-icons {
        display: flex;
        gap: 8px;
    }
    .social-icons a {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .social-icons a:hover {
        background: #c41040;
        border-color: #c41040;
        color: #fff;
    }
    .star-rating {
        color: #f5a623;
        font-size: 12px;
    }
    .star-rating .empty {
        color: #ddd;
    }
    @media (max-width: 768px) {
        .feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        .listing-hero img {
            height: 300px;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Image Section -->
<section class="listing-hero">
    <img src="{{ $listing->images->count() > 0 ? asset('storage/' . $listing->images->first()->image_path) : asset('images/default-listing.png') }}"
         id="heroImage" alt="{{ $listing->title }}">
    @if($listing->images->count() > 1)
    <button class="show-photos-btn" onclick="document.getElementById('gallerySection').scrollIntoView({behavior:'smooth'})">
        <i class="fas fa-camera"></i> Show Photos
    </button>
    @endif
</section>

<!-- Title Section -->
<section class="listing-title-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $listing->user->avatar ? asset('storage/' . $listing->user->avatar) : asset('images/default-avatar.png') }}"
                     class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                <div>
                    <h2>{{ $listing->title }}</h2>
                    <p class="subtitle mb-1">{{ $listing->description ? Str::limit(strip_tags($listing->description), 60) : 'Listing in ' . ($listing->location ?? 'N/A') }}</p>
                    <div class="star-rating">
                        @php $avgRating = round($listing->averageRating() ?? 0, 1); @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $avgRating ? '' : 'empty' }}"></i>
                        @endfor
                        <span class="text-muted ms-1">{{ $avgRating }}</span>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <div class="price-tag">${{ number_format($listing->price) }}</div>
                <div class="price-label">Fixed</div>
            </div>
        </div>
    </div>
</section>

<!-- Action Bar -->
<section class="container">
    <div class="listing-action-bar">
        <a href="#"><i class="fas fa-map-marker-alt"></i> Get Directions</a>
        @if($listing->website)
        <a href="{{ $listing->website }}" target="_blank"><i class="fas fa-globe"></i> Website</a>
        @else
        <a href="#"><i class="fas fa-globe"></i> Website</a>
        @endif
        <a href="#" onclick="navigator.share && navigator.share({title:'{{ $listing->title }}', url:window.location.href})"><i class="fas fa-share-alt"></i> Share</a>
        <a href="#reviewSection"><i class="fas fa-pen"></i> Write A Review</a>
        <a href="#"><i class="fas fa-flag"></i> Report</a>
        @auth
        <a href="#" onclick="event.preventDefault(); document.getElementById('bookmarkForm').submit();">
            <i class="fas fa-bookmark"></i> Save
        </a>
        <form id="bookmarkForm" action="{{ url('/user/bookmark/' . $listing->id) }}" method="POST" style="display:none;">@csrf</form>
        @else
        <a href="{{ url('/login') }}"><i class="fas fa-bookmark"></i> Save</a>
        @endauth
        @if($listing->phone)
        <a href="tel:{{ $listing->phone }}" class="btn btn-call-now">
            <i class="fas fa-phone-alt"></i> Call Now
        </a>
        @else
        <a href="#" class="btn btn-call-now">
            <i class="fas fa-phone-alt"></i> Call Now
        </a>
        @endif
    </div>
</section>

<!-- Main Content -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">

                <!-- Description -->
                <div class="mb-4 pb-3">
                    <h4 class="section-title"><i class="fas fa-file-alt"></i> Description</h4>
                    <div class="text-muted" style="font-size:14px; line-height:1.8;">
                        {!! nl2br(e($listing->description)) !!}
                    </div>
                </div>

                <!-- Listing Features -->
                <div class="mb-4 pb-3">
                    <h4 class="section-title"><i class="fas fa-list"></i> Listing Features</h4>
                    <div class="feature-grid">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-bed"></i></div>
                            <span>Room<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-bath"></i></div>
                            <span>Bathroom<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-tv"></i></div>
                            <span>Media & Technology<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                            <span>Food & Security<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-concierge-bell"></i></div>
                            <span>Services & Extra<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-tree"></i></div>
                            <span>Outdoor & View<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-wheelchair"></i></div>
                            <span>Accessibility<br>amenities</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                            <span>Safety & Security<br>amenities</span>
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
                <div class="mb-4 pb-3" id="gallerySection">
                    <h4 class="section-title"><i class="fas fa-images"></i> Gallery</h4>
                    <div class="gallery-grid">
                        @if($listing->images->count() > 0)
                            @foreach($listing->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery"
                                 onclick="document.getElementById('heroImage').src=this.src; window.scrollTo({top:0, behavior:'smooth'});">
                            @endforeach
                        @else
                            @for($i = 0; $i < 10; $i++)
                            <img src="{{ asset('images/default-listing.png') }}" alt="Gallery placeholder">
                            @endfor
                        @endif
                    </div>
                </div>

                <!-- Ratings -->
                <div class="mb-4 pb-3 ratings-section">
                    <h4 class="section-title"><i class="fas fa-star" style="color:#f5a623;"></i> Ratings</h4>
                    <div class="rating-overview">
                        <div class="rating-number">
                            <div class="score">{{ $avgRating }}/5</div>
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $avgRating ? '' : 'empty' }}"></i>
                                @endfor
                            </div>
                            <div class="text-muted mt-1" style="font-size:12px;">OVERALL</div>
                            <div class="star-rating mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $avgRating ? '' : 'empty' }}"></i>
                                @endfor
                            </div>
                            <div class="text-muted" style="font-size:11px;">Based on Listing</div>
                        </div>
                        <div class="rating-bars">
                            @php
                                $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                                $totalReviews = $listing->reviews->count();
                                foreach($listing->reviews as $r) {
                                    if(isset($ratingCounts[$r->rating])) {
                                        $ratingCounts[$r->rating]++;
                                    }
                                }
                            @endphp
                            @for($star = 5; $star >= 1; $star--)
                            <div class="rating-bar-row">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $star ? '' : 'empty' }}" style="{{ $i > $star ? 'color:#ddd;' : '' }}"></i>
                                    @endfor
                                </div>
                                <div class="bar">
                                    <div class="bar-fill" style="width: {{ $totalReviews > 0 ? ($ratingCounts[$star] / $totalReviews * 100) : 0 }}%;"></div>
                                </div>
                                <div class="count">{{ $ratingCounts[$star] }}</div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Write a Review / Reviews -->
                <div class="mb-4" id="reviewSection">
                    <h4 class="section-title"><i class="fas fa-pen"></i> Write a Review</h4>

                    @foreach($listing->reviews as $review)
                    <div class="review-card">
                        <div class="d-flex gap-3">
                            <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('images/default-avatar.png') }}"
                                 class="review-author-img" alt="{{ $review->user->name }}">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? '' : 'empty' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="text-muted" style="font-size:12px;">
                                    <i class="fas fa-clock"></i> {{ $review->created_at->diffForHumans() }}
                                    <span class="ms-2">by {{ $review->user->name }}</span>
                                </div>
                                <p class="mt-2 mb-0" style="font-size:14px; color:#555;">{{ $review->comment }}</p>
                                <div class="review-actions">
                                    <span>Was This Review...?</span>
                                    <a href="#"><i class="fas fa-thumbs-up"></i> Like</a>
                                    <a href="#"><i class="fas fa-thumbs-down"></i> Dislike</a>
                                    <a href="#" class="ms-auto"><i class="fas fa-reply"></i> Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Leave Feedback Form -->
                <div class="mb-4 pb-4">
                    <h4 class="section-title">Leave feedback about this</h4>
                    <form action="{{ url('/reviews/' . $listing->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Title">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Name*" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email*" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="4" placeholder="Write a Review*" required></textarea>
                        </div>
                        <div class="mb-3 d-flex align-items-center gap-2">
                            <span style="font-size:14px;">Rating</span>
                            <div class="feedback-rating">
                                @for($i = 5; $i >= 1; $i--)
                                <i class="fas fa-star" data-rating="{{ $i }}" onclick="document.querySelector('[name=rating]').value={{ $i }}; this.parentElement.querySelectorAll('i').forEach((s,idx) => s.style.color = (5-idx) <= {{ $i }} ? '#c41040' : '#ddd');"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" value="5">
                        </div>
                        <button type="submit" class="btn btn-danger px-4">Submit Review</button>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">

                <!-- Details -->
                <div class="sidebar-card">
                    <div class="card-title"><i class="fas fa-info-circle"></i> Details</div>
                    <table class="details-table">
                        <tr>
                            <td>Contract</td>
                            <td>{{ $listing->is_featured ? 'Featured' : 'For Rent' }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ $listing->location ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td>Year Built</td>
                            <td>{{ $listing->created_at->format('Y') }}</td>
                        </tr>
                        <tr>
                            <td>Rooms</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Beds</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>Baths</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td>Gadgets</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>Home Area</td>
                            <td>30sqft</td>
                        </tr>
                        <tr>
                            <td>Lot Dimensions</td>
                            <td>30*50*20 ft</td>
                        </tr>
                        <tr>
                            <td>Lot Area</td>
                            <td>50 ft</td>
                        </tr>
                    </table>
                </div>

                <!-- Business Info -->
                <div class="sidebar-card">
                    <div class="card-title"><i class="fas fa-building"></i> Business Info</div>
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ urlencode($listing->location ?? 'New York') }}&zoom=14&size=400x120&maptype=roadmap&key="
                         alt="Map" class="business-info-map"
                         onerror="this.src='https://via.placeholder.com/400x120/e9ecef/999?text=Map';">
                    <div class="business-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $listing->location ?? '684a, Ellis St, San Francisco, CA 94102, United States' }}</span>
                    </div>
                    @if($listing->phone)
                    <div class="business-info-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ $listing->phone }}</span>
                    </div>
                    @endif
                    @if($listing->email)
                    <div class="business-info-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $listing->email }}</span>
                    </div>
                    @endif
                    @if($listing->website)
                    <div class="business-info-item">
                        <i class="fas fa-globe"></i>
                        <span>{{ $listing->website }}</span>
                    </div>
                    @endif
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Statistic -->
                <div class="sidebar-card">
                    <div class="card-title"><i class="fas fa-chart-bar"></i> Statistic</div>
                    <div class="stat-item">
                        <span class="stat-label"><i class="fas fa-eye text-muted"></i> Views</span>
                        <span class="stat-value">{{ number_format($listing->views ?? 0) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label"><i class="fas fa-star text-muted"></i> Ratings</span>
                        <span class="stat-value">{{ $listing->reviews->count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label"><i class="fas fa-heart text-muted"></i> Favourites</span>
                        <span class="stat-value">{{ $listing->bookmarks->count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label"><i class="fas fa-share-alt text-muted"></i> Shares</span>
                        <span class="stat-value">0</span>
                    </div>
                </div>

                <!-- Author -->
                <div class="sidebar-card">
                    <div class="card-title"><i class="fas fa-user"></i> Author</div>
                    <div class="author-card">
                        <img src="{{ $listing->user->avatar ? asset('storage/' . $listing->user->avatar) : asset('images/default-avatar.png') }}"
                             alt="{{ $listing->user->name }}">
                        <h6 class="fw-bold mb-1">{{ $listing->user->name }}</h6>
                        <p class="text-muted mb-0" style="font-size:13px;">
                            <i class="fas fa-calendar-alt"></i> Member since {{ $listing->user->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>

                <!-- Contact Business -->
                <div class="sidebar-card">
                    <div class="card-title"><i class="fas fa-envelope"></i> Contact Business</div>
                    <form action="{{ url('/messages') }}" method="POST">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <input type="hidden" name="receiver_id" value="{{ $listing->user_id }}">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star rating interactive
    const ratingStars = document.querySelectorAll('.feedback-rating i');
    ratingStars.forEach(function(star) {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            document.querySelector('[name=rating]').value = rating;
            ratingStars.forEach(function(s, idx) {
                s.style.color = (5 - idx) <= rating ? '#c41040' : '#ddd';
            });
        });
    });
});
</script>
@endpush

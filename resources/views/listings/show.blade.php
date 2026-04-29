@extends('layouts.app')

@section('title', $listing->title . ' - Listee')

@section('content')

<!-- Breadcrumb -->
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/listings') }}">Listings</a></li>
                <li class="breadcrumb-item active">{{ $listing->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Left Column: Images & Details -->
            <div class="col-lg-8">

                <!-- Image Gallery -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="main-image mb-3">
                            <img src="{{ $listing->images->count() > 0 ? asset('storage/' . $listing->images->first()->image_path) : asset('images/default-listing.png') }}"
                                 class="img-fluid rounded w-100" id="mainImage"
                                 style="height: 400px; object-fit: cover;" alt="{{ $listing->title }}">
                        </div>
                        <div class="d-flex gap-2 overflow-auto">
                            @foreach($listing->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 class="rounded thumbnail-img" width="80" height="60"
                                 style="object-fit: cover; cursor: pointer; border: 2px solid transparent;"
                                 onclick="document.getElementById('mainImage').src=this.src; document.querySelectorAll('.thumbnail-img').forEach(i=>i.style.borderColor='transparent'); this.style.borderColor='#dc3545';">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Listing Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="fw-bold">{{ $listing->title }}</h2>
                                <div class="d-flex gap-3 text-muted mb-3 flex-wrap">
                                    <span><i class="fas fa-tag text-danger"></i> {{ $listing->category->name ?? 'N/A' }}</span>
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $listing->location }}</span>
                                    <span><i class="fas fa-calendar"></i> {{ $listing->created_at->format('d M, Y') }}</span>
                                    <span><i class="fas fa-eye"></i> {{ $listing->views ?? 0 }} views</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <h3 class="text-danger fw-bold">${{ number_format($listing->price) }}</h3>

                            </div>
                        </div>
                        @if($listing->is_featured)
                            <span class="badge bg-success">Featured</span>
                        @endif

                    </div>
                </div>

                <!-- Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Description</h4>
                        <div class="listing-description">
                            {!! nl2br(e($listing->description)) !!}
                        </div>
                    </div>
                </div>



                <!-- Reviews Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Reviews ({{ $listing->reviews->count() }})</h4>

                        @foreach($listing->reviews as $review)
                        <div class="d-flex mb-4 pb-3 border-bottom">
                            <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('images/default-avatar.png') }}"
                                 class="rounded-circle me-3" width="50" height="50">
                            <div>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted mt-2 mb-0">{{ $review->comment }}</p>
                            </div>
                        </div>
                        @endforeach

                        @auth
                        <h5 class="fw-bold mt-4">Write a Review</h5>
                        <form action="{{ url('/reviews/' . $listing->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <select name="rating" class="form-select" style="width: 150px;" required>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Comment</label>
                                <textarea name="comment" class="form-control" rows="4"
                                          placeholder="আপনার মতামত লিখুন..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger">Submit Review</button>
                        </form>
                        @else
                        <p class="text-muted mt-3">
                            রিভিউ দিতে <a href="{{ url('/login') }}" class="text-danger">Login</a> করুন।
                        </p>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Right Column: Seller Info & Contact -->
            <div class="col-lg-4">

                <!-- Seller Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $listing->user->avatar ? asset('storage/' . $listing->user->avatar) : asset('images/default-avatar.png') }}"
                             class="rounded-circle mb-3" width="80" height="80">
                        <h5 class="fw-bold">{{ $listing->user->name }}</h5>
                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $listing->user->location ?? 'N/A' }}</p>
                        <p class="text-muted">
                            <i class="fas fa-calendar"></i> Member since {{ $listing->user->created_at->format('M Y') }}
                        </p>
                        @if($listing->user->phone)
                        <a href="tel:{{ $listing->user->phone }}" class="btn btn-danger w-100">
                            <i class="fas fa-phone"></i> Call Seller
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Contact Seller Form -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Contact Seller</h5>
                        <form action="{{ url('/messages') }}" method="POST">
                            @csrf
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                            <input type="hidden" name="receiver_id" value="{{ $listing->user_id }}">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control" rows="4"
                                          placeholder="আপনার মেসেজ লিখুন..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Share -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Share This</h5>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}"
                               class="btn btn-info btn-sm" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode(request()->url()) }}"
                               class="btn btn-success btn-sm" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Listings -->
        @if(isset($relatedListings) && $relatedListings->count() > 0)
        <div class="mt-5">
            <h3 class="fw-bold mb-4">Related Listings</h3>
            <div class="row g-4">
                @foreach($relatedListings as $ad)
                <div class="col-lg-3 col-md-6">
                    @include('listings._card', ['listing' => $ad])
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
@extends('layouts.app')

@section('title', 'My Reviews - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'My Reviews',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'Reviews']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">
                {{-- Reviews Summary --}}
                <div class="dashboard-card mb-4">
                    <div class="reviews-summary">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <div class="avg-rating">
                                    <h2>{{ number_format($avgRating ?? 0, 1) }}</h2>
                                    <div class="stars-display">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa{{ $i <= round($avgRating ?? 0) ? 's' : 'r' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <p>{{ $totalReviews ?? 0 }} Total Reviews</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-bars">
                                    @for($star = 5; $star >= 1; $star--)
                                        @php
                                            $count = $ratingCounts[$star] ?? 0;
                                            $percentage = ($totalReviews ?? 0) > 0 ? ($count / $totalReviews) * 100 : 0;
                                        @endphp
                                        <div class="rating-bar-row">
                                            <span class="star-label">{{ $star }} <i class="fas fa-star"></i></span>
                                            <div class="bar-track">
                                                <div class="bar-fill" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="bar-count">{{ $count }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabs: Received / Given --}}
                <div class="dashboard-card">
                    <div class="review-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#receivedReviews">
                                    <i class="fas fa-inbox me-1"></i> Received ({{ $receivedReviews->count() ?? 0 }})
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#givenReviews">
                                    <i class="fas fa-pen me-1"></i> Given ({{ $givenReviews->count() ?? 0 }})
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        {{-- Received Reviews --}}
                        <div class="tab-pane fade show active" id="receivedReviews">
                            @forelse($receivedReviews ?? [] as $review)
                                <div class="review-card">
                                    <div class="review-card-header">
                                        <div class="reviewer-info">
                                            <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('images/default-avatar.png') }}" 
                                                 alt="{{ $review->user->name }}">
                                            <div>
                                                <strong>{{ $review->user->name }}</strong>
                                                <small class="d-block text-muted">{{ $review->created_at->format('d M, Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- Listing Reference --}}
                                    @if($review->listing)
                                        <div class="review-listing-ref">
                                            <i class="fas fa-tag"></i>
                                            <a href="{{ route('listings.show', $review->listing->slug) }}">
                                                {{ $review->listing->title }}
                                            </a>
                                        </div>
                                    @endif
                                    <p class="review-text">{{ $review->comment }}</p>
                                    
                                    {{-- Reply --}}
                                    @if($review->reply)
                                        <div class="review-reply">
                                            <strong><i class="fas fa-reply me-1"></i> Your Reply:</strong>
                                            <p>{{ $review->reply }}</p>
                                        </div>
                                    @else
                                        <button class="btn btn-sm btn-outline-secondary btn-reply-toggle" 
                                                data-review-id="{{ $review->id }}">
                                            <i class="fas fa-reply me-1"></i> Reply
                                        </button>
                                        <div class="reply-form" id="replyForm-{{ $review->id }}" style="display:none;">
                                            <form action="{{ route('user.reviews.reply', $review->id) }}" method="POST">
                                                @csrf
                                                <textarea name="reply" class="form-control mb-2" rows="2" 
                                                          placeholder="Write your reply..." required></textarea>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-paper-plane me-1"></i> Send Reply
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state text-center py-5">
                                    <i class="far fa-star fa-3x text-muted mb-3"></i>
                                    <h5>No Reviews Received</h5>
                                    <p class="text-muted">You haven't received any reviews yet.</p>
                                </div>
                            @endforelse

                            @if(($receivedReviews ?? collect())->hasPages())
                                <div class="pagination-wrapper mt-3">
                                    {{ $receivedReviews->links() }}
                                </div>
                            @endif
                        </div>

                        {{-- Given Reviews --}}
                        <div class="tab-pane fade" id="givenReviews">
                            @forelse($givenReviews ?? [] as $review)
                                <div class="review-card">
                                    <div class="review-card-header">
                                        <div class="reviewer-info">
                                            <img src="{{ $review->listing->user->avatar ?? asset('images/default-avatar.png') }}" 
                                                 alt="">
                                            <div>
                                                <strong>{{ $review->listing->title ?? 'Listing' }}</strong>
                                                <small class="d-block text-muted">{{ $review->created_at->format('d M, Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="review-text">{{ $review->comment }}</p>
                                    <div class="review-actions">
                                        <a href="{{ route('listings.show', $review->listing->slug ?? '') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="far fa-eye me-1"></i> View Listing
                                        </a>
                                        <form action="{{ route('user.reviews.delete', $review->id) }}" method="POST" 
                                              onsubmit="return confirm('Delete this review?')" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="far fa-trash-alt me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state text-center py-5">
                                    <i class="far fa-edit fa-3x text-muted mb-3"></i>
                                    <h5>No Reviews Given</h5>
                                    <p class="text-muted">You haven't reviewed any listings yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.reviews-summary {
    padding: 10px 0;
}
.avg-rating h2 {
    font-size: 48px;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}
.stars-display i {
    color: #FFC107;
    font-size: 18px;
}
.avg-rating p {
    font-size: 13px;
    color: #888;
    margin-top: 5px;
}
.rating-bars {
    padding: 10px 0;
}
.rating-bar-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}
.star-label {
    font-size: 13px;
    color: #666;
    min-width: 35px;
    text-align: right;
}
.star-label i {
    color: #FFC107;
    font-size: 11px;
}
.bar-track {
    flex: 1;
    height: 8px;
    background: #f0f0f0;
    border-radius: 4px;
    overflow: hidden;
}
.bar-fill {
    height: 100%;
    background: #FFC107;
    border-radius: 4px;
    transition: width 0.5s ease;
}
.bar-count {
    font-size: 12px;
    color: #888;
    min-width: 25px;
}
.review-tabs .nav-tabs {
    border-bottom: 2px solid #f0f0f0;
}
.review-tabs .nav-link {
    color: #888;
    font-size: 14px;
    font-weight: 600;
    border: none;
    padding: 12px 20px;
}
.review-tabs .nav-link.active {
    color: #FF3B30;
    border-bottom: 2px solid #FF3B30;
    background: transparent;
}
.review-card {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}
.review-card:last-child {
    border-bottom: none;
}
.review-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}
.reviewer-info {
    display: flex;
    align-items: center;
    gap: 10px;
}
.reviewer-info img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
.reviewer-info strong {
    font-size: 14px;
}
.review-rating i {
    color: #FFC107;
    font-size: 13px;
}
.review-listing-ref {
    margin-bottom: 8px;
    font-size: 12px;
}
.review-listing-ref i {
    color: #FF3B30;
    margin-right: 4px;
}
.review-listing-ref a {
    color: #FF3B30;
    text-decoration: none;
}
.review-text {
    font-size: 13px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 10px;
}
.review-reply {
    background: #f8f9fa;
    padding: 12px 15px;
    border-radius: 8px;
    margin-top: 8px;
    border-left: 3px solid #FF3B30;
}
.review-reply strong {
    font-size: 12px;
    color: #555;
}
.review-reply p {
    font-size: 13px;
    color: #666;
    margin: 5px 0 0;
}
.btn-reply-toggle {
    font-size: 12px;
}
.reply-form {
    margin-top: 10px;
}
.reply-form textarea {
    font-size: 13px;
    border-radius: 8px;
}
.review-actions {
    display: flex;
    gap: 8px;
    margin-top: 5px;
}
</style>

@push('scripts')
<script>
document.querySelectorAll('.btn-reply-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var reviewId = this.dataset.reviewId;
        var form = document.getElementById('replyForm-' + reviewId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
        this.style.display = 'none';
    });
});
</script>
@endpush

@endsection
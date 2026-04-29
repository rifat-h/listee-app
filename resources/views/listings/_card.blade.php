<div class="card border-0 shadow-sm h-100 listing-card">
    <div class="position-relative">
        <img src="{{ $listing->image ? asset('storage/'.$listing->image) : asset('images/listing-default.jpg') }}"
             class="card-img-top" alt="{{ $listing->title }}" style="height: 200px; object-fit: cover;">
        @if($listing->is_featured)
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">Featured</span>
        @endif
        <span class="badge bg-dark position-absolute top-0 end-0 m-2">
            {{ $listing->category->name ?? 'General' }}
        </span>
    </div>
    <div class="card-body">
        <h6 class="card-title">
            <a href="{{ route('listings.show', $listing->slug) }}" class="text-dark text-decoration-none">
                {{ Str::limit($listing->title, 40) }}
            </a>
        </h6>
        <p class="text-muted small mb-2">
            <i class="fas fa-map-marker-alt text-danger"></i> {{ $listing->location }}
        </p>
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold text-danger fs-5">৳{{ number_format($listing->price) }}</span>
            <small class="text-muted">{{ $listing->created_at->diffForHumans() }}</small>
        </div>
    </div>
</div>
@extends('layouts.app')

@section('title', 'Gallery - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Gallery',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Gallery']
    ]
])

<section class="gallery-section py-5">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <span class="heading-badge">Gallery</span>
            <h2>Explore Our Gallery</h2>
            <p class="text-muted">Browse through photos from our community</p>
        </div>

        {{-- Filter Buttons --}}
        <div class="gallery-filters text-center mb-4">
            <button class="filter-btn active" data-filter="all">All</button>
            @isset($galleryCategories)
                @foreach($galleryCategories as $gCat)
                    <button class="filter-btn" data-filter="{{ Str::slug($gCat) }}">{{ $gCat }}</button>
                @endforeach
            @else
                <button class="filter-btn" data-filter="listings">Listings</button>
                <button class="filter-btn" data-filter="events">Events</button>
                <button class="filter-btn" data-filter="community">Community</button>
                <button class="filter-btn" data-filter="featured">Featured</button>
            @endisset
        </div>

        {{-- Gallery Grid --}}
        <div class="gallery-grid" id="galleryGrid">
            @forelse($galleryImages ?? [] as $image)
                <div class="gallery-item" data-category="{{ Str::slug($image->category ?? 'all') }}">
                    <div class="gallery-thumb">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title ?? 'Gallery Image' }}">
                        <div class="gallery-overlay">
                            <div class="overlay-content">
                                <a href="{{ asset('storage/' . $image->image) }}" class="btn-lightbox" data-lightbox="gallery">
                                    <i class="fas fa-expand"></i>
                                </a>
                                @if($image->listing)
                                    <a href="{{ route('listings.show', $image->listing->slug) }}" class="btn-view-listing">
                                        <i class="fas fa-link"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="overlay-info">
                                <h6>{{ $image->title ?? 'Untitled' }}</h6>
                                <span>{{ $image->category ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Demo Gallery Items --}}
                @for($i = 1; $i <= 12; $i++)
                    @php
                        $cats = ['listings', 'events', 'community', 'featured'];
                        $cat = $cats[($i - 1) % 4];
                    @endphp
                    <div class="gallery-item" data-category="{{ $cat }}">
                        <div class="gallery-thumb">
                            <img src="{{ asset('images/gallery/gallery-' . $i . '.jpg') }}" alt="Gallery {{ $i }}">
                            <div class="gallery-overlay">
                                <div class="overlay-content">
                                    <a href="{{ asset('images/gallery/gallery-' . $i . '.jpg') }}" class="btn-lightbox" data-lightbox="gallery">
                                        <i class="fas fa-expand"></i>
                                    </a>
                                </div>
                                <div class="overlay-info">
                                    <h6>Gallery Image {{ $i }}</h6>
                                    <span>{{ ucfirst($cat) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>

        {{-- Load More --}}
        @if(($galleryImages ?? collect())->hasPages())
            <div class="text-center mt-4">
                <button class="btn btn-load-more" id="loadMoreGallery">
                    <i class="fas fa-sync-alt me-1"></i> Load More
                </button>
            </div>
        @endif
    </div>
</section>

{{-- Lightbox Modal --}}
<div class="lightbox-modal" id="lightboxModal" style="display:none;">
    <div class="lightbox-backdrop"></div>
    <div class="lightbox-content">
        <button class="lightbox-close" id="lightboxClose"><i class="fas fa-times"></i></button>
        <button class="lightbox-prev" id="lightboxPrev"><i class="fas fa-chevron-left"></i></button>
        <button class="lightbox-next" id="lightboxNext"><i class="fas fa-chevron-right"></i></button>
        <img src="" alt="Lightbox Image" id="lightboxImage">
    </div>
</div>

<style>
.heading-badge {
    display: inline-block;
    background: #FFF5F5;
    color: #FF3B30;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
}
.section-heading h2 {
    font-size: 28px;
    font-weight: 700;
}
.gallery-filters {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
}
.filter-btn {
    padding: 7px 20px;
    border-radius: 20px;
    border: 1px solid #e0e0e0;
    background: #fff;
    color: #666;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}
.filter-btn.active,
.filter-btn:hover {
    background: #FF3B30;
    color: #fff;
    border-color: #FF3B30;
}
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}
.gallery-item {
    transition: all 0.4s ease;
}
.gallery-item.hide {
    display: none;
}
.gallery-thumb {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    aspect-ratio: 1;
}
.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.gallery-thumb:hover img {
    transform: scale(1.1);
}
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.gallery-thumb:hover .gallery-overlay {
    opacity: 1;
}
.overlay-content {
    display: flex;
    gap: 10px;
    margin-bottom: auto;
    margin-top: auto;
}
.overlay-content a {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: background 0.3s;
    border: 1px solid rgba(255,255,255,0.3);
}
.overlay-content a:hover {
    background: #FF3B30;
    border-color: #FF3B30;
}
.overlay-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 12px 15px;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
}
.overlay-info h6 {
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 2px;
}
.overlay-info span {
    color: rgba(255,255,255,0.7);
    font-size: 11px;
}
.btn-load-more {
    background: #FF3B30;
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-weight: 600;
}
.btn-load-more:hover {
    background: #E0352B;
    color: #fff;
}
/* Lightbox */
.lightbox-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
.lightbox-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
}
.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90vh;
}
.lightbox-content img {
    max-width: 100%;
    max-height: 85vh;
    border-radius: 8px;
}
.lightbox-close,
.lightbox-prev,
.lightbox-next {
    position: absolute;
    background: rgba(255,255,255,0.1);
    border: none;
    color: #fff;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.lightbox-close { top: -50px; right: 0; }
.lightbox-prev { left: -60px; top: 50%; transform: translateY(-50%); }
.lightbox-next { right: -60px; top: 50%; transform: translateY(-50%); }
.lightbox-close:hover,
.lightbox-prev:hover,
.lightbox-next:hover {
    background: #FF3B30;
}
@media (max-width: 991px) {
    .gallery-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .lightbox-prev { left: 10px; }
    .lightbox-next { right: 10px; }
}
@media (max-width: 480px) {
    .gallery-grid { grid-template-columns: 1fr; }
}
</style>

@push('scripts')
<script>
// Filter
document.querySelectorAll('.filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        var filter = this.dataset.filter;
        document.querySelectorAll('.gallery-item').forEach(function(item) {
            if (filter === 'all' || item.dataset.category === filter) {
                item.classList.remove('hide');
            } else {
                item.classList.add('hide');
            }
        });
    });
});

// Lightbox
var currentIndex = 0;
var images = [];

document.querySelectorAll('.btn-lightbox').forEach(function(btn, index) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        images = Array.from(document.querySelectorAll('.gallery-item:not(.hide) .btn-lightbox')).map(a => a.href);
        currentIndex = images.indexOf(this.href);
        openLightbox(this.href);
    });
});

function openLightbox(src) {
    document.getElementById('lightboxImage').src = src;
    document.getElementById('lightboxModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightboxModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('lightboxClose')?.addEventListener('click', closeLightbox);
document.querySelector('.lightbox-backdrop')?.addEventListener('click', closeLightbox);

document.getElementById('lightboxPrev')?.addEventListener('click', function() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    document.getElementById('lightboxImage').src = images[currentIndex];
});

document.getElementById('lightboxNext')?.addEventListener('click', function() {
    currentIndex = (currentIndex + 1) % images.length;
    document.getElementById('lightboxImage').src = images[currentIndex];
});

document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightboxModal').style.display === 'flex') {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') document.getElementById('lightboxPrev').click();
        if (e.key === 'ArrowRight') document.getElementById('lightboxNext').click();
    }
});
</script>
@endpush

@endsection
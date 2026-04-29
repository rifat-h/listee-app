@extends('layouts.app')

@section('title', 'Listings List with Map - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Listings with Map',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Listings']
    ]
])

<section class="listing-map-section">
    <div class="container-fluid px-0">
        <div class="row g-0">

            {{-- Map Area --}}
            <div class="col-lg-6">
                <div class="map-container" id="listingMap">
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>Map Loading...</p>
                    </div>
                </div>
            </div>

            {{-- Listings List --}}
            <div class="col-lg-6">
                <div class="map-listings-wrapper">
                    {{-- Toolbar --}}
                    <div class="listing-toolbar px-3 py-2">
                        <div class="toolbar-left">
                            <p class="result-count mb-0">
                                <strong>{{ $listings->total() ?? 0 }}</strong> results found
                            </p>
                        </div>
                        <div class="toolbar-right">
                            <select name="sort" class="form-control form-control-sm"
                                    onchange="window.location.href='{{ route('listings.index') }}?sort='+this.value+'&view=list-map'">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High</option>
                            </select>
                            <div class="view-toggles">
                                <a href="{{ route('listings.grid-map') }}"><i class="fas fa-th"></i></a>
                                <a href="{{ route('listings.list-map') }}" class="active"><i class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- Scrollable List --}}
                    <div class="map-listings-scroll">
                        <div class="p-3">
                            @forelse($listings as $listing)
                                <div class="list-map-card mb-3 listing-item" 
                                     data-lat="{{ $listing->latitude }}" 
                                     data-lng="{{ $listing->longitude }}"
                                     data-id="{{ $listing->id }}">
                                    <div class="row g-0">
                                        {{-- Image --}}
                                        <div class="col-4">
                                            <div class="list-map-img">
                                                <a href="{{ route('listings.show', $listing->slug) }}">
                                                    <img src="{{ asset('storage/' . ($listing->image ?? 'images/no-image.jpg')) }}" 
                                                         alt="{{ $listing->title }}">
                                                </a>
                                                @if($listing->is_featured)
                                                    <span class="badge-featured">Featured</span>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Info --}}
                                        <div class="col-8">
                                            <div class="list-map-body">
                                                <span class="category-tag">
                                                    {{ $listing->category->name ?? 'Uncategorized' }}
                                                </span>
                                                <h5 class="list-map-title">
                                                    <a href="{{ route('listings.show', $listing->slug) }}">
                                                        {{ $listing->title }}
                                                    </a>
                                                </h5>
                                                <p class="list-map-location">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $listing->location ?? 'N/A' }}
                                                </p>
                                                <div class="list-map-bottom">
                                                    <span class="list-map-price">৳{{ number_format($listing->price) }}</span>
                                                    <span class="list-map-date">
                                                        <i class="far fa-clock"></i> {{ $listing->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state text-center py-5">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h5>No Listings Found</h5>
                                    <p class="text-muted">Try adjusting your filters.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($listings->hasPages())
                            <div class="pagination-wrapper text-center pb-3">
                                {{ $listings->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.listing-map-section {
    min-height: calc(100vh - 80px);
}
.map-container {
    position: sticky;
    top: 0;
    height: calc(100vh - 80px);
    background: #e8e8e8;
}
.map-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #aaa;
}
.map-placeholder i {
    font-size: 48px;
    margin-bottom: 10px;
}
.map-listings-wrapper {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 80px);
}
.map-listings-scroll {
    flex: 1;
    overflow-y: auto;
}
.listing-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-bottom: 1px solid #e8e8e8;
    flex-wrap: wrap;
    gap: 8px;
}
.result-count {
    font-size: 13px;
    color: #888;
}
.toolbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
}
.toolbar-right .form-control-sm {
    width: auto;
    height: 34px;
    border-radius: 6px;
    font-size: 12px;
}
.view-toggles a {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e8e8e8;
    border-radius: 6px;
    color: #999;
    text-decoration: none;
    transition: all 0.3s;
}
.view-toggles a.active,
.view-toggles a:hover {
    background: #FF3B30;
    border-color: #FF3B30;
    color: #fff;
}
.list-map-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.list-map-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border-color: #FF3B30;
}
.list-map-img {
    position: relative;
    height: 100%;
    min-height: 140px;
}
.list-map-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.list-map-img .badge-featured {
    position: absolute;
    top: 8px;
    left: 8px;
    background: #FF3B30;
    color: #fff;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 600;
}
.list-map-body {
    padding: 15px;
}
.list-map-body .category-tag {
    font-size: 11px;
    color: #FF3B30;
    background: #FFF5F5;
    padding: 2px 8px;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 6px;
}
.list-map-title {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.3;
}
.list-map-title a {
    color: #333;
    text-decoration: none;
}
.list-map-title a:hover {
    color: #FF3B30;
}
.list-map-location {
    font-size: 12px;
    color: #888;
    margin-bottom: 8px;
}
.list-map-location i {
    color: #FF3B30;
    margin-right: 4px;
}
.list-map-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 8px;
}
.list-map-price {
    font-size: 16px;
    font-weight: 700;
    color: #FF3B30;
}
.list-map-date {
    font-size: 11px;
    color: #999;
}
.listing-item.active .list-map-card {
    border-color: #FF3B30;
    box-shadow: 0 0 0 2px rgba(255,59,48,0.2);
}
@media (max-width: 991px) {
    .map-container {
        height: 300px;
        position: relative;
    }
    .map-listings-wrapper {
        height: auto;
    }
}
</style>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.map-placeholder')?.remove();

    var map = L.map('listingMap').setView([23.8103, 90.4125], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];
    document.querySelectorAll('.listing-item').forEach(function(item) {
        var lat = parseFloat(item.dataset.lat);
        var lng = parseFloat(item.dataset.lng);
        if (lat && lng) {
            var marker = L.marker([lat, lng]).addTo(map);
            var title = item.querySelector('.list-map-title a')?.textContent || 'Listing';
            marker.bindPopup(title);
            markers.push(marker);

            item.addEventListener('mouseenter', function() {
                marker.openPopup();
                item.classList.add('active');
            });
            item.addEventListener('mouseleave', function() {
                marker.closePopup();
                item.classList.remove('active');
            });
        }
    });

    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endpush

@endsection
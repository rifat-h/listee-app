@extends('layouts.app')

@section('title', 'Listings Grid with Map - Listee')

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
                    {{-- Leaflet/Google Map loads here --}}
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>Map Loading...</p>
                    </div>
                </div>
            </div>

            {{-- Listings Grid --}}
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
                                    onchange="window.location.href='{{ route('listings.index') }}?sort='+this.value+'&view=grid-map'">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High</option>
                            </select>
                            <div class="view-toggles">
                                <a href="{{ route('listings.grid-map') }}" class="active"><i class="fas fa-th"></i></a>
                                <a href="{{ route('listings.list-map') }}"><i class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- Scrollable Grid --}}
                    <div class="map-listings-scroll">
                        <div class="row g-3 p-3">
                            @forelse($listings as $listing)
                                <div class="col-md-6 listing-item" 
                                     data-lat="{{ $listing->latitude }}" 
                                     data-lng="{{ $listing->longitude }}"
                                     data-id="{{ $listing->id }}">
                                    @include('listings._card', ['listing' => $listing])
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                        <h5>No Listings Found</h5>
                                        <p class="text-muted">Try adjusting your filters.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
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
.listing-item:hover {
    cursor: pointer;
}
.listing-item.active .card,
.listing-item.active .ad-card {
    border-color: #FF3B30;
    box-shadow: 0 0 0 2px rgba(255,59,48,0.2);
}
@media (max-width: 991px) {
    .map-container {
        height: 350px;
        position: relative;
    }
    .map-listings-wrapper {
        height: auto;
    }
}
</style>

{{-- Leaflet Map Integration --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove placeholder
    document.querySelector('.map-placeholder')?.remove();

    // Initialize map
    var map = L.map('listingMap').setView([23.8103, 90.4125], 12); // Dhaka default

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add markers from listings
    var markers = [];
    document.querySelectorAll('.listing-item').forEach(function(item) {
        var lat = parseFloat(item.dataset.lat);
        var lng = parseFloat(item.dataset.lng);
        if (lat && lng) {
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(item.querySelector('.card-title, h5, h4')?.textContent || 'Listing');
            markers.push(marker);

            // Highlight on hover
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

    // Fit bounds if markers exist
    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endpush

@endsection
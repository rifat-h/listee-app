@extends('layouts.app')

@section('title', 'Listings List with Sidebar - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Listings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Listings']
    ]
])

<section class="listing-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar Filter (same as grid-sidebar) --}}
            <div class="col-lg-4 col-md-5">
                <div class="sidebar-filter">
                    <div class="filter-card">
                        <h5 class="filter-title">Search</h5>
                        <form action="{{ route('listings.index') }}" method="GET">
                            <input type="text" name="keyword" class="form-control" 
                                   placeholder="Search listings..." value="{{ request('keyword') }}">
                        </form>
                    </div>

                    <div class="filter-card">
                        <h5 class="filter-title">Categories</h5>
                        <ul class="category-filter-list">
                            @isset($categories)
                                @foreach($categories as $cat)
                                    <li>
                                        <a href="{{ route('listings.index', ['category' => $cat->slug]) }}" 
                                           class="{{ request('category') == $cat->slug ? 'active' : '' }}">
                                            <i class="{{ $cat->icon ?? 'fas fa-folder' }}"></i>
                                            {{ $cat->name }}
                                            <span class="count">({{ $cat->listings_count ?? 0 }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>

                    <div class="filter-card">
                        <h5 class="filter-title">Location</h5>
                        <select name="location" class="form-control" 
                                onchange="window.location.href='{{ route('listings.index') }}?location='+this.value">
                            <option value="">All Locations</option>
                            @isset($locations)
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="filter-card">
                        <h5 class="filter-title">Price Range</h5>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" 
                                       placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" 
                                       placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Listings List View --}}
            <div class="col-lg-8 col-md-7">
                {{-- Toolbar --}}
                <div class="listing-toolbar">
                    <div class="toolbar-left">
                        <p class="result-count mb-0">
                            Showing <strong>{{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }}</strong> 
                            of <strong>{{ $listings->total() ?? 0 }}</strong> results
                        </p>
                    </div>
                    <div class="toolbar-right">
                        <select name="sort" class="form-control form-control-sm" 
                                onchange="window.location.href='{{ route('listings.index') }}?sort='+this.value">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <div class="view-toggles">
                            <a href="{{ route('listings.grid-sidebar') }}"><i class="fas fa-th"></i></a>
                            <a href="{{ route('listings.list-sidebar') }}" class="active"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                {{-- List Items --}}
                @forelse($listings as $listing)
                    <div class="list-card mb-3">
                        <div class="row g-0">
                            {{-- Image --}}
                            <div class="col-md-4">
                                <div class="list-card-img">
                                    <a href="{{ route('listings.show', $listing->slug) }}">
                                        <img src="{{ asset('storage/' . ($listing->image ?? 'images/no-image.jpg')) }}" 
                                             alt="{{ $listing->title }}" class="img-fluid">
                                    </a>
                                    @if($listing->is_featured)
                                        <span class="badge-featured">Featured</span>
                                    @endif
                                    <button class="btn-bookmark" title="Bookmark">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- Content --}}
                            <div class="col-md-8">
                                <div class="list-card-body">
                                    <div class="list-card-top">
                                        <span class="category-tag">
                                            <i class="{{ $listing->category->icon ?? 'fas fa-tag' }}"></i>
                                            {{ $listing->category->name ?? 'Uncategorized' }}
                                        </span>
                                        <span class="listing-date">
                                            <i class="far fa-clock"></i> {{ $listing->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <h4 class="list-card-title">
                                        <a href="{{ route('listings.show', $listing->slug) }}">{{ $listing->title }}</a>
                                    </h4>
                                    <p class="list-card-location">
                                        <i class="fas fa-map-marker-alt"></i> {{ $listing->location ?? 'N/A' }}
                                    </p>
                                    <p class="list-card-desc">
                                        {{ Str::limit($listing->description, 120) }}
                                    </p>
                                    <div class="list-card-bottom">
                                        <span class="list-price">
                                            ৳{{ number_format($listing->price) }}
                                        </span>
                                        <div class="list-meta">
                                            <span><i class="far fa-eye"></i> {{ $listing->views ?? 0 }}</span>
                                            <span><i class="far fa-star"></i> {{ number_format($listing->avg_rating ?? 0, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No Listings Found</h4>
                        <p class="text-muted">Try adjusting your search or filter criteria.</p>
                        <a href="{{ route('listings.index') }}" class="btn btn-outline-primary">Clear Filters</a>
                    </div>
                @endforelse

                {{-- Pagination --}}
                @if($listings->hasPages())
                    <div class="pagination-wrapper text-center mt-4">
                        {{ $listings->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<style>
.list-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.list-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}
.list-card-img {
    position: relative;
    height: 100%;
    min-height: 200px;
}
.list-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px 0 0 10px;
}
.list-card-img .badge-featured {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #FF3B30;
    color: #fff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
}
.list-card-img .btn-bookmark {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}
.list-card-img .btn-bookmark:hover {
    background: #FF3B30;
    color: #fff;
}
.list-card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.list-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.category-tag {
    font-size: 12px;
    color: #FF3B30;
    background: #FFF5F5;
    padding: 3px 10px;
    border-radius: 4px;
}
.listing-date {
    font-size: 12px;
    color: #999;
}
.list-card-title {
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 6px;
}
.list-card-title a {
    color: #333;
    text-decoration: none;
}
.list-card-title a:hover {
    color: #FF3B30;
}
.list-card-location {
    font-size: 13px;
    color: #888;
    margin-bottom: 8px;
}
.list-card-location i {
    color: #FF3B30;
    margin-right: 5px;
}
.list-card-desc {
    font-size: 13px;
    color: #777;
    margin-bottom: 12px;
    flex-grow: 1;
}
.list-card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 12px;
}
.list-price {
    font-size: 18px;
    font-weight: 700;
    color: #FF3B30;
}
.list-meta span {
    font-size: 12px;
    color: #999;
    margin-left: 12px;
}
.list-meta i {
    margin-right: 3px;
}
@media (max-width: 768px) {
    .list-card-img img {
        border-radius: 10px 10px 0 0;
    }
    .list-card-img {
        min-height: 180px;
    }
}
</style>

@endsection
@extends('layouts.app')

@section('title', 'Listings Grid with Sidebar - Listee')

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

            {{-- Sidebar Filter --}}
            <div class="col-lg-4 col-md-5">
                <div class="sidebar-filter">
                    {{-- Search --}}
                    <div class="filter-card">
                        <h5 class="filter-title">Search</h5>
                        <form action="{{ route('listings.index') }}" method="GET">
                            <input type="text" name="keyword" class="form-control" 
                                   placeholder="Search listings..." value="{{ request('keyword') }}">
                        </form>
                    </div>

                    {{-- Category Filter --}}
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

                    {{-- Location Filter --}}
                    <div class="filter-card">
                        <h5 class="filter-title">Location</h5>
                        <select name="location" class="form-control" onchange="window.location.href='{{ route('listings.index') }}?location='+this.value">
                            <option value="">All Locations</option>
                            @isset($locations)
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                                        {{ $loc }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>

                    {{-- Price Range Filter --}}
                    <div class="filter-card">
                        <h5 class="filter-title">Price Range</h5>
                        <div class="price-inputs">
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

                    {{-- Tags Filter --}}
                    <div class="filter-card">
                        <h5 class="filter-title">Popular Tags</h5>
                        <div class="tag-cloud">
                            @foreach(['Featured', 'New', 'Sale', 'Rent', 'Popular', 'Verified'] as $tag)
                                <a href="{{ route('listings.index', ['tag' => strtolower($tag)]) }}" 
                                   class="tag-badge {{ request('tag') == strtolower($tag) ? 'active' : '' }}">
                                    {{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Listings Grid --}}
            <div class="col-lg-8 col-md-7">
                {{-- Toolbar --}}
                <div class="listing-toolbar">
                    <div class="toolbar-left">
                        <p class="result-count">
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
                            <a href="{{ route('listings.grid-sidebar') }}" class="active"><i class="fas fa-th"></i></a>
                            <a href="{{ route('listings.list-sidebar') }}"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Grid Items --}}
                <div class="row">
                    @forelse($listings as $listing)
                        <div class="col-lg-6 col-md-12 mb-4">
                            @include('listings._card', ['listing' => $listing])
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state text-center py-5">
                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                <h4>No Listings Found</h4>
                                <p class="text-muted">Try adjusting your search or filter criteria.</p>
                                <a href="{{ route('listings.index') }}" class="btn btn-outline-primary">Clear Filters</a>
                            </div>
                        </div>
                    @endforelse
                </div>

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
.sidebar-filter {
    position: sticky;
    top: 20px;
}
.filter-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}
.filter-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}
.category-filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.category-filter-list li {
    margin-bottom: 8px;
}
.category-filter-list a {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 6px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s;
}
.category-filter-list a:hover,
.category-filter-list a.active {
    background: #FFF5F5;
    color: #FF3B30;
}
.category-filter-list a i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}
.category-filter-list .count {
    margin-left: auto;
    font-size: 12px;
    color: #999;
}
.tag-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.tag-badge {
    padding: 5px 14px;
    border-radius: 20px;
    background: #f5f5f5;
    color: #666;
    font-size: 12px;
    text-decoration: none;
    transition: all 0.3s;
}
.tag-badge:hover,
.tag-badge.active {
    background: #FF3B30;
    color: #fff;
}
.listing-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid #e8e8e8;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}
.result-count {
    margin: 0;
    font-size: 13px;
    color: #888;
}
.toolbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}
.toolbar-right .form-control-sm {
    width: auto;
    height: 36px;
    border-radius: 6px;
    font-size: 13px;
}
.view-toggles a {
    width: 36px;
    height: 36px;
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
.empty-state i {
    color: #ddd;
}
</style>

@endsection
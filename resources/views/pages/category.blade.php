@extends('layouts.app')

@section('title', ($category->name ?? 'Category') . ' - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => $category->name ?? 'Category',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Categories', 'url' => url('/categories')],
        ['name' => $category->name ?? 'Category']
    ]
])

<section class="category-page py-5">
    <div class="container">

        {{-- Category Header --}}
        <div class="category-header mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="category-info-box">
                        <div class="category-icon-lg">
                            <i class="{{ $category->icon ?? 'fas fa-folder' }}"></i>
                        </div>
                        <div>
                            <h2>{{ $category->name }}</h2>
                            <p class="text-muted mb-0">{{ $category->description ?? 'Browse all listings in this category' }}</p>
                            <span class="listing-total">{{ $listings->total() ?? 0 }} Listings Found</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <select class="form-control form-control-sm d-inline-block w-auto" 
                            onchange="window.location.href='{{ route('category.show', $category->slug) }}?sort='+this.value">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Sub Categories --}}
        @if(($category->subCategories ?? collect())->count() > 0)
            <div class="sub-categories mb-4">
                <h5 class="mb-3">Sub Categories</h5>
                <div class="sub-cat-list">
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="sub-cat-badge {{ !request('sub') ? 'active' : '' }}">
                        All
                    </a>
                    @foreach($category->subCategories as $sub)
                        <a href="{{ route('category.show', [$category->slug, 'sub' => $sub->slug]) }}" 
                           class="sub-cat-badge {{ request('sub') == $sub->slug ? 'active' : '' }}">
                            {{ $sub->name }}
                            <span>({{ $sub->listings_count ?? 0 }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Listings Grid --}}
        <div class="row">
            @forelse($listings as $listing)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    @include('listings._card', ['listing' => $listing])
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h4>No Listings in This Category</h4>
                        <p class="text-muted">Be the first to post a listing in {{ $category->name }}!</p>
                        <a href="{{ route('user.add-listing') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Post a Listing
                        </a>
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

        {{-- Related Categories --}}
        <div class="related-categories mt-5">
            <h5 class="mb-3">Browse Other Categories</h5>
            <div class="row">
                @foreach($otherCategories ?? [] as $otherCat)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                        <a href="{{ route('category.show', $otherCat->slug) }}" class="related-cat-card text-center">
                            <div class="related-cat-icon">
                                <i class="{{ $otherCat->icon ?? 'fas fa-folder' }}"></i>
                            </div>
                            <h6>{{ $otherCat->name }}</h6>
                            <small>{{ $otherCat->listings_count ?? 0 }} Ads</small>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.category-header {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px;
}
.category-info-box {
    display: flex;
    align-items: center;
    gap: 20px;
}
.category-icon-lg {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.category-icon-lg i {
    font-size: 28px;
    color: #FF3B30;
}
.category-info-box h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 5px;
}
.listing-total {
    font-size: 13px;
    color: #FF3B30;
    font-weight: 600;
}
.sub-categories h5 {
    font-size: 16px;
    font-weight: 600;
}
.sub-cat-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.sub-cat-badge {
    padding: 6px 16px;
    border-radius: 20px;
    border: 1px solid #e0e0e0;
    background: #fff;
    color: #666;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.3s;
}
.sub-cat-badge:hover,
.sub-cat-badge.active {
    background: #FF3B30;
    color: #fff;
    border-color: #FF3B30;
}
.sub-cat-badge span {
    font-size: 11px;
    opacity: 0.8;
}
.related-categories h5 {
    font-size: 18px;
    font-weight: 600;
}
.related-cat-card {
    display: block;
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px 10px;
    text-decoration: none;
    transition: all 0.3s;
}
.related-cat-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transform: translateY(-3px);
    border-color: #FF3B30;
}
.related-cat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
}
.related-cat-icon i {
    font-size: 20px;
    color: #FF3B30;
}
.related-cat-card h6 {
    font-size: 13px;
    font-weight: 600;
    color: #333;
    margin-bottom: 3px;
}
.related-cat-card small {
    font-size: 11px;
    color: #999;
}
.empty-state {
    background: #f9f9f9;
    border-radius: 10px;
    padding: 40px;
}
.empty-state i {
    display: block;
}
.empty-state h4 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}
.category-page .pagination {
    justify-content: center;
}

/* Responsive */
@media (max-width: 768px) {
    .category-info-box {
        flex-direction: column;
        text-align: center;
    }
    .category-header .col-md-4 {
        text-align: center !important;
        margin-top: 15px;
    }
}
</style>

@endsection
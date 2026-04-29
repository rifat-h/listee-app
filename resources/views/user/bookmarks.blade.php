@extends('layouts.app')

@section('title', 'My Bookmarks - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'My Bookmarks',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'Bookmarks']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4">
                <div class="dashboard-sidebar">
                    <div class="sidebar-user-info text-center">
                        <div class="user-avatar">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                 alt="{{ auth()->user()->name }}">
                        </div>
                        <h5>{{ auth()->user()->name }}</h5>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <ul class="dashboard-nav">
                        <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a href="{{ route('user.my-listings') }}"><i class="fas fa-list"></i> My Listings</a></li>
                        <li class="active"><a href="{{ route('user.bookmarks') }}"><i class="fas fa-heart"></i> Bookmarks</a></li>
                        <li><a href="{{ route('user.messages') }}"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a href="{{ route('user.reviews') }}"><i class="fas fa-star"></i> Reviews</a></li>
                        <li><a href="{{ route('user.add-listing') }}"><i class="fas fa-plus-circle"></i> Add Listing</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">
                <div class="dashboard-card">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-heart me-2"></i>My Bookmarks</h5>
                        <span class="total-count">{{ $bookmarks->total() ?? 0 }} Saved</span>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Bookmark Items --}}
                    <div class="row">
                        @forelse($bookmarks as $bookmark)
                            <div class="col-lg-6 mb-4">
                                <div class="bookmark-card">
                                    <div class="bookmark-img">
                                        <a href="{{ route('listings.show', $bookmark->listing->slug) }}">
                                            <img src="{{ asset('storage/' . ($bookmark->listing->image ?? 'images/no-image.jpg')) }}" 
                                                 alt="{{ $bookmark->listing->title }}">
                                        </a>
                                        @if($bookmark->listing->is_featured)
                                            <span class="badge-featured">Featured</span>
                                        @endif
                                        <button class="btn-remove-bookmark" 
                                                onclick="event.preventDefault(); document.getElementById('remove-bm-{{ $bookmark->id }}').submit();"
                                                title="Remove Bookmark">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <form id="remove-bm-{{ $bookmark->id }}" 
                                              action="{{ route('user.bookmarks.remove', $bookmark->id) }}" 
                                              method="POST" class="d-none">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                    <div class="bookmark-body">
                                        <span class="bookmark-category">
                                            <i class="{{ $bookmark->listing->category->icon ?? 'fas fa-tag' }}"></i>
                                            {{ $bookmark->listing->category->name ?? 'Uncategorized' }}
                                        </span>
                                        <h5 class="bookmark-title">
                                            <a href="{{ route('listings.show', $bookmark->listing->slug) }}">
                                                {{ Str::limit($bookmark->listing->title, 40) }}
                                            </a>
                                        </h5>
                                        <p class="bookmark-location">
                                            <i class="fas fa-map-marker-alt"></i> {{ $bookmark->listing->location ?? 'N/A' }}
                                        </p>
                                        <div class="bookmark-bottom">
                                            <span class="bookmark-price">৳{{ number_format($bookmark->listing->price) }}</span>
                                            <span class="bookmark-date">
                                                <i class="far fa-clock"></i> Saved {{ $bookmark->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-state text-center py-5">
                                    <i class="far fa-heart fa-3x text-muted mb-3"></i>
                                    <h5>No Bookmarks Yet</h5>
                                    <p class="text-muted">You haven't saved any listings yet. Browse listings and click the heart icon to bookmark them.</p>
                                    <a href="{{ route('listings.index') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-search me-1"></i> Browse Listings
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($bookmarks->hasPages())
                        <div class="pagination-wrapper text-center mt-3">
                            {{ $bookmarks->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.bookmark-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.bookmark-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transform: translateY(-3px);
}
.bookmark-img {
    position: relative;
    height: 180px;
    overflow: hidden;
}
.bookmark-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.bookmark-card:hover .bookmark-img img {
    transform: scale(1.05);
}
.bookmark-img .badge-featured {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #FF3B30;
    color: #fff;
    padding: 3px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
}
.btn-remove-bookmark {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #FF3B30;
    border: none;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.3s;
}
.btn-remove-bookmark:hover {
    background: #cc2f26;
    transform: scale(1.1);
}
.bookmark-body {
    padding: 15px;
}
.bookmark-category {
    font-size: 11px;
    color: #FF3B30;
    background: #FFF5F5;
    padding: 3px 8px;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 8px;
}
.bookmark-category i {
    margin-right: 4px;
}
.bookmark-title {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 6px;
}
.bookmark-title a {
    color: #333;
    text-decoration: none;
}
.bookmark-title a:hover {
    color: #FF3B30;
}
.bookmark-location {
    font-size: 12px;
    color: #888;
    margin-bottom: 10px;
}
.bookmark-location i {
    color: #FF3B30;
    margin-right: 4px;
}
.bookmark-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 10px;
}
.bookmark-price {
    font-size: 17px;
    font-weight: 700;
    color: #FF3B30;
}
.bookmark-date {
    font-size: 11px;
    color: #aaa;
}
.total-count {
    font-size: 13px;
    color: #888;
}
</style>

@endsection
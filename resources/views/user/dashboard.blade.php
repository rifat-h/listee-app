@extends('layouts.app')

@section('title', 'Dashboard - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Dashboard',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4">
                <div class="dashboard-sidebar">
                    {{-- User Info --}}
                    <div class="sidebar-user-info text-center">
                        <div class="user-avatar">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                 alt="{{ auth()->user()->name }}">
                        </div>
                        <h5>{{ auth()->user()->name }}</h5>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                        <span class="member-since">
                            <i class="far fa-calendar-alt"></i> Member since {{ auth()->user()->created_at->format('M Y') }}
                        </span>
                    </div>

                    {{-- Navigation --}}
                    <ul class="dashboard-nav">
                        <li class="active">
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.my-listings') }}">
                                <i class="fas fa-list"></i> My Listings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.bookmarks') }}">
                                <i class="fas fa-heart"></i> Bookmarks
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.messages') }}">
                                <i class="fas fa-envelope"></i> Messages
                                @if($unreadMessages ?? 0)
                                    <span class="nav-badge">{{ $unreadMessages }}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.reviews') }}">
                                <i class="fas fa-star"></i> Reviews
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.add-listing') }}">
                                <i class="fas fa-plus-circle"></i> Add Listing
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-logout">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">
                {{-- Welcome Banner --}}
                <div class="dashboard-welcome">
                    <h3>Welcome back, {{ auth()->user()->name }}!</h3>
                    <p>Here's what's happening with your listings.</p>
                </div>

                {{-- Stats Cards --}}
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="stat-card stat-primary">
                            <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
                            <div class="stat-info">
                                <h3>{{ $totalListings ?? 0 }}</h3>
                                <p>Total Listings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="stat-card stat-success">
                            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="stat-info">
                                <h3>{{ $activeListings ?? 0 }}</h3>
                                <p>Active Ads</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="stat-card stat-warning">
                            <div class="stat-icon"><i class="fas fa-eye"></i></div>
                            <div class="stat-info">
                                <h3>{{ $totalViews ?? 0 }}</h3>
                                <p>Total Views</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="stat-card stat-danger">
                            <div class="stat-icon"><i class="fas fa-heart"></i></div>
                            <div class="stat-info">
                                <h3>{{ $totalBookmarks ?? 0 }}</h3>
                                <p>Bookmarks</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Listings --}}
                <div class="dashboard-card">
                    <div class="card-header-custom">
                        <h5>Recent Listings</h5>
                        <a href="{{ route('user.my-listings') }}" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table dashboard-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentListings ?? [] as $listing)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . ($listing->image ?? 'images/no-image.jpg')) }}" 
                                                 alt="{{ $listing->title }}" class="table-thumb">
                                        </td>
                                        <td>
                                            <a href="{{ route('listings.show', $listing->slug) }}">
                                                {{ Str::limit($listing->title, 30) }}
                                            </a>
                                        </td>
                                        <td>{{ $listing->category->name ?? '-' }}</td>
                                        <td class="text-price">৳{{ number_format($listing->price) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $listing->status }}">
                                                {{ ucfirst($listing->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $listing->views ?? 0 }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="{{ route('listings.show', $listing->slug) }}" class="btn-action" title="View">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('user.edit-listing', $listing->id) }}" class="btn-action" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ route('user.delete-listing', $listing->id) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure?')" style="display:inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-action-danger" title="Delete">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            No listings yet. <a href="{{ route('user.add-listing') }}">Create your first listing!</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Recent Reviews --}}
                <div class="dashboard-card mt-4">
                    <div class="card-header-custom">
                        <h5>Recent Reviews</h5>
                        <a href="{{ route('user.reviews') }}" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                    @forelse($recentReviews ?? [] as $review)
                        <div class="review-item">
                            <div class="review-avatar">
                                <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $review->user->name }}">
                            </div>
                            <div class="review-content">
                                <div class="review-top">
                                    <strong>{{ $review->user->name }}</strong>
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p>{{ $review->comment }}</p>
                                <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-3">No reviews yet.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.dashboard-sidebar {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
    position: sticky;
    top: 20px;
}
.sidebar-user-info {
    padding: 25px 20px;
    border-bottom: 1px solid #f0f0f0;
}
.user-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 12px;
    border: 3px solid #FF3B30;
}
.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.sidebar-user-info h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 3px;
}
.sidebar-user-info p {
    font-size: 12px;
    margin-bottom: 5px;
}
.member-since {
    font-size: 11px;
    color: #aaa;
}
.dashboard-nav {
    list-style: none;
    padding: 10px 0;
    margin: 0;
}
.dashboard-nav li a,
.dashboard-nav .nav-logout {
    display: flex;
    align-items: center;
    padding: 11px 20px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s;
    border: none;
    background: none;
    width: 100%;
    cursor: pointer;
    text-align: left;
}
.dashboard-nav li a i,
.dashboard-nav .nav-logout i {
    width: 20px;
    margin-right: 10px;
    text-align: center;
    color: #999;
}
.dashboard-nav li a:hover,
.dashboard-nav li.active a {
    background: #FFF5F5;
    color: #FF3B30;
}
.dashboard-nav li a:hover i,
.dashboard-nav li.active a i {
    color: #FF3B30;
}
.nav-badge {
    margin-left: auto;
    background: #FF3B30;
    color: #fff;
    font-size: 10px;
    padding: 2px 7px;
    border-radius: 10px;
}
.nav-logout:hover {
    color: #FF3B30 !important;
}
.dashboard-welcome {
    background: linear-gradient(135deg, #FF3B30, #FF6B5A);
    color: #fff;
    padding: 25px 30px;
    border-radius: 10px;
    margin-bottom: 25px;
}
.dashboard-welcome h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
}
.dashboard-welcome p {
    font-size: 14px;
    opacity: 0.9;
    margin: 0;
}
.stat-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.3s;
}
.stat-card:hover {
    transform: translateY(-3px);
}
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.stat-primary .stat-icon { background: #EBF5FF; color: #3B82F6; }
.stat-success .stat-icon { background: #ECFDF5; color: #10B981; }
.stat-warning .stat-icon { background: #FFFBEB; color: #F59E0B; }
.stat-danger .stat-icon { background: #FFF5F5; color: #FF3B30; }
.stat-info h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 2px;
    color: #333;
}
.stat-info p {
    font-size: 12px;
    color: #888;
    margin: 0;
}
.dashboard-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 20px;
}
.card-header-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f0f0f0;
}
.card-header-custom h5 {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}
.view-all {
    font-size: 13px;
    color: #FF3B30;
    text-decoration: none;
}
.dashboard-table {
    margin: 0;
    font-size: 13px;
}
.dashboard-table th {
    font-weight: 600;
    color: #666;
    border-top: none;
    font-size: 12px;
    text-transform: uppercase;
}
.table-thumb {
    width: 45px;
    height: 35px;
    object-fit: cover;
    border-radius: 4px;
}
.text-price {
    font-weight: 600;
    color: #FF3B30;
}
.status-badge {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}
.status-active { background: #ECFDF5; color: #10B981; }
.status-pending { background: #FFFBEB; color: #F59E0B; }
.status-expired { background: #FFF5F5; color: #FF3B30; }
.action-btns {
    display: flex;
    gap: 5px;
}
.btn-action {
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e8e8e8;
    border-radius: 5px;
    color: #666;
    text-decoration: none;
    font-size: 12px;
    background: none;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-action:hover { background: #f5f5f5; }
.btn-action-danger:hover { background: #FFF5F5; color: #FF3B30; border-color: #FF3B30; }
.review-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}
.review-item:last-child { border-bottom: none; }
.review-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
.review-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}
.review-stars i { font-size: 12px; color: #FFC107; }
.review-content p { font-size: 13px; color: #666; margin-bottom: 3px; }
.review-date { font-size: 11px; color: #aaa; }
</style>

@endsection
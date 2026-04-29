@extends('layouts.app')

@section('title', 'My Listings - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'My Listings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'My Listings']
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
                        <li class="active"><a href="{{ route('user.my-listings') }}"><i class="fas fa-list"></i> My Listings</a></li>
                        <li><a href="{{ route('user.bookmarks') }}"><i class="fas fa-heart"></i> Bookmarks</a></li>
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
                {{-- Header --}}
                <div class="dashboard-card mb-4">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-list-alt me-2"></i>My Listings</h5>
                        <a href="{{ route('user.add-listing') }}" class="btn btn-sm btn-add-listing">
                            <i class="fas fa-plus me-1"></i> Add New Listing
                        </a>
                    </div>

                    {{-- Filters --}}
                    <div class="listing-filters mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-sm" 
                                       placeholder="Search my listings..." id="searchMyListings">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-sm" id="filterStatus">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-sm" id="filterSort">
                                    <option value="newest">Newest First</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="price_high">Price: High to Low</option>
                                    <option value="price_low">Price: Low to High</option>
                                    <option value="views">Most Viewed</option>
                                </select>
                            </div>
                            <div class="col-md-2 text-end">
                                <span class="total-count">{{ $listings->total() ?? 0 }} Listings</span>
                            </div>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Listings Table --}}
                    <div class="table-responsive">
                        <table class="table dashboard-table align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                    </th>
                                    <th>Listing</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listings as $listing)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input listing-checkbox" value="{{ $listing->id }}">
                                        </td>
                                        <td>
                                            <div class="listing-info-cell">
                                                <img src="{{ asset('storage/' . ($listing->image ?? 'images/no-image.jpg')) }}" 
                                                     alt="{{ $listing->title }}" class="table-thumb">
                                                <div>
                                                    <a href="{{ route('listings.show', $listing->slug) }}" class="listing-title-link">
                                                        {{ Str::limit($listing->title, 35) }}
                                                    </a>
                                                    <small class="d-block text-muted">
                                                        <i class="fas fa-map-marker-alt"></i> {{ $listing->location ?? 'N/A' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="category-badge">
                                                {{ $listing->category->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-price">৳{{ number_format($listing->price) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $listing->status }}">
                                                {{ ucfirst($listing->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="views-count">
                                                <i class="far fa-eye"></i> {{ $listing->views ?? 0 }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $listing->created_at->format('d M, Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-action-menu" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('listings.show', $listing->slug) }}">
                                                            <i class="far fa-eye me-2"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('user.edit-listing', $listing->id) }}">
                                                            <i class="far fa-edit me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        @if($listing->status == 'active')
                                                            <a class="dropdown-item text-warning" href="#" 
                                                               onclick="event.preventDefault(); document.getElementById('pause-{{ $listing->id }}').submit();">
                                                                <i class="fas fa-pause me-2"></i> Pause
                                                            </a>
                                                            <form id="pause-{{ $listing->id }}" action="{{ route('user.pause-listing', $listing->id) }}" method="POST" class="d-none">
                                                                @csrf @method('PATCH')
                                                            </form>
                                                        @else
                                                            <a class="dropdown-item text-success" href="#" 
                                                               onclick="event.preventDefault(); document.getElementById('activate-{{ $listing->id }}').submit();">
                                                                <i class="fas fa-play me-2"></i> Activate
                                                            </a>
                                                            <form id="activate-{{ $listing->id }}" action="{{ route('user.activate-listing', $listing->id) }}" method="POST" class="d-none">
                                                                @csrf @method('PATCH')
                                                            </form>
                                                        @endif
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('user.delete-listing', $listing->id) }}" method="POST" 
                                                              onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="far fa-trash-alt me-2"></i> Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                                <h5>No Listings Yet</h5>
                                                <p class="text-muted">Start by creating your first listing.</p>
                                                <a href="{{ route('user.add-listing') }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i> Add New Listing
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Bulk Actions --}}
                    <div class="bulk-actions" id="bulkActions" style="display:none;">
                        <span class="selected-count">0 selected</span>
                        <button class="btn btn-sm btn-outline-danger" id="bulkDelete">
                            <i class="fas fa-trash-alt me-1"></i> Delete Selected
                        </button>
                    </div>

                    {{-- Pagination --}}
                    @if($listings->hasPages())
                        <div class="pagination-wrapper mt-3">
                            {{ $listings->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.btn-add-listing {
    background: #FF3B30;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}
.btn-add-listing:hover {
    background: #E0352B;
    color: #fff;
}
.listing-filters {
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}
.total-count {
    font-size: 13px;
    color: #888;
    font-weight: 500;
}
.listing-info-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}
.listing-info-cell .table-thumb {
    width: 50px;
    height: 40px;
    object-fit: cover;
    border-radius: 5px;
}
.listing-title-link {
    font-weight: 600;
    color: #333;
    text-decoration: none;
    font-size: 13px;
}
.listing-title-link:hover {
    color: #FF3B30;
}
.category-badge {
    font-size: 11px;
    background: #f5f5f5;
    padding: 3px 10px;
    border-radius: 4px;
    color: #666;
}
.views-count {
    font-size: 12px;
    color: #888;
}
.btn-action-menu {
    border: 1px solid #e8e8e8;
    background: #fff;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    color: #888;
}
.btn-action-menu:hover {
    background: #f5f5f5;
}
.dropdown-item {
    font-size: 13px;
    padding: 8px 15px;
}
.dropdown-item i {
    width: 16px;
    text-align: center;
}
.bulk-actions {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 0;
    border-top: 1px solid #f0f0f0;
}
.selected-count {
    font-size: 13px;
    color: #666;
    font-weight: 500;
}
</style>

@push('scripts')
<script>
// Select All
document.getElementById('selectAll')?.addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('.listing-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
    toggleBulkActions();
});

document.querySelectorAll('.listing-checkbox').forEach(function(cb) {
    cb.addEventListener('change', toggleBulkActions);
});

function toggleBulkActions() {
    var checked = document.querySelectorAll('.listing-checkbox:checked');
    var bulkActions = document.getElementById('bulkActions');
    if (checked.length > 0) {
        bulkActions.style.display = 'flex';
        bulkActions.querySelector('.selected-count').textContent = checked.length + ' selected';
    } else {
        bulkActions.style.display = 'none';
    }
}

// Filter by status
document.getElementById('filterStatus')?.addEventListener('change', function() {
    var url = new URL(window.location.href);
    if (this.value) {
        url.searchParams.set('status', this.value);
    } else {
        url.searchParams.delete('status');
    }
    window.location.href = url.toString();
});

// Search
document.getElementById('searchMyListings')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        var url = new URL(window.location.href);
        url.searchParams.set('keyword', this.value);
        window.location.href = url.toString();
    }
});
</script>
@endpush

@endsection
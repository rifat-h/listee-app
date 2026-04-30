@extends('layouts.app')

@section('title', 'My Listing - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'My Listing',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'My Listing']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Tab Navigation --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-12">
                <div class="listing-card">
                    {{-- Header --}}
                    <div class="listing-card-header">
                        <h5 class="listing-card-title">My Listings</h5>
                        <a href="{{ route('user.add-listing') }}" class="btn btn-add-new">
                            <i class="fas fa-plus me-1"></i> Add Listing
                        </a>
                    </div>

                    {{-- Search & Sort --}}
                    <div class="listing-toolbar">
                        <div class="listing-search">
                            <input type="text" class="form-control" placeholder="Search.." id="searchMyListings">
                        </div>
                        <div class="listing-sort">
                            <span class="sort-label">Sort by</span>
                            <select class="form-select" id="filterSort">
                                <option value="newest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option value="price_high">Price: High to Low</option>
                                <option value="price_low">Price: Low to High</option>
                                <option value="views">Most Viewed</option>
                            </select>
                        </div>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Listings Table --}}
                    <div class="table-responsive mt-3">
                        <table class="table listing-table align-middle">
                            <thead>
                                <tr>
                                    <th>Image <i class="fas fa-sort fa-xs text-muted"></i></th>
                                    <th>Details <i class="fas fa-sort fa-xs text-muted"></i></th>
                                    <th>Status <i class="fas fa-sort fa-xs text-muted"></i></th>
                                    <th>Views <i class="fas fa-sort fa-xs text-muted"></i></th>
                                    <th>Action <i class="fas fa-sort fa-xs text-muted"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listings as $listing)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . ($listing->image ?? 'images/no-image.jpg')) }}" 
                                                 alt="{{ $listing->title }}" class="listing-thumb">
                                        </td>
                                        <td>
                                            <div class="listing-details-cell">
                                                <a href="{{ route('listings.show', $listing->slug) }}" class="listing-name">
                                                    {{ $listing->title }}
                                                </a>
                                                <div class="listing-meta">
                                                    <span class="listing-category">
                                                        <i class="fas fa-tag"></i> {{ $listing->category->name ?? 'Electronics' }}
                                                    </span>
                                                    <span class="listing-price">${{ number_format($listing->price, 2) }}</span>
                                                    @if($listing->old_price)
                                                        <span class="listing-old-price">${{ number_format($listing->old_price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <p class="listing-desc">{{ Str::limit($listing->description ?? 'Mauris vestibulum lorem a condimentum vulputate.', 50) }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            @if($listing->status == 'active' || $listing->status == 'published')
                                                <span class="status-published">Published</span>
                                            @else
                                                <span class="status-unpublished">Un Published</span>
                                            @endif
                                        </td>
                                        <td>{{ $listing->views ?? 1523 }}</td>
                                        <td>
                                            <div class="listing-actions">
                                                <a href="{{ route('listings.show', $listing->slug) }}" class="action-btn action-view" title="View">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('user.edit-listing', $listing->id) }}" class="action-btn action-edit" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <form action="{{ route('user.delete-listing', $listing->id) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure?')" style="display:inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="action-btn action-delete" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                                <h5>No Listings Yet</h5>
                                                <p class="text-muted">Start by creating your first listing.</p>
                                                <a href="{{ route('user.add-listing') }}" class="btn btn-add-new btn-sm">
                                                    <i class="fas fa-plus me-1"></i> Add New Listing
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($listings->hasPages())
                        <div class="listing-pagination">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div>
                                    @if($listings->onFirstPage())
                                        <span class="btn btn-outline-secondary btn-sm disabled"><i class="fas fa-arrow-left me-1"></i> Prev</span>
                                    @else
                                        <a href="{{ $listings->previousPageUrl() }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Prev</a>
                                    @endif
                                </div>
                                <div class="pagination-numbers">
                                    @for($i = 1; $i <= $listings->lastPage(); $i++)
                                        <a href="{{ $listings->url($i) }}" 
                                           class="page-num {{ $listings->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                                    @endfor
                                </div>
                                <div>
                                    @if($listings->hasMorePages())
                                        <a href="{{ $listings->nextPageUrl() }}" class="btn btn-outline-secondary btn-sm">Next <i class="fas fa-arrow-right ms-1"></i></a>
                                    @else
                                        <span class="btn btn-outline-secondary btn-sm disabled">Next <i class="fas fa-arrow-right ms-1"></i></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.listing-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px;
}
.listing-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.listing-card-title {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: #333;
}
.btn-add-new {
    background: #1a1a2e;
    color: #fff;
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}
.btn-add-new:hover {
    background: #2d2d4e;
    color: #fff;
}
.listing-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}
.listing-search {
    flex: 0 0 250px;
}
.listing-search .form-control {
    height: 42px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}
.listing-sort {
    display: flex;
    align-items: center;
    gap: 8px;
}
.sort-label {
    font-size: 13px;
    color: #888;
    white-space: nowrap;
}
.listing-sort .form-select {
    width: auto;
    height: 42px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}
.listing-table {
    margin: 0;
}
.listing-table thead th {
    font-weight: 600;
    color: #666;
    font-size: 13px;
    border-top: none;
    padding: 12px 10px;
    white-space: nowrap;
}
.listing-table tbody td {
    padding: 12px 10px;
    vertical-align: middle;
    border-bottom: 1px solid #f0f0f0;
}
.listing-thumb {
    width: 90px;
    height: 65px;
    object-fit: cover;
    border-radius: 6px;
}
.listing-details-cell {
    min-width: 250px;
}
.listing-name {
    font-weight: 600;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    display: block;
    margin-bottom: 4px;
}
.listing-name:hover {
    color: #d32f2f;
}
.listing-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 4px;
    flex-wrap: wrap;
}
.listing-category {
    font-size: 12px;
    color: #888;
}
.listing-category i {
    margin-right: 3px;
}
.listing-price {
    font-size: 14px;
    font-weight: 700;
    color: #d32f2f;
}
.listing-old-price {
    font-size: 12px;
    color: #aaa;
    text-decoration: line-through;
}
.listing-desc {
    font-size: 12px;
    color: #999;
    margin: 0;
}
.status-published {
    color: #10B981;
    font-weight: 600;
    font-size: 13px;
}
.status-unpublished {
    color: #F59E0B;
    font-weight: 600;
    font-size: 13px;
}
.listing-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}
.action-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    font-size: 13px;
    transition: all 0.3s;
    text-decoration: none;
}
.action-view {
    background: #f5f5f5;
    color: #666;
}
.action-view:hover {
    background: #e0e0e0;
    color: #333;
}
.action-edit {
    background: #f5f5f5;
    color: #666;
}
.action-edit:hover {
    background: #e0e0e0;
    color: #333;
}
.action-delete {
    background: #d32f2f;
    color: #fff;
}
.action-delete:hover {
    background: #b71c1c;
    color: #fff;
}
.listing-pagination {
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
    margin-top: 15px;
}
.pagination-numbers {
    display: flex;
    gap: 5px;
}
.page-num {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #666;
    text-decoration: none;
    border: 1px solid #e0e0e0;
    transition: all 0.3s;
}
.page-num:hover {
    background: #f5f5f5;
    color: #333;
}
.page-num.active {
    background: #1a1a2e;
    color: #fff;
    border-color: #1a1a2e;
}
</style>

@push('scripts')
<script>
document.getElementById('searchMyListings')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        var url = new URL(window.location.href);
        url.searchParams.set('keyword', this.value);
        window.location.href = url.toString();
    }
});

document.getElementById('filterSort')?.addEventListener('change', function() {
    var url = new URL(window.location.href);
    url.searchParams.set('sort', this.value);
    window.location.href = url.toString();
});
</script>
@endpush

@endsection

@extends('layouts.app')

@section('title', 'Listings Grid - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => isset($category) ? $category->name : 'Listings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Listings', 'url' => url('/listings')],
        ['name' => isset($category) ? $category->name : 'Grid View']
    ]
])

<section class="listing-section py-5">
    <div class="container">

        {{-- Filter Bar --}}
        <div class="filter-bar bg-white p-3 rounded shadow-sm mb-4">
            <form action="{{ route('listings.grid') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Search listings..."
                           value="{{ request('keyword') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @isset($categories)
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="location" class="form-control" placeholder="Location"
                           value="{{ request('location') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        {{-- Toolbar --}}
        <div class="listing-toolbar d-flex justify-content-between align-items-center mb-4">
            <p class="text-muted mb-0">
                Showing <strong>{{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }}</strong>
                of <strong>{{ $listings->total() }}</strong> results
            </p>
            <div class="view-toggles">
                <a href="{{ route('listings.grid') }}" class="btn btn-sm btn-danger"><i class="fas fa-th"></i></a>
                <a href="{{ route('listings.grid-sidebar') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-th-large"></i></a>
                <a href="{{ route('listings.list-sidebar') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-list"></i></a>
            </div>
        </div>

        {{-- Grid Items --}}
        <div class="row g-4">
            @forelse($listings as $listing)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('listings._card', ['listing' => $listing])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Listings Found</h4>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('listings.grid') }}" class="btn btn-outline-danger">Clear Filters</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($listings->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $listings->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</section>

@endsection

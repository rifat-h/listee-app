@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Listee' : 'Listings Grid - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => isset($category) ? $category->name : 'Listings',
    'breadcrumbs' => isset($category)
        ? [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Categories', 'url' => route('categories.index')],
            ['name' => $category->name]
          ]
        : [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Listings']
          ]
])

{{-- Filter Bar --}}
<section class="py-3 bg-white border-bottom">
    <div class="container">
        <form action="{{ route('listings.grid') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Search listings..."
                       value="{{ request('keyword') }}">
            </div>
            @isset($categories)
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endisset
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Location"
                       value="{{ request('location') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Listings Grid --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="text-muted mb-0">
                Showing {{ $listings->count() }} of {{ $listings->total() }} results
            </p>
            <div class="view-toggles">
                <a href="{{ route('listings.grid') }}" class="btn btn-sm btn-danger"><i class="fas fa-th"></i></a>
                <a href="{{ route('listings.grid-sidebar') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-th-list"></i></a>
                <a href="{{ route('listings.grid-map') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-map-marked-alt"></i></a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($listings as $listing)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('listings._card', ['listing' => $listing])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No listings found</h4>
                    <p class="text-muted">Try a different keyword or category</p>
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

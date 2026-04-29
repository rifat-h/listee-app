@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Listee' : 'All Listings - Listee')

@section('content')

<!-- Breadcrumb -->
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @if(isset($category))
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">{{ $category->name }}</li>
                @else
                    <li class="breadcrumb-item active">Listings</li>
                @endif
            </ol>
        </nav>
    </div>
</section>

<!-- Filter Bar -->
<section class="py-3 bg-white border-bottom">
    <div class="container">
        <form action="{{ route('listings.grid') }}" method="GET" class="row g-2 align-items-center">
            @if(isset($categories))
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
            @endif
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Location"
                       value="{{ request('location') }}">
            </div>
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="latest">Latest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="keyword" class="form-control" placeholder="Search..."
                       value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Listing Grid -->
<section class="py-5">
    <div class="container">
        @if(isset($category))
            <h4 class="fw-bold mb-3">{{ $category->name }}</h4>
            @if($category->description)
                <p class="text-muted mb-4">{{ $category->description }}</p>
            @endif
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">Showing {{ $listings->count() }} of {{ $listings->total() }} results</p>
        </div>

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
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $listings->appends(request()->query())->links() }}
        </div>
    </div>
</section>

@endsection

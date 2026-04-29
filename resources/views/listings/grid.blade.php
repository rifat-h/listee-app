@extends('layouts.app')

@section('title', 'Listings - Listee')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Listings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => isset($category) ? $category->name : 'Listings']
    ]
])

<section class="py-5">
    <div class="container">
        @include('components.search-bar')

        <div class="d-flex justify-content-between align-items-center mb-4">
            <p class="text-muted mb-0">
                Showing <strong>{{ $listings->total() }}</strong> results
                @isset($category)
                    in <strong>{{ $category->name }}</strong>
                @endisset
            </p>
            <div class="d-flex gap-2">
                <a href="{{ route('listings.grid') }}" class="btn btn-sm btn-danger"><i class="fas fa-th"></i></a>
                <a href="{{ route('listings.grid-sidebar') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-th-large"></i></a>
                <a href="{{ route('listings.list-sidebar') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-list"></i></a>
            </div>
        </div>

        @if(isset($categories) && $categories->count() > 0)
        <div class="mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('listings.grid') }}" class="btn btn-sm {{ !request('category') ? 'btn-danger' : 'btn-outline-secondary' }}">All</a>
                @foreach($categories as $cat)
                    <a href="{{ route('listings.grid', ['category' => $cat->id]) }}"
                       class="btn btn-sm {{ request('category') == $cat->id ? 'btn-danger' : 'btn-outline-secondary' }}">
                        <i class="{{ $cat->icon ?? 'fas fa-tag' }}"></i> {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row g-4">
            @forelse($listings as $listing)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include('listings._card', ['listing' => $listing])
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No listings found</h5>
                        <p class="text-muted">Try adjusting your search filters</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $listings->links() }}
        </div>
    </div>
</section>

@endsection

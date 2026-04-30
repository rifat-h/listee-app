@extends('layouts.app')

@section('title', 'Listings-Categories - Listee')

@push('styles')
<style>
    .categories-grid-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        border: 1px solid #eee;
    }
    .categories-grid-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    .categories-grid-card .cat-icon-wrap {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        background: #fff5f5;
    }
    .categories-grid-card .cat-icon-wrap i {
        font-size: 2.2rem;
    }
    .categories-grid-card .cat-icon-wrap img {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }
    .categories-grid-card h5 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .categories-grid-card .ad-count {
        font-size: 0.85rem;
        color: #888;
        margin-bottom: 8px;
    }
    .categories-grid-card .cat-desc {
        font-size: 0.82rem;
        color: #999;
        line-height: 1.5;
    }
</style>
@endpush

@section('content')

@include('components.breadcrumb', [
    'title' => 'Listings-Categories',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Categories']
    ]
])

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                    <div class="card text-center p-4 h-100 border-0 shadow-sm categories-grid-card">
                        <div class="card-body p-0">
                            @if($category->image)
                                <div class="cat-icon-wrap">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                </div>
                            @else
                                <div class="cat-icon-wrap">
                                    <i class="{{ $category->icon ?? 'fas fa-folder' }}" style="color: {{ $category->color ?? '#dc3545' }}"></i>
                                </div>
                            @endif
                            <h5 class="text-dark">{{ $category->name }}</h5>
                            <p class="ad-count">{{ str_pad($category->listings_count ?? 0, 2, '0', STR_PAD_LEFT) }} Ads</p>
                            <p class="cat-desc">{{ Str::limit($category->description ?? 'Browse listings in this category', 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

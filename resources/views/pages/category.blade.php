@extends('layouts.app')

@section('title', 'Listings-Categories - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Listings-Categories',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Categories']
    ]
])

{{-- Categories Grid --}}
<section class="categories-section py-5">
    <div class="container">
        <div class="row">
            @forelse($categories as $cat)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('categories.show', $cat->slug) }}" class="cat-card-link">
                        <div class="cat-card text-center">
                            <div class="cat-card-icon">
                                @if($cat->image)
                                    <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                                @else
                                    <i class="{{ $cat->icon ?? 'fas fa-folder' }}"></i>
                                @endif
                            </div>
                            <h5 class="cat-card-title">{{ $cat->name }}</h5>
                            <span class="cat-card-count">{{ str_pad($cat->listings_count ?? 0, 2, '0', STR_PAD_LEFT) }} Ads</span>
                            <p class="cat-card-desc">{{ $cat->description ?? 'Lorem Ipsum is simply dummy text of the typewriter' }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h4>No Categories Found</h4>
                    <p class="text-muted">Categories will appear here once they are added.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .categories-section {
        background: #f8f9fa;
    }
    .cat-card-link {
        text-decoration: none;
        color: inherit;
    }
    .cat-card {
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 10px;
        padding: 30px 20px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .cat-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
        border-color: #dc3545;
    }
    .cat-card-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cat-card-icon img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .cat-card-icon i {
        font-size: 40px;
        color: #dc3545;
    }
    .cat-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
    }
    .cat-card-count {
        display: block;
        font-size: 13px;
        color: #999;
        margin-bottom: 10px;
    }
    .cat-card-desc {
        font-size: 13px;
        color: #777;
        margin-bottom: 0;
        line-height: 1.5;
    }
    @media (max-width: 575px) {
        .cat-card {
            padding: 20px 15px;
        }
    }
</style>
@endpush

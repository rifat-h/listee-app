{{-- Category Card Component --}}
{{-- Usage: @include('components.category-card', ['category' => $category]) --}}

<div class="category-card">
    <a href="{{ route('listings.index', ['category' => $category->slug]) }}">
        <div class="category-icon">
            <i class="{{ $category->icon ?? 'fas fa-folder' }}"></i>
        </div>
        <div class="category-info">
            <h5>{{ $category->name }}</h5>
            <span class="listing-count">{{ $category->listings_count ?? 0 }} Ads</span>
        </div>
    </a>
</div>

<style>
.category-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}
.category-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transform: translateY(-5px);
    border-color: #FF3B30;
}
.category-card a {
    text-decoration: none;
    color: inherit;
}
.category-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    transition: all 0.3s ease;
}
.category-icon i {
    font-size: 28px;
    color: #FF3B30;
}
.category-card:hover .category-icon {
    background: #FF3B30;
}
.category-card:hover .category-icon i {
    color: #fff;
}
.category-info h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}
.listing-count {
    font-size: 13px;
    color: #999;
}
</style>
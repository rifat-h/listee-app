@extends('layouts.app')

@section('title', 'Blog - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Blog',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog']
    ]
])

<section class="blog-page py-5">
    <div class="container">
        <div class="row">

            {{-- ========================
                 Left: Blog Posts
            ========================== --}}
            <div class="col-lg-8">
                <div class="row">
                    @forelse($posts ?? [] as $post)
                        <div class="col-md-6 mb-4">
                            <article class="blog-card">
                                {{-- Post Image --}}
                                <div class="blog-card-img">
                                    <a href="{{ route('blog.show', $post->slug ?? $post->id) }}">
                                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/blog-default.jpg') }}"
                                             alt="{{ $post->title }}">
                                    </a>
                                    <div class="blog-date-badge">
                                        <span class="day">{{ $post->created_at->format('d') }}</span>
                                        <span class="month">{{ $post->created_at->format('M Y') }}</span>
                                    </div>
                                </div>

                                {{-- Post Content --}}
                                <div class="blog-card-body">
                                    {{-- Category --}}
                                    @if($post->category)
                                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                           class="blog-category-tag">
                                            {{ $post->category->name ?? 'General' }}
                                        </a>
                                    @endif

                                    {{-- Title --}}
                                    <h3 class="blog-card-title">
                                        <a href="{{ route('blog.show', $post->slug ?? $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    {{-- Excerpt --}}
                                    <p class="blog-excerpt">
                                        {{ Str::limit(strip_tags($post->content), 120) }}
                                    </p>

                                    {{-- Meta --}}
                                    <div class="blog-card-meta">
                                        <div class="blog-author">
                                            <img src="{{ $post->author->avatar ?? asset('images/default-avatar.png') }}"
                                                 alt="author">
                                            <span>{{ $post->author->name ?? 'Admin' }}</span>
                                        </div>
                                        <a href="{{ route('blog.show', $post->slug ?? $post->id) }}"
                                           class="read-more-link">
                                            Read More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-blog text-center py-5">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <h4>No Blog Posts Yet</h4>
                                <p class="text-muted">Stay tuned! New posts are coming soon.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if(isset($posts) && $posts->hasPages())
                    <div class="pagination-wrapper text-center mt-3">
                        {{ $posts->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            {{-- ========================
                 Right: Sidebar
            ========================== --}}
            <div class="col-lg-4">
                {{-- Search Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title">Search</h4>
                    <form method="GET" action="{{ route('blog.index') }}">
                        <div class="search-box">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search blog posts..." class="form-control">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Categories Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="category-widget-list">
                        @forelse($blogCategories ?? [] as $cat)
                            <li>
                                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}">
                                    <span>
                                        <i class="fas fa-angle-right"></i>
                                        {{ $cat->name }}
                                    </span>
                                    <span class="cat-count">{{ $cat->posts_count ?? 0 }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="text-muted small">No categories available</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Recent Posts Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title">Recent Posts</h4>
                    @forelse($recentPosts ?? [] as $recent)
                        <div class="recent-post-item {{ !$loop->last ? 'border-bottom-item' : '' }}">
                            <img src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('images/blog-default.jpg') }}"
                                 alt="{{ $recent->title }}" class="recent-post-img">
                            <div class="recent-post-info">
                                <h5>
                                    <a href="{{ route('blog.show', $recent->slug ?? $recent->id) }}">
                                        {{ Str::limit($recent->title, 50) }}
                                    </a>
                                </h5>
                                <span class="recent-post-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $recent->created_at->format('d M, Y') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">No recent posts</p>
                    @endforelse
                </div>

                {{-- Tags Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title">Popular Tags</h4>
                    <div class="tags-cloud">
                        @forelse($tags ?? [] as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                               class="tag-link">
                                {{ $tag->name }}
                            </a>
                        @empty
                            <span class="text-muted small">No tags available</span>
                        @endforelse
                    </div>
                </div>

                {{-- Newsletter Widget --}}
                <div class="sidebar-widget newsletter-widget">
                    <div class="newsletter-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h4>Subscribe to Newsletter</h4>
                    <p>Get the latest posts delivered to your inbox.</p>
                    <form method="POST" action="{{ route('newsletter.subscribe') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Your email address..."
                               class="form-control mb-2" required>
                        <button type="submit" class="btn btn-primary btn-block w-100">
                            <i class="fas fa-paper-plane me-1"></i> Subscribe
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* Blog Card */
.blog-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.blog-card:hover {
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    transform: translateY(-3px);
}
.blog-card-img {
    position: relative;
    overflow: hidden;
}
.blog-card-img img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s;
}
.blog-card:hover .blog-card-img img {
    transform: scale(1.05);
}
.blog-date-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #FF3B30;
    color: #fff;
    border-radius: 8px;
    padding: 6px 10px;
    text-align: center;
    line-height: 1.2;
}
.blog-date-badge .day {
    display: block;
    font-size: 18px;
    font-weight: 700;
}
.blog-date-badge .month {
    display: block;
    font-size: 10px;
    text-transform: uppercase;
}
.blog-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.blog-category-tag {
    display: inline-block;
    background: #F0F4FF;
    color: #3B82F6;
    padding: 3px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 10px;
    width: fit-content;
}
.blog-category-tag:hover {
    background: #3B82F6;
    color: #fff;
}
.blog-card-title {
    font-size: 17px;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 8px;
}
.blog-card-title a {
    color: #1b2a4a;
    text-decoration: none;
}
.blog-card-title a:hover {
    color: #FF3B30;
}
.blog-excerpt {
    color: #6c757d;
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 15px;
    flex: 1;
}
.blog-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #f0f0f0;
    margin-top: auto;
}
.blog-author {
    display: flex;
    align-items: center;
    gap: 8px;
}
.blog-author img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
}
.blog-author span {
    font-size: 12px;
    color: #555;
}
.read-more-link {
    color: #FF3B30;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}
.read-more-link:hover {
    color: #D62828;
}
.read-more-link i {
    font-size: 11px;
    margin-left: 3px;
}

/* Sidebar Widgets */
.sidebar-widget {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
}
.widget-title {
    font-size: 17px;
    font-weight: 700;
    color: #1b2a4a;
    margin-bottom: 15px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f0f0f0;
    position: relative;
}
.widget-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: #FF3B30;
}

/* Search Box */
.search-box {
    display: flex;
    gap: 8px;
}
.search-box .form-control {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 13px;
    padding: 10px 15px;
}
.search-btn {
    padding: 10px 15px;
    background: #FF3B30;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.search-btn:hover {
    background: #D62828;
}

/* Category Widget */
.category-widget-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.category-widget-list li {
    border-bottom: 1px solid #f5f5f5;
}
.category-widget-list li:last-child {
    border-bottom: none;
}
.category-widget-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    color: #555;
    text-decoration: none;
    font-size: 13px;
    transition: color 0.3s;
}
.category-widget-list a:hover {
    color: #FF3B30;
}
.category-widget-list a i {
    color: #FF3B30;
    margin-right: 6px;
    font-size: 11px;
}
.cat-count {
    background: #f0f0f0;
    padding: 2px 10px;
    border-radius: 15px;
    font-size: 11px;
    color: #888;
}

/* Recent Posts */
.recent-post-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
}
.border-bottom-item {
    border-bottom: 1px solid #f5f5f5;
}
.recent-post-img {
    width: 70px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
}
.recent-post-info h5 {
    font-size: 13px;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 4px;
}
.recent-post-info h5 a {
    color: #1b2a4a;
    text-decoration: none;
}
.recent-post-info h5 a:hover {
    color: #FF3B30;
}
.recent-post-date {
    font-size: 11px;
    color: #999;
}
.recent-post-date i {
    margin-right: 3px;
}

/* Tags Cloud */
.tags-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.tag-link {
    display: inline-block;
    padding: 5px 14px;
    background: #f5f5f5;
    border-radius: 20px;
    color: #555;
    text-decoration: none;
    font-size: 12px;
    transition: all 0.3s;
}
.tag-link:hover {
    background: #FF3B30;
    color: #fff;
}

/* Newsletter Widget */
.newsletter-widget {
    background: linear-gradient(135deg, #1b2a4a, #2d3e5f);
    text-align: center;
}
.newsletter-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}
.newsletter-icon i {
    font-size: 22px;
    color: #FF3B30;
}
.newsletter-widget h4 {
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 8px;
    border: none;
    padding: 0;
}
.newsletter-widget h4::after {
    display: none;
}
.newsletter-widget p {
    color: rgba(255,255,255,0.7);
    font-size: 13px;
    margin-bottom: 15px;
}
.newsletter-widget .form-control {
    border-radius: 8px;
    border: none;
    font-size: 13px;
    padding: 10px 15px;
    background: rgba(255,255,255,0.1);
    color: #fff;
}
.newsletter-widget .form-control::placeholder {
    color: rgba(255,255,255,0.5);
}
.newsletter-widget .btn-primary {
    background: #FF3B30;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-weight: 600;
    font-size: 14px;
}
.newsletter-widget .btn-primary:hover {
    background: #D62828;
}

/* Empty State */
.empty-blog {
    background: #f9f9f9;
    border-radius: 10px;
}
.empty-blog i {
    display: block;
}

/* Responsive */
@media (max-width: 992px) {
    .col-lg-4 {
        margin-top: 30px;
    }
}
</style>

@endsection
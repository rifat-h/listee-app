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
                                            <img src="{{ ($post->user->avatar ?? false) ? asset('storage/' . $post->user->avatar) : asset('images/default-avatar.png') }}"
                                                 alt="author">
                                            <span>{{ $post->user->name ?? 'Admin' }}</span>
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

@endsection
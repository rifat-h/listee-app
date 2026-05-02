@extends('layouts.app')

@section('title', ($post->title ?? 'Blog Details') . ' - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Blog Details',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => route('blog.index')],
        ['name' => Str::limit($post->title ?? '', 40)]
    ]
])

<section class="blog-details-page py-5">
    <div class="container">
        <div class="row">

            {{-- ========================
                 Left: Blog Content
            ========================== --}}
            <div class="col-lg-8">
                <article class="blog-detail-box">

                    {{-- Featured Image --}}
                    <div class="blog-detail-img">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/blog-default.jpg') }}"
                             alt="{{ $post->title }}">
                    </div>

                    {{-- Meta Info Bar --}}
                    <div class="blog-meta-bar">
                        <div class="meta-item">
                            <img src="{{ $post->author->avatar ?? asset('images/default-avatar.png') }}"
                                 alt="author" class="meta-avatar">
                            <div>
                                <span class="meta-name">{{ $post->author->name ?? 'Admin' }}</span>
                                <span class="meta-label">Author</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $post->created_at->format('d F, Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-eye"></i>
                            <span>{{ $post->views ?? 0 }} Views</span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-comments"></i>
                            <span>{{ $post->comments_count ?? 0 }} Comments</span>
                        </div>
                    </div>

                    {{-- Post Title --}}
                    <h1 class="blog-detail-title">{{ $post->title }}</h1>

                    {{-- Post Body --}}
                    <div class="blog-detail-content">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags --}}
                    @if(isset($post->tags) && $post->tags->count() > 0)
                        <div class="blog-tags-section">
                            <span class="tags-label">
                                <i class="fas fa-tags"></i> Tags:
                            </span>
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                                   class="blog-tag-link">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Share Section --}}
                    <div class="blog-share-section">
                        <span class="share-label">Share This Post:</span>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank" class="share-btn share-facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                               target="_blank" class="share-btn share-twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                               target="_blank" class="share-btn share-whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}"
                               target="_blank" class="share-btn share-linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')"
                                    class="share-btn share-copy" title="Copy Link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </article>

                {{-- Prev/Next Navigation --}}
                <div class="blog-nav-section">
                    <div class="row">
                        <div class="col-6">
                            @if(isset($prevPost))
                                <a href="{{ route('blog.show', $prevPost->slug ?? $prevPost->id) }}"
                                   class="blog-nav-link blog-nav-prev">
                                    <i class="fas fa-arrow-left"></i>
                                    <div>
                                        <span class="nav-label">Previous Post</span>
                                        <span class="nav-title">{{ Str::limit($prevPost->title, 40) }}</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="col-6 text-end">
                            @if(isset($nextPost))
                                <a href="{{ route('blog.show', $nextPost->slug ?? $nextPost->id) }}"
                                   class="blog-nav-link blog-nav-next">
                                    <div>
                                        <span class="nav-label">Next Post</span>
                                        <span class="nav-title">{{ Str::limit($nextPost->title, 40) }}</span>
                                    </div>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Comments Section --}}
                <div class="comments-section">
                    <h3 class="comments-title">
                        Comments ({{ $post->comments_count ?? 0 }})
                    </h3>

                    {{-- Comments List --}}
                    @forelse($post->comments ?? [] as $comment)
                        <div class="comment-item">
                            <img src="{{ $comment->user->avatar ?? asset('images/default-avatar.png') }}"
                                 alt="user" class="comment-avatar">
                            <div class="comment-body">
                                <div class="comment-header">
                                    <h5 class="comment-author">{{ $comment->user->name ?? 'Anonymous' }}</h5>
                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="comment-text">{{ $comment->body }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="no-comments">No comments yet. Be the first to comment!</p>
                    @endforelse

                    {{-- Comment Form --}}
                    <div class="comment-form-box">
                        <h4>Leave a Comment</h4>
                        @auth
                            <form method="POST" action="{{ route('blog.comment', $post->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="body" rows="4" required
                                              placeholder="Write your comment here..."
                                              class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Post Comment
                                </button>
                            </form>
                        @else
                            <div class="login-to-comment">
                                <i class="fas fa-lock"></i>
                                <p>Please <a href="{{ route('login') }}">Login</a> to post a comment.</p>
                            </div>
                        @endauth
                    </div>
                </div>
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
                            <input type="text" name="search" placeholder="Search blog posts..."
                                   class="form-control">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
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

                {{-- Tags Widget --}}
                <div class="sidebar-widget">
                    <h4 class="widget-title">Tags</h4>
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
            </div>

        </div>
    </div>
</section>
@endsection
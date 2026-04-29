@extends('layouts.app')

@section('title', ($post->title ?? 'Blog Post') . ' - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => $post->title ?? 'Blog Post',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Blog', 'url' => url('/blog')],
        ['name' => Str::limit($post->title ?? '', 30)]
    ]
])

<section class="blog-details py-5">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <article class="blog-detail-card">
                    {{-- Featured Image --}}
                    @if($post->image)
                    <div class="blog-detail-img mb-4">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded w-100" style="max-height: 450px; object-fit: cover;">
                    </div>
                    @endif

                    {{-- Meta --}}
                    <div class="blog-detail-meta d-flex align-items-center gap-3 mb-3 text-muted">
                        <span>
                            <i class="fas fa-user"></i> {{ $post->user->name ?? 'Admin' }}
                        </span>
                        <span>
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M, Y') }}
                        </span>
                        <span>
                            <i class="fas fa-eye"></i> {{ $post->views ?? 0 }} Views
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="fw-bold mb-4">{{ $post->title }}</h1>

                    {{-- Content --}}
                    <div class="blog-content">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </article>

                {{-- Prev/Next Navigation --}}
                <div class="blog-nav d-flex justify-content-between mt-5 pt-4 border-top">
                    @if($prevPost)
                    <a href="{{ route('blog.show', $prevPost->slug) }}" class="text-decoration-none text-dark">
                        <small class="text-muted"><i class="fas fa-arrow-left"></i> Previous Post</small>
                        <h6>{{ Str::limit($prevPost->title, 40) }}</h6>
                    </a>
                    @else
                    <div></div>
                    @endif

                    @if($nextPost)
                    <a href="{{ route('blog.show', $nextPost->slug) }}" class="text-decoration-none text-dark text-end">
                        <small class="text-muted">Next Post <i class="fas fa-arrow-right"></i></small>
                        <h6>{{ Str::limit($nextPost->title, 40) }}</h6>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Recent Posts --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Recent Posts</h5>
                        @foreach($recentPosts as $recent)
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <img src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('images/default-blog.png') }}"
                                 class="rounded me-3" width="70" height="55" style="object-fit: cover;">
                            <div>
                                <h6 class="mb-1">
                                    <a href="{{ route('blog.show', $recent->slug) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($recent->title, 50) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $recent->created_at->format('d M, Y') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

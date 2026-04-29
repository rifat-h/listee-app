@extends('layouts.app')

@section('title', 'Manage Blog - Admin')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Manage Blog Posts',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin', 'url' => route('admin.dashboard')],
        ['name' => 'Blog']
    ]
])

<section class="admin-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4">
                @include('admin._sidebar')
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Blog Posts ({{ $posts->total() }})</h5>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-plus"></i> New Post
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                                {{ Str::limit($post->title, 50) }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($post->status === 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->views ?? 0 }}</td>
                                        <td>{{ $post->created_at->format('d M, Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No blog posts found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($posts->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection

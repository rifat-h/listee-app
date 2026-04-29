@extends('layouts.app')

@section('title', 'Manage Blog - Admin')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-blog text-danger"></i> Manage Blog</h2>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-danger">
                <i class="fas fa-plus"></i> New Post
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ Str::limit($post->title, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>{{ $post->views ?? 0 }}</td>
                                <td>{{ $post->created_at->format('d M, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No blog posts found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

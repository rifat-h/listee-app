@extends('layouts.app')

@section('title', 'Create Blog Post - Admin')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Create Blog Post',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin', 'url' => route('admin.dashboard')],
        ['name' => 'Blog', 'url' => route('admin.blog')],
        ['name' => 'Create']
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

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">Create New Blog Post</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blog.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                       placeholder="Enter blog post title" value="{{ old('title') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label fw-bold">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="12"
                                          placeholder="Write your blog post content..." required>{{ old('content') }}</textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-save"></i> Publish Post
                                </button>
                                <a href="{{ route('admin.blog') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

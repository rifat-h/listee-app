@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Manage Categories',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin', 'url' => route('admin.dashboard')],
        ['name' => 'Categories']
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

                {{-- Add Category Form --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">Add New Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="icon" class="form-control" placeholder="Icon (e.g. fas fa-car)">
                                </div>
                                <div class="col-md-2">
                                    <input type="color" name="color" class="form-control form-control-color" value="#FF3B30">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-plus"></i> Add Category
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2">
                                <input type="text" name="description" class="form-control" placeholder="Description (optional)">
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Categories Table --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">All Categories ({{ $categories->count() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Listings</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td><i class="{{ $category->icon ?? 'fas fa-tag' }}" style="color: {{ $category->color ?? '#FF3B30' }}"></i></td>
                                        <td>{{ $category->name }}</td>
                                        <td><span class="badge bg-info">{{ $category->listings_count }}</span></td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                                                  class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">No categories found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

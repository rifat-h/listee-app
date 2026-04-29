@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-th-large text-danger"></i> Manage Categories</h2>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Add Category</h5>
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Icon (FontAwesome class)</label>
                                <input type="text" name="icon" class="form-control" placeholder="fas fa-tag">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <input type="color" name="color" class="form-control form-control-color" value="#FF3B30">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
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
                                        <td><i class="{{ $category->icon }}" style="color: {{ $category->color }}"></i></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->listings_count }}</td>
                                        <td>
                                            <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No categories found</td>
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

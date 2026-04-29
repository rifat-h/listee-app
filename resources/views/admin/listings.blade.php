@extends('layouts.app')

@section('title', 'Manage Listings - Admin')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-list text-danger"></i> Manage Listings</h2>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listings as $listing)
                            <tr>
                                <td>{{ $listing->id }}</td>
                                <td>{{ Str::limit($listing->title, 30) }}</td>
                                <td>{{ $listing->category->name ?? 'N/A' }}</td>
                                <td>{{ $listing->user->name ?? 'N/A' }}</td>
                                <td>${{ number_format($listing->price) }}</td>
                                <td>
                                    <span class="badge bg-{{ $listing->status == 'active' ? 'success' : ($listing->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($listing->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.listings.status', $listing->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        @if($listing->status != 'active')
                                            <input type="hidden" name="status" value="active">
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        @if($listing->status != 'rejected')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No listings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $listings->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

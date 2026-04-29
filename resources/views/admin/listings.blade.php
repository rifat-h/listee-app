@extends('layouts.app')

@section('title', 'Manage Listings - Admin')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Manage Listings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin', 'url' => route('admin.dashboard')],
        ['name' => 'Listings']
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
                        <h5 class="fw-bold mb-0">All Listings ({{ $listings->total() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listings as $listing)
                                    <tr>
                                        <td>{{ $listing->id }}</td>
                                        <td>
                                            <img src="{{ $listing->image ? asset('storage/'.$listing->image) : asset('images/default-listing.png') }}"
                                                 alt="{{ $listing->title }}" width="50" height="40"
                                                 style="object-fit: cover; border-radius: 4px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('listings.details', $listing->slug) }}" class="text-dark text-decoration-none">
                                                {{ Str::limit($listing->title, 30) }}
                                            </a>
                                        </td>
                                        <td>{{ $listing->user->name ?? 'N/A' }}</td>
                                        <td>{{ $listing->category->name ?? 'N/A' }}</td>
                                        <td class="fw-bold">${{ number_format($listing->price) }}</td>
                                        <td>
                                            @if($listing->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($listing->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($listing->status === 'expired')
                                                <span class="badge bg-secondary">Expired</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <form action="{{ route('admin.listings.status', $listing->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    @if($listing->status !== 'active')
                                                        <button type="submit" name="status" value="active"
                                                                class="btn btn-outline-success btn-sm" title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                    @if($listing->status !== 'rejected')
                                                        <button type="submit" name="status" value="rejected"
                                                                class="btn btn-outline-danger btn-sm" title="Reject">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">No listings found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($listings->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $listings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection

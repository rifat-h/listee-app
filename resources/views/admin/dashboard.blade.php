@extends('layouts.app')

@section('title', 'Admin Dashboard - Listee')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-tachometer-alt text-danger"></i> Admin Dashboard</h2>

        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h3 class="fw-bold">{{ $totalUsers }}</h3>
                    <p class="text-muted mb-0">Total Users</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <i class="fas fa-list fa-2x text-success mb-2"></i>
                    <h3 class="fw-bold">{{ $totalListings }}</h3>
                    <p class="text-muted mb-0">Total Listings</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <i class="fas fa-th-large fa-2x text-warning mb-2"></i>
                    <h3 class="fw-bold">{{ $totalCategories }}</h3>
                    <p class="text-muted mb-0">Categories</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm text-center p-4">
                    <i class="fas fa-clock fa-2x text-danger mb-2"></i>
                    <h3 class="fw-bold">{{ $pendingListings }}</h3>
                    <p class="text-muted mb-0">Pending Listings</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Quick Links</h5>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.listings') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-list me-2"></i> Manage Listings
                            </a>
                            <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-th-large me-2"></i> Manage Categories
                            </a>
                            <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-users me-2"></i> Manage Users
                            </a>
                            <a href="{{ route('admin.blog') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-blog me-2"></i> Manage Blog
                            </a>
                            <a href="{{ route('admin.settings') }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

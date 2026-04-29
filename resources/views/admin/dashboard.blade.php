@extends('layouts.app')

@section('title', 'Admin Dashboard - Listee')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Admin Dashboard',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin Dashboard']
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
                <div class="dashboard-welcome mb-4">
                    <h3 class="fw-bold">Admin Dashboard</h3>
                    <p class="text-muted">Overview of your platform's performance.</p>
                </div>

                {{-- Stats Cards --}}
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 shadow-sm text-center p-3">
                            <div class="card-body">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <h3 class="fw-bold">{{ $totalUsers }}</h3>
                                <p class="text-muted mb-0">Total Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 shadow-sm text-center p-3">
                            <div class="card-body">
                                <i class="fas fa-list-alt fa-2x text-success mb-2"></i>
                                <h3 class="fw-bold">{{ $totalListings }}</h3>
                                <p class="text-muted mb-0">Total Listings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 shadow-sm text-center p-3">
                            <div class="card-body">
                                <i class="fas fa-th-large fa-2x text-info mb-2"></i>
                                <h3 class="fw-bold">{{ $totalCategories }}</h3>
                                <p class="text-muted mb-0">Categories</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 shadow-sm text-center p-3">
                            <div class="card-body">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h3 class="fw-bold">{{ $pendingListings }}</h3>
                                <p class="text-muted mb-0">Pending Listings</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Quick Actions</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.listings') }}" class="btn btn-outline-primary">
                                <i class="fas fa-list"></i> Manage Listings
                            </a>
                            <a href="{{ route('admin.categories') }}" class="btn btn-outline-success">
                                <i class="fas fa-th-large"></i> Manage Categories
                            </a>
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-info">
                                <i class="fas fa-users"></i> Manage Users
                            </a>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-danger">
                                <i class="fas fa-plus"></i> New Blog Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

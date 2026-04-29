{{-- Admin Sidebar Navigation --}}
<div class="admin-sidebar">
    <div class="sidebar-user-info text-center mb-3 p-3 bg-white rounded shadow-sm">
        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}"
             alt="{{ auth()->user()->name }}" class="rounded-circle mb-2" width="60" height="60">
        <h6 class="fw-bold mb-0">{{ auth()->user()->name }}</h6>
        <small class="text-danger">Administrator</small>
    </div>

    <div class="bg-white rounded shadow-sm">
        <ul class="list-unstyled mb-0">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.listings') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.listings') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-list me-2"></i> Listings
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.categories') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-th-large me-2"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.users') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-users me-2"></i> Users
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blog') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.blog*') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-blog me-2"></i> Blog Posts
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}"
                   class="d-block px-3 py-2 text-decoration-none {{ request()->routeIs('admin.settings') ? 'text-danger fw-bold' : 'text-dark' }}">
                    <i class="fas fa-cog me-2"></i> Settings
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}" class="d-block px-3 py-2 text-decoration-none text-dark">
                    <i class="fas fa-arrow-left me-2"></i> Back to Site
                </a>
            </li>
        </ul>
    </div>
</div>

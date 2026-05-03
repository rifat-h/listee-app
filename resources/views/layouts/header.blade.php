<!-- Top Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Listee" height="45"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/150x45/FF0000/FFFFFF?text=Bestee';">
            </a>
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active text-danger' : '' }}"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                            data-bs-toggle="dropdown">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/listings') }}">All Listings</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>
                <!-- Right Side -->
                <div class="nav-right d-flex align-items-center gap-2 ms-auto">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm me-2">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-danger btn-sm">Sign Up</a>
                    @else
                        <a href="{{ url('/user/add-listing') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-plus"></i> Add Listing
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar spacer (fixed navbar er jonno) -->
<div style="height: 80px;"></div>

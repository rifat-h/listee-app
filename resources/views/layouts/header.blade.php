<!-- Top Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Listee" height="40">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">

                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active text-danger' : '' }}"
                           href="{{ url('/') }}">Home</a>
                    </li>

                    <!-- Listings Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Listings
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/listings') }}">All Listings</a></li>
                            <li><a class="dropdown-item" href="{{ url('/listings?view=grid') }}">Listing Grid</a></li>
                            <li><a class="dropdown-item" href="{{ url('/listings?view=list') }}">Listing List</a></li>
                        </ul>
                    </li>

                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/categories') }}">All Categories</a></li>
                        </ul>
                    </li>

                    <!-- Pages Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Pages
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/about') }}">About Us</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pricing') }}">Pricing</a></li>
                            <li><a class="dropdown-item" href="{{ url('/faq') }}">FAQ</a></li>
                            <li><a class="dropdown-item" href="{{ url('/terms') }}">Terms & Conditions</a></li>
                            <li><a class="dropdown-item" href="{{ url('/privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </li>

                    <!-- Blog -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('blog*') ? 'active text-danger' : '' }}"
                           href="{{ url('/blog') }}">Blog</a>
                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active text-danger' : '' }}"
                           href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- Right Side Buttons -->
                <div class="nav-right d-flex align-items-center gap-2">
                    @guest
                        <a href="{{ url('/register') }}" class="btn btn-outline-secondary btn-sm">Sign Up</a>
                        <a href="{{ url('/login') }}" class="btn btn-danger btn-sm">Sign In</a>
                    @else
                        <div class="dropdown">
                            <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#"
                               data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ url('/user/dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ url('/user/profile') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                    <a href="{{ url('/user/listings/create') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-plus"></i> Add Listing
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar spacer -->
<div style="height: 80px;"></div>
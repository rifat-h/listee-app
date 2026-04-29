<div class="col-lg-3 col-md-4">
    <div class="dashboard-sidebar">
        <div class="sidebar-user-info text-center">
            <div class="user-avatar">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                     alt="{{ auth()->user()->name }}">
            </div>
            <h5>{{ auth()->user()->name }}</h5>
            <p class="text-muted">{{ auth()->user()->email }}</p>
            <span class="member-since">
                <i class="far fa-calendar-alt"></i> Member since {{ auth()->user()->created_at->format('M Y') }}
            </span>
        </div>
        <ul class="dashboard-nav">
            <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profile</a>
            </li>
            <li class="{{ request()->routeIs('user.my-listings') ? 'active' : '' }}">
                <a href="{{ route('user.my-listings') }}"><i class="fas fa-list"></i> My Listings</a>
            </li>
            <li class="{{ request()->routeIs('user.bookmarks') ? 'active' : '' }}">
                <a href="{{ route('user.bookmarks') }}"><i class="fas fa-heart"></i> Bookmarks</a>
            </li>
            <li class="{{ request()->routeIs('user.messages') ? 'active' : '' }}">
                <a href="{{ route('user.messages') }}">
                    <i class="fas fa-envelope"></i> Messages
                    @if($unreadMessages ?? 0)
                        <span class="nav-badge">{{ $unreadMessages }}</span>
                    @endif
                </a>
            </li>
            <li class="{{ request()->routeIs('user.reviews') ? 'active' : '' }}">
                <a href="{{ route('user.reviews') }}"><i class="fas fa-star"></i> Reviews</a>
            </li>
            <li class="{{ request()->routeIs('user.add-listing*') ? 'active' : '' }}">
                <a href="{{ route('user.add-listing') }}"><i class="fas fa-plus-circle"></i> Add Listing</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>

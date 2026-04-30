<div class="col-12">
    <div class="user-tab-navigation mb-4">
        <ul class="user-tabs">
            <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profile</a>
            </li>
            <li class="{{ request()->routeIs('user.my-listings') ? 'active' : '' }}">
                <a href="{{ route('user.my-listings') }}"><i class="fas fa-list"></i> My Listing</a>
            </li>
            <li class="{{ request()->routeIs('user.bookmarks') ? 'active' : '' }}">
                <a href="{{ route('user.bookmarks') }}"><i class="fas fa-heart"></i> Bookmarks</a>
            </li>
            <li class="{{ request()->routeIs('user.messages') ? 'active' : '' }}">
                <a href="{{ route('user.messages') }}"><i class="fas fa-comment-dots"></i> Messages</a>
            </li>
            <li class="{{ request()->routeIs('user.reviews') ? 'active' : '' }}">
                <a href="{{ route('user.reviews') }}"><i class="fas fa-star"></i> Reviews</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="tab-logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
.user-tab-navigation {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 15px 20px;
}
.user-tabs {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 5px;
    flex-wrap: wrap;
    justify-content: center;
}
.user-tabs li a,
.user-tabs li .tab-logout-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    color: #555;
    text-decoration: none;
    transition: all 0.3s;
    border: none;
    background: none;
    cursor: pointer;
    white-space: nowrap;
}
.user-tabs li a:hover,
.user-tabs li .tab-logout-btn:hover {
    background: #f5f5f5;
    color: #333;
}
.user-tabs li.active a {
    background: #d32f2f;
    color: #fff;
}
.user-tabs li.active a i {
    color: #fff;
}
.user-tabs li a i,
.user-tabs li .tab-logout-btn i {
    font-size: 14px;
}
@media (max-width: 768px) {
    .user-tabs {
        gap: 3px;
    }
    .user-tabs li a,
    .user-tabs li .tab-logout-btn {
        padding: 8px 12px;
        font-size: 12px;
    }
}
</style>

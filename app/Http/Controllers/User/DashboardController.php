<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalListings = $user->listings()->count();
        $activeListings = $user->listings()->where('status', 'active')->count();
        $totalBookmarks = $user->bookmarks()->count();
        $totalReviews = $user->reviews()->count();

        return view('user.dashboard', compact('user', 'totalListings', 'activeListings', 'totalBookmarks', 'totalReviews'));
    }
}
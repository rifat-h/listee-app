<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Listing;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()->with('listing.images', 'listing.category')->latest()->paginate(12);
        return view('user.bookmarks', compact('bookmarks'));
    }

    public function toggle(Listing $listing)
    {
        $bookmark = auth()->user()->bookmarks()->where('listing_id', $listing->id)->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Bookmark removed!');
        }

        auth()->user()->bookmarks()->create(['listing_id' => $listing->id]);
        return back()->with('success', 'Bookmark added!');
    }
}
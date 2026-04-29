<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Listing;
use App\Traits\HasImageUpload;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasImageUpload;

    public function dashboard()
    {
        $user = auth()->user();
        $totalListings = Listing::where('user_id', $user->id)->count();
        $activeListings = Listing::where('user_id', $user->id)->where('status', 'active')->count();
        $pendingListings = Listing::where('user_id', $user->id)->where('status', 'pending')->count();
        $totalViews = Listing::where('user_id', $user->id)->sum('views');

        return view('user.dashboard', compact('totalListings', 'activeListings', 'pendingListings', 'totalViews'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:20',
            'about'  => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $user->avatar = $this->uploadImage($request->file('avatar'), 'avatars', $user->avatar);
        }

        $user->name  = $request->name;
        $user->phone = $request->phone;
        $user->about = $request->about;
        $user->save();

        return back()->with('success', 'প্রোফাইল আপডেট হয়েছে!');
    }

    public function myListings()
    {
        $listings = Listing::where('user_id', auth()->id())->latest()->paginate(10);
        return view('user.my-listings', compact('listings'));
    }

    public function addListing()
    {
        $categories = \App\Models\Category::where('is_active', true)->get();
        return view('user.add-listing', compact('categories'));
    }

    public function bookmarks()
    {
        return view('user.bookmarks');
    }

    public function toggleBookmark(Listing $listing)
    {
        $existing = Bookmark::where('user_id', auth()->id())
            ->where('listing_id', $listing->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Bookmark removed!');
        }

        Bookmark::create([
            'user_id' => auth()->id(),
            'listing_id' => $listing->id,
        ]);

        return back()->with('success', 'Bookmark added!');
    }

    public function removeBookmark(Bookmark $bookmark)
    {
        if ($bookmark->user_id !== auth()->id()) {
            abort(403);
        }

        $bookmark->delete();

        return back()->with('success', 'Bookmark সরানো হয়েছে!');
    }

    public function messages()
    {
        return view('user.messages');
    }

    public function reviews()
    {
        return view('user.reviews');
    }
}
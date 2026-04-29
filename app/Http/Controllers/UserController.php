<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Listing;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
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
        $bookmarks = Bookmark::where('user_id', auth()->id())
            ->with('listing.category')
            ->latest()
            ->paginate(10);

        return view('user.bookmarks', compact('bookmarks'));
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

    public function messages(Request $request)
    {
        $userId = auth()->id();

        $allMessages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver', 'listing'])
            ->latest()
            ->get();

        $grouped = $allMessages->groupBy(function ($msg) use ($userId) {
            return $msg->sender_id == $userId ? $msg->receiver_id : $msg->sender_id;
        });

        $conversations = $grouped->map(function ($messages, $otherUserId) use ($userId) {
            $otherUser = $messages->first()->sender_id == $userId
                ? $messages->first()->receiver
                : $messages->first()->sender;

            $conv = new \stdClass();
            $conv->id = $otherUserId;
            $conv->otherUser = $otherUser;
            $conv->lastMessage = $messages->first();
            $conv->listing = $messages->first()->listing;
            $conv->unread = $messages->where('receiver_id', $userId)->where('is_read', false)->isNotEmpty();
            $conv->unread_count = $messages->where('receiver_id', $userId)->where('is_read', false)->count();

            return $conv;
        })->values();

        $unreadCount = Message::where('receiver_id', $userId)->where('is_read', false)->count();

        $activeConversation = $request->get('conversation');
        $chatUser = null;
        $chatMessages = collect();

        if ($activeConversation) {
            $chatUser = User::find($activeConversation);
            if ($chatUser) {
                $chatMessages = Message::where(function ($q) use ($userId, $activeConversation) {
                    $q->where('sender_id', $userId)->where('receiver_id', $activeConversation);
                })->orWhere(function ($q) use ($userId, $activeConversation) {
                    $q->where('sender_id', $activeConversation)->where('receiver_id', $userId);
                })->with(['sender', 'receiver'])->oldest()->get();

                Message::where('sender_id', $activeConversation)
                    ->where('receiver_id', $userId)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }
        }

        return view('user.messages', compact(
            'conversations', 'unreadCount', 'activeConversation', 'chatUser'
        ))->with('messages', $chatMessages);
    }

    public function reviews()
    {
        $userId = auth()->id();
        $userListingIds = Listing::where('user_id', $userId)->pluck('id');

        $receivedReviews = Review::whereIn('listing_id', $userListingIds)
            ->with(['user', 'listing'])
            ->latest()
            ->paginate(10);

        $givenReviews = Review::where('user_id', $userId)
            ->with(['listing.user'])
            ->latest()
            ->get();

        $totalReviews = Review::whereIn('listing_id', $userListingIds)->count();
        $avgRating = Review::whereIn('listing_id', $userListingIds)->avg('rating') ?? 0;

        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = Review::whereIn('listing_id', $userListingIds)
                ->where('rating', $i)
                ->count();
        }

        return view('user.reviews', compact(
            'receivedReviews', 'givenReviews', 'totalReviews', 'avgRating', 'ratingCounts'
        ));
    }

    public function replyReview(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string|max:1000']);

        $review = Review::findOrFail($id);
        $listing = Listing::where('id', $review->listing_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->reply = $request->reply;
        $review->save();

        return back()->with('success', 'Reply added!');
    }

    public function deleteReview($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Review deleted!');
    }
}
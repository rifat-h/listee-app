<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $listingId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $listing = Listing::findOrFail($listingId);

        Review::create([
            'user_id'    => auth()->id(),
            'listing_id' => $listing->id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'রিভিউ সাবমিট হয়েছে!');
    }
}

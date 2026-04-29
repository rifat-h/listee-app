<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'listing_id'  => 'required|exists:listings,id',
            'message'     => 'required|string|max:2000',
        ]);

        Message::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'listing_id'  => $request->listing_id,
            'message'     => $request->message,
        ]);

        return back()->with('success', 'মেসেজ পাঠানো হয়েছে!');
    }
}

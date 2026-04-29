<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // আপাতত শুধু success message দেখাবে
        // পরে email পাঠানোর feature যোগ করতে পারবেন
        return back()->with('success', 'Message sent successfully!');
    }
}
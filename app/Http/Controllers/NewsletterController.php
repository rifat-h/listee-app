<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'সাবস্ক্রাইব হয়েছে! ধন্যবাদ।');
    }
}

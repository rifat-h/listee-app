<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()    { return view('pages.about'); }
    public function contact()  { return view('pages.contact'); }
    public function pricing()  { return view('pages.pricing'); }
    public function faq()      { return view('pages.faq'); }
    public function gallery()  { return view('pages.gallery'); }
    public function howItWorks() { return view('pages.how-it-works'); }
    public function terms()    { return view('pages.terms'); }
    public function privacy()  { return view('pages.privacy'); }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Mail পাঠাতে চাইলে এখানে Mail::to() ব্যবহার করো
        return back()->with('success', 'আপনার মেসেজ পাঠানো হয়েছে! ধন্যবাদ।');
    }
}
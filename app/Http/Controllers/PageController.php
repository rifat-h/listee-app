<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
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
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->only(['name', 'email', 'subject', 'message']));

        return back()->with('success', 'Your message has been sent successfully! Thank you.');
    }
}
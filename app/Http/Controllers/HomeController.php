<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
                        ->withCount('listings')->get();

        $featuredAds = Listing::where('is_featured', true)
                        ->where('status', 'active')
                        ->latest()->take(8)->get();

        $latestAds = Listing::where('status', 'active')
                        ->latest()->take(12)->get();

        $popularLocations = collect([]); // পরে Location model তৈরি করলে add করবে

        $latestBlogs = BlogPost::where('status', 'published')
                        ->with('user')
                        ->latest()->take(3)->get();

        return view('home', compact(
            'categories',
            'featuredAds',
            'latestAds',
            'popularLocations',
            'latestBlogs'
        ));
    }
}

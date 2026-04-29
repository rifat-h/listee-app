<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->withCount('listings')->get();
        return view('pages.category', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $listings = Listing::where('category_id', $category->id)
                    ->where('status', 'active')
                    ->latest()->paginate(12);

        return view('listings.grid', compact('listings', 'category'));
    }
}
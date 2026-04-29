<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MyListingController extends Controller
{
    public function index()
    {
        $listings = auth()->user()->listings()->with('category', 'images')->latest()->paginate(10);
        return view('user.listings.index', compact('listings'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();
        return view('user.listings.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'nullable|exists:locations,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'condition' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $listing = auth()->user()->listings()->create([
            ...$validated,
            'slug' => Str::slug($validated['title']) . '-' . uniqid(),
            'status' => 'pending',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('listings', 'public');
                $listing->images()->create([
                    'image_path' => '/storage/' . $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('user.listings.index')->with('success', 'Listing created successfully!');
    }

    public function edit(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) abort(403);
        $categories = Category::where('is_active', true)->get();
        $locations = Location::where('is_active', true)->get();
        return view('user.listings.edit', compact('listing', 'categories', 'locations'));
    }

    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'condition' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $listing->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('listings', 'public');
                $listing->images()->create([
                    'image_path' => '/storage/' . $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('user.listings.index')->with('success', 'Listing updated!');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) abort(403);
        $listing->delete();
        return redirect()->route('user.listings.index')->with('success', 'Listing deleted!');
    }
}
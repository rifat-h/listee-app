<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Traits\HasImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    use HasImageUpload;

    public function grid(Request $request)
    {
        $query = Listing::where('status', 'active');

        if ($request->keyword) {
            $query->where('title', 'like', '%'.$request->keyword.'%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->location) {
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        $this->applySorting($query, $request->sort);

        $listings = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('listings.index', compact('listings', 'categories'));
    }

    public function gridSidebar(Request $request)
    {
        $query = Listing::where('status', 'active');
        $this->applySorting($query, $request->sort);
        $listings = $query->paginate(9);
        $categories = Category::where('is_active', true)->withCount('listings')->get();
        return view('listings.grid-sidebar', compact('listings', 'categories'));
    }

    public function listSidebar(Request $request)
    {
        $query = Listing::where('status', 'active');
        $this->applySorting($query, $request->sort);
        $listings = $query->paginate(10);
        $categories = Category::where('is_active', true)->withCount('listings')->get();
        return view('listings.list-sidebar', compact('listings', 'categories'));
    }

    public function gridMap(Request $request)
    {
        $query = Listing::where('status', 'active');
        $this->applySorting($query, $request->sort);
        $listings = $query->paginate(12);
        return view('listings.grid-map', compact('listings'));
    }

    public function listMap(Request $request)
    {
        $query = Listing::where('status', 'active');
        $this->applySorting($query, $request->sort);
        $listings = $query->paginate(10);
        return view('listings.list-map', compact('listings'));
    }

    private function applySorting($query, ?string $sort): void
    {
        match ($sort) {
            'price_low'  => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'popular'    => $query->orderBy('views', 'desc'),
            'oldest'     => $query->orderBy('created_at', 'asc'),
            default      => $query->latest(),
        };
    }

    public function details($slug)
    {
        $listing = Listing::where('slug', $slug)->where('status', 'active')->with(['user', 'category', 'images'])->firstOrFail();
        $listing->increment('views');
        $listing->load('reviews.user');

        $relatedListings = Listing::where('category_id', $listing->category_id)
                            ->where('id', '!=', $listing->id)
                            ->where('status', 'active')
                            ->take(4)->get();

        return view('listings.show', compact('listing', 'relatedListings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'location'    => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery.*'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'), 'listings');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            $galleryPaths = $this->uploadMultipleImages($request->file('gallery'), 'listings/gallery');
        }

        Listing::create([
            'user_id'     => auth()->id(),
            'title'       => $validated['title'],
            'slug'        => Str::slug($validated['title']) . '-' . uniqid(),
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'],
            'location'    => $validated['location'],
            'image'       => $imagePath,
            'gallery'     => $galleryPaths,
            'status'      => 'pending',
        ]);

        return redirect()->route('user.my-listings')->with('success', 'বিজ্ঞাপন সাবমিট হয়েছে!');
    }

    public function edit($id)
    {
        $listing = Listing::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $categories = Category::where('is_active', true)->get();
        return view('user.add-listing', compact('listing', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $listing = Listing::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'location'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'listings', $listing->image);
        }

        if ($listing->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        $listing->update($validated);

        return redirect()->route('user.my-listings')->with('success', 'বিজ্ঞাপন আপডেট হয়েছে!');
    }

    public function destroy($id)
    {
        $listing = Listing::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $this->deleteImage($listing->image);
        if ($listing->gallery) {
            foreach ($listing->gallery as $galleryImage) {
                $this->deleteImage($galleryImage);
            }
        }
        $listing->delete();

        return redirect()->route('user.my-listings')->with('success', 'বিজ্ঞাপন ডিলিট হয়েছে!');
    }
}
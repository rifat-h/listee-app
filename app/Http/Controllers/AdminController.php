<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers    = User::count();
        $totalListings = Listing::count();
        $totalCategories = Category::count();
        $pendingListings = Listing::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalListings', 'totalCategories', 'pendingListings'));
    }

    public function listings()
    {
        $listings = Listing::with(['user', 'category'])->latest()->paginate(20);
        return view('admin.listings', compact('listings'));
    }

    public function updateListingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,active,expired,rejected',
        ]);

        $listing = Listing::findOrFail($id);
        $listing->status = $request->status;
        $listing->save();

        return back()->with('success', 'Listing status updated!');
    }

    public function categories()
    {
        $categories = Category::withCount('listings')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Category::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'icon'   => $request->icon ?? 'fas fa-tag',
            'description' => $request->description,
            'color'  => $request->color ?? '#FF3B30',
            'is_active' => true,
        ]);

        return back()->with('success', 'Category created!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only(['name', 'icon', 'description', 'color', 'is_active']));
        return back()->with('success', 'Category updated!');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted!');
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function blog()
    {
        $posts = BlogPost::latest()->paginate(20);
        return view('admin.blog', compact('posts'));
    }

    public function createBlog()
    {
        return view('admin.blog-create');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        BlogPost::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'status'  => 'published',
        ]);

        return redirect()->route('admin.blog')->with('success', 'Blog post created!');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
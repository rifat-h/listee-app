<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::where('status', 'published');

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $posts = $query->latest()->paginate(9);
        $recentPosts = BlogPost::where('status', 'published')->latest()->take(5)->get();

        return view('blog.index', compact('posts', 'recentPosts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->with('user')->firstOrFail();
        $post->increment('views');

        $recentPosts = BlogPost::where('status', 'published')
                        ->where('id', '!=', $post->id)
                        ->latest()->take(5)->get();

        $prevPost = BlogPost::where('id', '<', $post->id)->where('status', 'published')->latest()->first();
        $nextPost = BlogPost::where('id', '>', $post->id)->where('status', 'published')->first();

        return view('blog.details', compact('post', 'recentPosts', 'prevPost', 'nextPost'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        BlogPost::findOrFail($id);

        Comment::create([
            'blog_post_id' => $id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'কমেন্ট পোস্ট হয়েছে!');
    }
}
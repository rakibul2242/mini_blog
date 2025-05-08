<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query();

        // Search filter
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $posts->where('title', 'like', '%' . $searchTerm . '%');
        }

        // Category filter
        if ($request->has('category') && $request->input('category') != 'all') {
            $category = $request->input('category');
            $posts->where('category', $category); // Assuming you have a 'category' column
        }

        // Sorting
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'date_asc') {
                $posts->orderBy('created_at', 'asc');
            } elseif ($sort == 'date_desc') {
                $posts->orderBy('created_at', 'desc');
            } elseif ($sort == 'title_asc') {
                $posts->orderBy('title', 'asc');
            } elseif ($sort == 'title_desc') {
                $posts->orderBy('title', 'desc');
            }
        } else {
            $posts->orderBy('created_at', 'desc'); // Default sorting
        }

        $posts = $posts->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255', // Add validation for category
            'status' => 'required|in:published,draft,archived', // Add validation for status
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category, // Assign category
            'status' => $request->status, // Assign status
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // You might need a show view
    }


    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category' => 'required|string|max:255', // Add validation for category
            'status' => 'required|in:published,draft,archived', // Add validation for status
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category, // Update category
            'status' => $request->status, // Update status
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}

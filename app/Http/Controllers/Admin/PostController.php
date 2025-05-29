<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Tag;

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

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'status' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'tags' => 'nullable|string',
        ]);

        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'status' => $request->status,
            'featured_image' => $featuredImagePath,
        ]);

        $tags = explode(',', $request->tags);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $post->tags()->sync($tagIds);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post')); // You might need a show view
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'status' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'tags' => 'nullable|string',
        ]);

        $featuredImagePath = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($featuredImagePath) {
                Storage::disk('public')->delete($featuredImagePath);
            }

            // Store new image
            $featuredImagePath = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'status' => $request->status,
            'featured_image' => $featuredImagePath,
        ]);

        $tags = explode(',', $request->tags);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if ($tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $post->tags()->sync($tagIds);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}

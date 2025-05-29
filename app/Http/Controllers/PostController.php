<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all published posts
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(5);
        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Get IDs of tags for this post
        $tagIds = $post->tags->pluck('id');

        // Find related posts sharing these tags, excluding current post
        $relatedPosts = Post::whereHas('tags', function ($query) use ($tagIds) {
            $query->whereIn('tags.id', $tagIds);
        })
            ->where('id', '!=', $post->id)
            ->take(4) // limit
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}

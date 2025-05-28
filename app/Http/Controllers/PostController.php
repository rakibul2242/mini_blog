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
}

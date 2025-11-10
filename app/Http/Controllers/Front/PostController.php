<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->orderByDesc('published_at')->paginate(6);
        return view('front.posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug',$slug)->firstOrFail();
        $post->increment('view_count');
        return view('front.posts.show', compact('post'));
    }
}


<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    // Trang chủ: chỉ hiện published & published_at <= now, mới nhất trước
    public function index()
    {
        $posts = Post::published()->orderByDesc('published_at')->paginate(6);
        return view('front.posts.index', compact('posts'));
    }

    // Trang chi tiết theo slug + tăng view_count mỗi lần truy cập
    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        // Tăng view (an toàn race condition)
        $post->increment('view_count');

        return view('front.posts.show', compact('post'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        // Tạo slug duy nhất
        $data['slug'] = $this->makeUniqueSlug($data['title']);

        // Nếu publish mà published_at trống -> lấy now()
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('ok','Đã tạo bài viết');
    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $req, int $id)
    {
        $post = Post::findOrFail($id);

        $data = $req->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        // Nếu đổi tiêu đề -> cập nhật slug duy nhất
        if ($data['title'] !== $post->title) {
            $data['slug'] = $this->makeUniqueSlug($data['title'], $post->id);
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('ok','Đã cập nhật');
    }

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('ok','Đã xóa');
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 2;

        while (Post::where('slug', $slug)->when($ignoreId, fn($q)=>$q->where('id','!=',$ignoreId))->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}

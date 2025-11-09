@extends('layouts.app')
@section('title','Bài viết')
@section('content')
  <h1 class="mb-3">Bài viết mới nhất</h1>
  @forelse ($posts as $p)
    <div class="card mb-3">
      <div class="card-body">
        <h3 class="card-title">
          <a href="{{ route('front.posts.show',$p->slug) }}">{{ $p->title }}</a>
        </h3>
        <div class="text-muted small">
          @if($p->published_at) Đăng: {{ $p->published_at->format('d/m/Y H:i') }} @endif
          • Lượt xem: {{ $p->view_count }}
        </div>
        <p class="mt-2 mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($p->content), 160) }}</p>
      </div>
    </div>
  @empty
    <p>Chưa có bài viết.</p>
  @endforelse

  <div>{{ $posts->links() }}</div>
@endsection

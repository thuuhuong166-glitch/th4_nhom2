@extends('layouts.app')
@section('title', $post->title)
@section('content')
  <h1 class="mb-2">{{ $post->title }}</h1>
  <div class="text-muted mb-3 small">
    @if($post->published_at) Đăng: {{ $post->published_at->format('d/m/Y H:i') }} @endif
    • Lượt xem: {{ $post->view_count }}
  </div>
  <article class="mb-5">
    {!! nl2br(e($post->content)) !!}
  </article>
  <a class="btn btn-secondary" href="{{ route('front.posts.index') }}">← Quay lại</a>
@endsection


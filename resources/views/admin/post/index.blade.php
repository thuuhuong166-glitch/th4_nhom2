@extends('layouts.app')
@section('title','Quản lý bài viết')
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Quản lý bài viết</h1>
    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">+ Thêm bài</a>
  </div>

  <div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Tiêu đề</th>
        <th>Slug</th>
        <th>Trạng thái</th>
        <th>Đăng lúc</th>
        <th>Lượt xem</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->title }}</td>
        <td>{{ $p->slug }}</td>
        <td>
          <span class="badge text-bg-{{ $p->status==='published'?'success':'secondary' }}">
            {{ $p->status }}
          </span>
        </td>
        <td>{{ $p->published_at? $p->published_at->format('d/m/Y H:i') : '—' }}</td>
        <td>{{ $p->view_count }}</td>
        <td class="text-end">
          <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.posts.edit',$p->id) }}">Sửa</a>
          <form class="d-inline" method="post" action="{{ route('admin.posts.destroy',$p->id) }}">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa?')">Xóa</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>

  {{ $posts->links() }}
@endsection


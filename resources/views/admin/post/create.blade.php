@extends('layouts.app')
@section('title','Thêm bài viết')
@section('content')
<h1>Thêm bài viết</h1>
<form method="post" action="{{ route('admin.posts.store') }}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Tiêu đề</label>
    <input name="title" type="text" class="form-control" value="{{ old('title') }}" required>
    @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Nội dung</label>
    <textarea name="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
    @error('content')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label class="form-label d-block">Trạng thái</label>
    <select name="status" class="form-select" required>
      <option value="draft" {{ old('status')==='draft'?'selected':'' }}>Nháp</option>
      <option value="published" {{ old('status')==='published'?'selected':'' }}>Xuất bản</option>
    </select>
    @error('status')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="mb-3">
    <label class="form-label">Ngày xuất bản (tùy chọn)</label>
    <input name="published_at" type="datetime-local" class="form-control" value="{{ old('published_at') }}">
    <div class="form-text">Nếu để trống và trạng thái = "Xuất bản", hệ thống sẽ tự dùng thời điểm hiện tại.</div>
    @error('published_at')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <button class="btn btn-primary">Lưu</button>
  <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Hủy</a>
</form>
@endsection

@extends('admin.layouts.app')

@section('heading', 'Add Blog Post')
@section('subheading', 'Create a new blog article with text, images, and headings.')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.blogs.posts.store') }}" class="blog-form-shell" data-blog-form>
        @csrf
        <div class="admin-toolbar admin-toolbar--split">
            <a href="{{ route('admin.blogs.posts.index') }}" class="admin-link">← Back to posts</a>
            <button type="submit" class="admin-btn admin-btn--primary">Create post</button>
        </div>

        @include('admin.blogs.posts._form', ['post' => $post])

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn--primary">Create post</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="/assets/admin/blog-editor.js?v=1"></script>
@endpush

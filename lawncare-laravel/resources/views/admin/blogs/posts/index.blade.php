@extends('admin.layouts.app')

@section('heading', 'Blog Posts')
@section('subheading', 'Create, edit, publish, and delete blog articles.')

@section('content')
    <div class="admin-panel admin-panel--flush">
        <div class="admin-toolbar admin-toolbar--split">
            <a href="{{ route('admin.blogs.index') }}" class="admin-link">← Blogs modules</a>
            <a href="{{ route('admin.blogs.posts.create') }}" class="admin-btn admin-btn--primary">Add post</a>
        </div>

        <form method="GET" action="{{ route('admin.blogs.posts.index') }}" class="admin-search">
            <div class="admin-search__field">
                <svg class="admin-search__icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M10.5 3a7.5 7.5 0 1 1 4.74 13.32l4.56 4.56-1.42 1.42-4.56-4.56A7.5 7.5 0 0 1 10.5 3Zm0 2a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11Z" fill="currentColor"/>
                </svg>
                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search by title, author, or slug..."
                    class="admin-search__input"
                >
            </div>
            <button type="submit" class="admin-btn admin-btn--primary">Search</button>
            @if ($search !== '')
                <a href="{{ route('admin.blogs.posts.index') }}" class="admin-btn admin-btn--ghost">Clear</a>
            @endif
        </form>

        @if ($posts->isEmpty())
            <div class="admin-empty">
                @if ($search !== '')
                    No posts found for “{{ $search }}”.
                @else
                    No blog posts yet. Click “Add post” to create your first article.
                @endif
            </div>
        @else
            <div class="admin-blog-list">
                @foreach ($posts as $post)
                    <article class="admin-blog-card">
                        <div class="admin-blog-card__media">
                            @if ($post->image)
                                <img src="{{ $post->image }}" alt="" class="admin-blog-card__thumb">
                            @else
                                <div class="admin-blog-card__thumb admin-blog-card__thumb--empty">No image</div>
                            @endif
                        </div>

                        <div class="admin-blog-card__body">
                            <div class="admin-blog-card__top">
                                <h3 class="admin-blog-card__title">{{ $post->title }}</h3>
                                <span class="admin-badge admin-badge--{{ $post->is_published ? 'contacted' : 'closed' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>

                            <p class="admin-blog-card__meta">
                                <span>{{ $post->author }}</span>
                                <span aria-hidden="true">·</span>
                                <span>{{ $post->published_at->format('M j, Y') }}</span>
                                @if ($post->reading_time)
                                    <span aria-hidden="true">·</span>
                                    <span>{{ $post->reading_time }}</span>
                                @endif
                            </p>

                            <p class="admin-blog-card__slug">/blogs/{{ $post->slug }}</p>
                        </div>

                        <div class="admin-blog-card__actions">
                            <a href="{{ route('blogs.show', $post->slug) }}" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener">View</a>
                            <a href="{{ route('admin.blogs.posts.edit', $post) }}" class="admin-btn admin-btn--primary">Edit</a>
                            <form method="POST" action="{{ route('admin.blogs.posts.destroy', $post) }}" onsubmit="return confirm('Delete this blog post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-link admin-link--danger">Delete</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="admin-pagination">{{ $posts->links() }}</div>
        @endif
    </div>
@endsection

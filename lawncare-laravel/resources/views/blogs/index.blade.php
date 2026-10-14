@extends('layouts.app')

@section('title', 'Blogs — ' . $site['name'])

@section('content')
    <section class="harmone-blogs-hero">
        <div class="harmone-blogs-hero__inner">
            <h1 class="sr-only">{{ \Illuminate\Support\Str::title($blogs_page['title']) }}</h1>
            <div class="harmone-blogs-hero__art">
                <img src="{{ $blogs_page['hero_image'] }}"
                    alt="{{ \Illuminate\Support\Str::title($blogs_page['title']) }}">
            </div>
        </div>
    </section>

    <section class="harmone-blogs-grid-section">
        <div class="harmone-blogs-grid-section__inner">
            <div class="harmone-blogs-grid">
                @foreach ($blog_posts as $post)
                    @include('partials.harmone-blog-card', ['post' => $post, 'heading' => 'h2'])
                @endforeach
            </div>
        </div>
    </section>
@endsection

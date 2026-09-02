@extends('layouts.app')

@section('title', 'Blogs — ' . $site['name'])

@section('content')
    <section class="harmone-blogs-hero">
        <div class="harmone-blogs-hero__inner">
            <div class="harmone-blogs-hero__intro">
                <div class="harmone-about-badge">
                    <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                    <span>{{ $blogs_page['badge'] }}</span>
                </div>
                <h1 class="harmone-blogs-hero__title">{{ $blogs_page['title'] }}</h1>
            </div>

            <div class="harmone-blogs-hero__art" aria-hidden>
                <img src="{{ $blogs_page['hero_image'] }}" alt="">
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

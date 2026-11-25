@extends('layouts.app')

@section('title', $blogs_page['seo_title'] ?? ('Blogs — '.$site['name']))
@section('meta_description', $blogs_page['seo_description'] ?? $site['description'])

@section('content')
    <section class="harmone-blogs-hero">
        <div class="harmone-blogs-hero__inner">
            <div class="harmone-blogs-hero__art">
                <img src="{{ $blogs_page['hero_image'] }}"
                    alt="{{ $blogs_page['title'] }}">
            </div>
            <div class="relative z-10 mx-auto max-w-3xl px-5 py-16 text-center text-white md:py-24">
                <h1 class="text-3xl font-medium tracking-tight md:text-5xl">{{ $blogs_page['title'] }}</h1>
                @if (! empty($blogs_page['subtitle']))
                    <p class="mt-4 text-base leading-relaxed text-white/90 md:text-lg">{{ $blogs_page['subtitle'] }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="harmone-blogs-grid-section">
        <div class="harmone-blogs-grid-section__inner">
            @if (! empty($blogs_page['intro']))
                <p class="mx-auto mb-10 max-w-3xl text-center text-sm leading-relaxed text-body md:text-base">{{ $blogs_page['intro'] }}</p>
            @endif
            <div class="harmone-blogs-grid">
                @foreach ($blog_posts as $post)
                    @include('partials.harmone-blog-card', ['post' => $post, 'heading' => 'h2'])
                @endforeach
            </div>
        </div>
    </section>
@endsection

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
                    <article class="harmone-blog-card">
                        <a href="{{ route('blogs.show', $post['slug']) }}" class="harmone-blog-card__link">
                            <div class="harmone-blog-card__media">
                                <img src="{{ $post['image'] }}" alt="" loading="lazy">
                            </div>
                            <div class="harmone-blog-card__body">
                                <p class="harmone-blog-card__meta">
                                    <span>{{ $post['date'] }}</span>
                                </p>
                                <h2 class="harmone-blog-card__title">{{ $post['title'] }}</h2>
                                <span class="harmone-blog-card__arrow" aria-hidden="true">
                                    <img src="{{ $blog_arrow_icon }}" alt="" width="25" height="25">
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

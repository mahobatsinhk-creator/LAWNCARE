@extends('layouts.app')

@section('title', $post['title'] . ' — ' . $site['name'])

@section('content')
    <article class="harmone-blog-detail">
        {{-- Hero --}}
        <section class="harmone-blog-detail__hero" data-reveal-group>
            <div class="harmone-blog-detail__hero-inner">
                <p class="harmone-blog-detail__breadcrumb harmone-reveal" data-reveal="slide-left">
                    <a href="{{ route('blogs.index') }}">Blog details</a>
                </p>
                <h1 class="harmone-blog-detail__hero-title">
                    @foreach (preg_split('/\s+/', trim($post['title'])) as $index => $word)
                        <span class="harmone-reveal-word" style="--word-index: {{ $index }}">{{ $word }} </span>
                    @endforeach
                </h1>

                <div class="harmone-blog-detail__hero-media harmone-reveal" data-reveal="fade-up">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" loading="eager">
                </div>

                <div class="harmone-blog-detail__hero-meta harmone-reveal" data-reveal="fade-up" data-reveal-delay="120">
                    <div class="harmone-blog-detail__hero-meta-copy">
                        <p><strong>Published</strong> <span>{{ $post['date'] }}</span></p>
                        @if (! empty($post['reading_time']))
                            <p><strong>{{ $post['reading_time'] }}</strong> <span>Reading time</span></p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Article body --}}
        <section class="harmone-blog-detail__body">
            <div class="harmone-blog-detail__body-inner" data-reveal-group>
                @if (! empty($post['quote']))
                    <aside class="harmone-blog-detail__sidebar">
                        <blockquote class="harmone-blog-detail__quote harmone-reveal" data-reveal="slide-left">
                            <p>&ldquo;{{ $post['quote']['text'] }}&rdquo;</p>
                        </blockquote>
                    </aside>
                @endif

                <div class="harmone-blog-detail__content">
                    @include('partials.harmone-blog-article')
                    <a href="{{ route('blogs.index') }}" class="harmone-blog-detail__back harmone-reveal"
                        data-reveal="fade-up">&larr; Go back</a>
                </div>
            </div>
        </section>

        {{-- Related posts --}}
        @if ($related_posts->isNotEmpty())
            <section class="harmone-blog-detail__related">
                <div class="harmone-blog-detail__related-inner">
                    <div class="harmone-blog-detail__related-header">
                        <h2>Related blogs</h2>
                        <a href="{{ route('blogs.index') }}">View more</a>
                    </div>
                    <div class="harmone-blogs-grid">
                        @foreach ($related_posts as $related)
                            <article class="harmone-blog-card">
                                <a href="{{ route('blogs.show', $related['slug']) }}" class="harmone-blog-card__link">
                                    <div class="harmone-blog-card__media">
                                        <img src="{{ $related['image'] }}" alt="" loading="lazy">
                                    </div>
                                    <div class="harmone-blog-card__body">
                                        <p class="harmone-blog-card__meta">
                                            <span>{{ $related['date'] }}</span>
                                        </p>
                                        <h3 class="harmone-blog-card__title">{{ $related['title'] }}</h3>
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
        @endif
    </article>
@endsection

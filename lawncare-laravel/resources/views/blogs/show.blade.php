@extends('layouts.app')

@section('title', $post['seo_title'] ?? ($post['title'] . ' — ' . $site['name']))
@section('meta_description', $post['meta_description'] ?? $site['description'])
@section('canonical', url('/blogs/'.$post['slug']))
@section('og_type', 'article')
@section('og_image', url($post['image'] ?? ($site['logo'] ?? '/assets/site/logo-header.png')))

@push('head')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post['title'],
            'description' => $post['meta_description'] ?? $site['description'],
            'image' => url($post['image'] ?? ''),
            'author' => [
                '@type' => 'Organization',
                'name' => $post['author'] ?? $site['name'],
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $site['name'],
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/assets/site/logo-header.png'),
                ],
            ],
            'datePublished' => \Illuminate\Support\Carbon::parse($post['date'])->toIso8601String(),
            'dateModified' => \Illuminate\Support\Carbon::parse($post['date'])->toIso8601String(),
            'mainEntityOfPage' => url('/blogs/'.$post['slug']),
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <article class="harmone-blog-detail" itemscope itemtype="https://schema.org/BlogPosting">
        {{-- Hero --}}
        <section class="harmone-blog-detail__hero" data-reveal-group>
            <div class="harmone-blog-detail__hero-inner">
                <p class="harmone-blog-detail__breadcrumb harmone-reveal" data-reveal="slide-left">
                    <a href="{{ route('blogs.index') }}">Blog details</a>
                </p>
                <h1 class="harmone-blog-detail__hero-title" itemprop="headline">
                    @foreach (preg_split('/\s+/', trim($post['title'])) as $index => $word)
                        <span class="harmone-reveal-word" style="--word-index: {{ $index }}">{{ $word }} </span>
                    @endforeach
                </h1>

                <div class="harmone-blog-detail__hero-media harmone-reveal" data-reveal="fade-up">
                    <img src="{{ $post['image'] }}" alt="{{ $post['image_alt'] ?? $post['title'] }}" loading="eager" itemprop="image">
                </div>

                <div class="harmone-blog-detail__hero-meta harmone-reveal" data-reveal="fade-up" data-reveal-delay="120">
                    <div class="harmone-blog-detail__hero-meta-copy">
                        <p><strong>Published</strong> <span itemprop="datePublished">{{ $post['date'] }}</span></p>
                        @if (! empty($post['author']))
                            <p><strong>Author</strong> <span itemprop="author">{{ $post['author'] }}</span></p>
                        @endif
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
        @if (! empty($related_posts))
            <section class="harmone-blog-detail__related">
                <div class="harmone-blog-detail__related-inner">
                    <div class="harmone-blog-detail__related-header">
                        <h2>Related Blogs</h2>
                        <a href="{{ route('blogs.index') }}">View More</a>
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
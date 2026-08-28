@php
    $featured_post = $blog_posts[0] ?? null;
    $side_posts = array_slice($blog_posts, 1, 2);
@endphp

@if ($featured_post)
    <section id="blogs" class="harmone-home-blogs section-shell">
        <div class="harmone-home-blogs__inner section-inner">
            @include('partials.harmone-section-header', [
                'badge' => $home['blogs_badge'],
                'ctaHref' => route('blogs.index'),
                'ctaLabel' => $home['blogs_cta'],
                'ctaClass' => 'harmone-book-btn',
                'layout' => 'split',
            ])

            <div class="harmone-home-blogs__layout">
                <article class="harmone-home-blog-featured">
                    <a href="{{ route('blogs.show', $featured_post['slug']) }}" class="harmone-home-blog-featured__card">
                        <div class="harmone-home-blog-featured__media">
                            <div class="harmone-home-blog-featured__media-zoom">
                                <img src="{{ $featured_post['image'] }}" alt="" loading="lazy">
                            </div>
                        </div>
                        <div class="harmone-home-blog-featured__body">
                            <p class="harmone-home-blog-featured__meta">{{ $featured_post['date'] }}</p>
                            <h3 class="harmone-home-blog-featured__title">{{ $featured_post['title'] }}</h3>
                        </div>
                    </a>
                </article>

                @if ($side_posts !== [])
                    <div class="harmone-home-blogs__stack">
                        @foreach ($side_posts as $index => $post)
                            <article
                                class="harmone-home-blog-compact{{ $index === 1 ? ' harmone-home-blog-compact--scale-in' : '' }}"
                                @if ($index === 1) data-blog-scale-in @endif>
                                <a href="{{ route('blogs.show', $post['slug']) }}" class="harmone-home-blog-compact__card">
                                    <div class="harmone-home-blog-compact__media">
                                        <div class="harmone-home-blog-compact__media-zoom">
                                            <img src="{{ $post['image'] }}" alt="" loading="lazy">
                                        </div>
                                    </div>
                                    <div class="harmone-home-blog-compact__body">
                                        <div class="harmone-home-blog-compact__copy">
                                            <p class="harmone-home-blog-compact__meta">{{ $post['date'] }}</p>
                                            <h4 class="harmone-home-blog-compact__title">{{ $post['title'] }}</h4>
                                        </div>
                                        <span class="harmone-home-blog-compact__arrow" aria-hidden="true">
                                            <img src="{{ $blog_arrow_icon }}" alt="" width="25" height="25">
                                        </span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

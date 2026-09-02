@php
    $home_posts = array_slice($blog_posts, 0, 3);
@endphp

@if ($home_posts !== [])
    <section id="blogs" class="harmone-home-blogs section-shell">
        <div class="harmone-home-blogs__inner section-inner">
            @include('partials.harmone-section-header', [
                'badge' => $home['blogs_badge'],
                'ctaHref' => route('blogs.index'),
                'ctaLabel' => $home['blogs_cta'],
                'ctaClass' => 'harmone-book-btn',
                'layout' => 'split',
            ])

            <div class="harmone-blogs-grid-section harmone-home-blogs__grid-section">
                <div class="harmone-blogs-grid-section__inner">
                    <div class="harmone-blogs-grid">
                        @foreach ($home_posts as $post)
                            @include('partials.harmone-blog-card', ['post' => $post, 'heading' => 'h3'])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

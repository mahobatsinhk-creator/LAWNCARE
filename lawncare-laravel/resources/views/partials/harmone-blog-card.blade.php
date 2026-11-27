<article class="harmone-blog-card">
    <a href="{{ route('blogs.show', $post['slug']) }}" class="harmone-blog-card__link">
        <div class="harmone-blog-card__media">
            <img src="{{ $post['image'] }}" alt="{{ site_image_alt($post['image'], $post['title'] ?? '') }}" loading="lazy">
        </div>
        <div class="harmone-blog-card__body">
            <p class="harmone-blog-card__meta">
                <span>{{ $post['date'] }}</span>
            </p>
            @if (($heading ?? 'h2') === 'h3')
                <h3 class="harmone-blog-card__title">{{ \Illuminate\Support\Str::title($post['title']) }}</h3>
            @else
                <h2 class="harmone-blog-card__title">{{ \Illuminate\Support\Str::title($post['title']) }}</h2>
            @endif
            <span class="harmone-blog-card__arrow">
                <img src="{{ $blog_arrow_icon }}" alt="{{ site_image_alt($blog_arrow_icon, 'Read article arrow') }}" width="25" height="25">
            </span>
        </div>
    </a>
</article>

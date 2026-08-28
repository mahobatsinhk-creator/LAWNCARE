<section class="greenly-service-detail__hero" data-reveal-group>
    <div class="greenly-service-detail__inner">
        <header class="greenly-service-detail__hero-copy">
            <h1 class="greenly-service-detail__title">
                @foreach (preg_split('/\s+/', trim($service['title'])) as $index => $word)
                    <span class="harmone-reveal-word" style="--word-index: {{ $index }}">{{ $word }} </span>
                @endforeach
            </h1>
            <p class="greenly-service-detail__subtitle harmone-reveal" data-reveal="fade-up">{{ $service['short'] }}</p>
        </header>

        <div class="greenly-service-detail__hero-media harmone-reveal" data-reveal="slide-in" data-reveal-delay="120">
            @if (! empty($service['video']))
                <video autoplay loop muted playsinline preload="auto"
                    poster="{{ $service['hero_image'] ?? $service['image'] }}">
                    <source src="{{ $service['video'] }}" type="video/mp4">
                </video>
            @else
                <img src="{{ $service['hero_image'] ?? $service['image'] }}" alt="{{ $service['title'] }}"
                    loading="eager">
            @endif
        </div>
    </div>
</section>

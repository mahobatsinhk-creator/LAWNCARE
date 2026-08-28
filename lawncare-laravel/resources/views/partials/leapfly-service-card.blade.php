@if ($service['href'] && ! $service['coming_soon'])
    <a href="{{ $service['href'] }}"
        class="leapfly-service-card group block no-underline"
        data-animate>
@else
    <article class="leapfly-service-card" data-animate>
@endif
    <div class="leapfly-service-card__media">
        @if (! empty($service['video']))
            <video autoplay loop muted playsinline preload="auto" aria-hidden="true">
                <source src="{{ $service['video'] }}" type="video/mp4">
            </video>
        @else
            <img src="{{ $service['image'] }}" alt="" loading="lazy" decoding="async" aria-hidden="true">
        @endif
        <div class="leapfly-service-card__shade" aria-hidden="true"></div>
        <div class="leapfly-service-card__content">
            <h3 class="leapfly-service-card__title">{{ $service['title'] }}</h3>
            <p class="leapfly-service-card__desc">{{ $service['short'] }}</p>
        </div>
        @if ($service['coming_soon'])
            <span class="leapfly-service-card__badge">Coming soon</span>
        @endif
    </div>
@if ($service['href'] && ! $service['coming_soon'])
    </a>
@else
    </article>
@endif

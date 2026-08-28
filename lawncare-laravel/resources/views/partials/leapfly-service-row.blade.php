@php
    $isLink = $service['href'] && ! $service['coming_soon'];
    $tag = $isLink ? 'a' : 'article';
@endphp

<{{ $tag }}
    @if ($isLink)
        href="{{ route('services.show', $service['slug']) }}"
        class="leapfly-service-row {{ $service['reverse'] ? 'leapfly-service-row--reverse' : '' }}"
    @else
        class="leapfly-service-row {{ $service['reverse'] ? 'leapfly-service-row--reverse' : '' }}"
    @endif
    data-animate>
    <div class="leapfly-service-row__content">
        <div class="leapfly-service-row__icon" aria-hidden="true">
            @include('partials.leapfly-service-icon', ['icon' => $service['icon'] ?? 'lawn'])
        </div>

        <div class="leapfly-service-row__copy">
            <h2 class="leapfly-service-row__title">{{ $service['title'] }}</h2>
            <p class="leapfly-service-row__desc">{{ $service['short'] }}</p>

            @if (! empty($service['features']))
                <ul class="leapfly-service-row__features">
                    @foreach ($service['features'] as $feature)
                        <li>
                            <span class="leapfly-service-row__check" aria-hidden="true">
                                <svg viewBox="0 0 16 16" width="16" height="16" fill="none">
                                    <path d="M3.5 8.5 6.5 11.5 12.5 4.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($service['coming_soon'])
                <span class="leapfly-service-row__soon">Coming soon</span>
            @elseif ($isLink)
                <span class="leapfly-service-row__cta">Learn more</span>
            @endif
        </div>
    </div>

    <div class="leapfly-service-row__media">
        @if (! empty($service['video']))
            <video autoplay loop muted playsinline preload="auto" aria-hidden="true">
                <source src="{{ $service['video'] }}" type="video/mp4">
            </video>
        @else
            <img src="{{ $service['image'] }}" alt="" loading="lazy" decoding="async" aria-hidden="true">
        @endif
    </div>
</{{ $tag }}>

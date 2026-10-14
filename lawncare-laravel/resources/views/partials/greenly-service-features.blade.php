@if (! empty($service['detail_features']))
<section class="greenly-service-detail__features" data-reveal-group>
    <div class="greenly-service-detail__inner">
        <div class="greenly-service-detail__feature-grid">
            @foreach ($service['detail_features'] as $index => $feature)
                <article @class([
                    'greenly-service-detail__feature harmone-reveal',
                    'greenly-service-detail__feature--card' => ! empty($feature['image']),
                ]) data-reveal="fade-up" data-reveal-delay="{{ $index * 80 }}">
                    @if (! empty($feature['image']))
                        <div class="greenly-service-detail__feature-media">
                            <img src="{{ $feature['image'] }}" alt="{{ \Illuminate\Support\Str::title($feature['title']) }}" loading="lazy">
                        </div>
                        <div class="greenly-service-detail__feature-copy">
                            <h3 class="greenly-service-detail__feature-title">{{ \Illuminate\Support\Str::title($feature['title']) }}</h3>
                            <p class="greenly-service-detail__feature-body">{{ $feature['body'] }}</p>
                        </div>
                    @else
                        <h3 class="greenly-service-detail__feature-title">{{ \Illuminate\Support\Str::title($feature['title']) }}</h3>
                        <p class="greenly-service-detail__feature-body">{{ $feature['body'] }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

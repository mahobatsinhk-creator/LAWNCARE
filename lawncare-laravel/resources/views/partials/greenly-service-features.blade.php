<section class="greenly-service-detail__features" data-reveal-group>
    <div class="greenly-service-detail__inner">
        <div class="greenly-service-detail__feature-grid">
            @foreach ($service['detail_features'] as $index => $feature)
                <article class="greenly-service-detail__feature harmone-reveal" data-reveal="fade-up"
                    data-reveal-delay="{{ $index * 80 }}">
                    <h3 class="greenly-service-detail__feature-title">{{ $feature['title'] }}</h3>
                    <p class="greenly-service-detail__feature-body">{{ $feature['body'] }}</p>
                </article>

                @if ($index === 3 && ! empty($service['mid_image']))
                    <div class="greenly-service-detail__feature-media harmone-reveal" data-reveal="slide-in"
                        data-reveal-delay="160">
                        <img src="{{ $service['mid_image'] }}" alt="" loading="lazy" aria-hidden="true">
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

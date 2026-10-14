@if (! empty($service['detail_offerings']))
    <section class="greenly-service-detail__offerings" data-reveal-group>
        <div class="greenly-service-detail__inner">
            <header class="greenly-service-detail__offerings-header harmone-reveal" data-reveal="fade-up">
                <h2 class="greenly-service-detail__offerings-title">What We Provide</h2>
                <p class="greenly-service-detail__offerings-lead">
                    {{ $service['offerings_lead'] ?? 'Professional services tailored to keep your property looking its best.' }}
                </p>
            </header>

            <div class="greenly-service-detail__offerings-grid">
                @foreach ($service['detail_offerings'] as $index => $offering)
                    <article class="greenly-service-detail__offering harmone-reveal" data-reveal="fade-up"
                        data-reveal-delay="{{ $index * 90 }}">
                        <div class="greenly-service-detail__offering-media">
                            <img src="{{ $offering['image'] }}" alt="{{ \Illuminate\Support\Str::title($offering['title']) }}" loading="lazy">
                        </div>
                        <div class="greenly-service-detail__offering-copy">
                            <h3 class="greenly-service-detail__offering-title">{{ \Illuminate\Support\Str::title($offering['title']) }}</h3>
                            <p class="greenly-service-detail__offering-body">{{ $offering['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

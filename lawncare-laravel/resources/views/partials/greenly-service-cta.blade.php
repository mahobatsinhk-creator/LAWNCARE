<section class="greenly-service-detail__cta" data-reveal-group>
    <div class="greenly-service-detail__cta-inner">
        <div class="greenly-service-detail__cta-copy">
            <h2 class="greenly-service-detail__cta-title harmone-reveal" data-reveal="fade-up">
                {{ $service_detail_page['cta_title'] }}
                <em>{{ $service_detail_page['cta_title_em'] }}</em>
            </h2>
            <p class="greenly-service-detail__cta-text harmone-reveal" data-reveal="fade-up" data-reveal-delay="100">
                {{ $service_detail_page['cta_subtitle'] }}
            </p>
            <a href="/contact#quote" class="greenly-service-detail__cta-btn harmone-reveal" data-reveal="fade-up"
                data-reveal-delay="180">{{ $service_detail_page['cta_button'] }}</a>
        </div>

        <div class="greenly-service-detail__cta-media harmone-reveal" data-reveal="slide-in" data-reveal-delay="140"
            aria-hidden="true">
            <img src="{{ $service_detail_page['cta_image'] }}" alt="">
        </div>
    </div>
</section>

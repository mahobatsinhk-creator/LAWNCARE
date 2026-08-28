<section class="harmone-testimonials-section section-shell" data-testimonials-scroll
    style="--testimonial-count: {{ count($testimonials) }}">
    <div class="harmone-testimonials-scroll-spacer">
        <div class="harmone-testimonials-sticky">
            <div class="section-inner harmone-testimonials-inner">
                <div class="harmone-testimonials-header">
                    <div class="harmone-about-badge">
                        <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                        <span>{{ $home['testimonials_badge'] }}</span>
                    </div>
                    <h2 class="harmone-testimonials-title">{{ $home['testimonials_title'] }}</h2>
                </div>

                <div class="harmone-testimonials-stage">
                    <div class="harmone-testimonials-bg" data-testimonials-bg>
                        <img src="{{ $testimonials_feature_image }}" alt="" loading="lazy" decoding="async">
                    </div>

                    <div class="harmone-testimonials-cards" data-testimonials-cards>
                        @foreach ($testimonials as $index => $testimonial)
                            <article @class([
                                'harmone-testimonial-card',
                                'harmone-testimonial-card--light' => $testimonial['variant'] === 'light',
                                'harmone-testimonial-card--dark' => $testimonial['variant'] === 'dark',
                            ]) data-testimonial-card data-index="{{ $index }}">
                                <div class="harmone-testimonial-card__content">
                                    <p class="harmone-testimonial-card__quote">"{{ $testimonial['quote'] }}"</p>
                                    <div class="harmone-testimonial-card__author">
                                        <p class="harmone-testimonial-card__name">{{ $testimonial['name'] }}</p>
                                        <p class="harmone-testimonial-card__role">{{ $testimonial['role'] }}</p>
                                    </div>
                                </div>

                                @if (! empty($testimonial['avatar']))
                                    <div class="harmone-testimonial-card__avatar">
                                        <img src="{{ $testimonial['avatar'] }}" alt="" loading="lazy" decoding="async">
                                    </div>
                                @endif

                                @if ($testimonial['variant'] === 'dark')
                                    <div class="harmone-testimonial-card__leaf" aria-hidden="true">
                                        <img src="{{ $testimonials_leaf_image }}" alt="">
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
